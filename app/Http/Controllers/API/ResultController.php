<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Result;
use App\Models\Web;
use Illuminate\Http\Request;

class ResultController extends Controller
{

    public function all(Request $request)
    {
        $all = $request->input('all');
        $id = $request->input('id');
        $id_comic = $request->input('id_comic');
        $id_web = $request->input('id_web');

        if($id)
        {
            $result = Result::with([
                                    'web' => function($query){
                                    $query->select('id','name','url','xpath_chapter', 'xpath_last_update');
                                    },
                                    'comic' => function($query){
                                        $query->select('id','name','image');
                                    }
                                    ])
                            ->find($id);


            if($result)
                return ResponseFormatter::success($result,'Data last chapter berhasil diambil');
            else
                return ResponseFormatter::error(null,'Data produk tidak ada', 404);
        }



        if($id_comic)
        {
            $all_results = [];
            $comic = Comic::where('status', 1)->find($id_comic);
            if ($comic) {
                if ($id_web) {
                    $results = $this->results($comic->id, false, $id_web);
                } else {
                    $results = $this->results($comic->id);
                }


                $all_results = [
                                    'comic' => [$comic->id, $comic->name, $comic->image],
                                    'results' => $results
                                ];
            }

            if($all_results)
                return ResponseFormatter::success($all_results,'Data last chapter berhasil diambil');
            else
                return ResponseFormatter::error(null,'Data produk tidak ada', 404);
        }


        if ($all == 'true'){
            $all_results = [];
            $comics = Comic::where('status', 1)->get();
            foreach ($comics as $comic) {
                $hasil = [];
                $results = $this->results($comic->id, 3);

                $hasil = ['comic' => [$comic->id, $comic->name, $comic->image],
                            'results' => $results
                        ];
                array_push($all_results,$hasil);
            }

            if($all_results)
                return ResponseFormatter::success($all_results,'Data last chapter berhasil diambil');
            else
                return ResponseFormatter::error(null,'Data produk tidak ada', 404);
        }



        // With Pagination
        $comics = Comic::where('status', '=', 1)
                        ->paginate(2);

        $i = 0;
        foreach ($comics as $comic) {
            $hasil = [];
            $results = $this->results($comic->id, 3);
            $comics[$i]['result'] = $results;
            $i++;
        }

        if($comics)
            return ResponseFormatter::success($comics,'Data last chapter berhasil diambil');
        else
            return ResponseFormatter::error(null,'Data produk tidak ada', 404);

    }

    public function results($id, $take = false, $id_web = false)
    {
        if ($take) {
            return Result::whereHas('web', function ($query) {
                                return $query->where('status', '=', 1);
                                })
                            ->with(['web' => function($query){
                                    $query->select('id','name','url', 'xpath_chapter', 'xpath_last_update');
                                }])
                            ->where(['id_comic'=> $id, 'status'=> 1])
                            ->orderBy('regex', 'DESC')
                            ->take($take)
                            ->get(['id','id_comic','id_web','short_url','last_chapter','regex','date_scraping']);
        }

        elseif ($id_web) {
            return Result::whereHas('web', function ($query) {
                                        return $query->where('status','=',1);
                                        })
                                    ->with(['web' => function($query){
                                            $query->select('id','name','url', 'xpath_chapter', 'xpath_last_update');
                                        }])
                                    ->where(['id_comic'=> $id, 'status'=> 1, 'id_web' => $id_web])
                                    ->first();
        }

        else {
                return Result::whereHas('web', function ($query) {
                                    return $query->where('status', '=', 1);
                                    })
                                ->with(['web' => function($query){
                                        $query->select('id','name','url', 'xpath_chapter', 'xpath_last_update');
                                    }])
                                ->where(['id_comic'=> $id, 'status'=> 1])
                                ->get(['id','id_comic','id_web','short_url','last_chapter','regex','date_scraping']);
        }
    }


    public function updateValue(Request $request, $id)
    {
        $data = $request->all();

        $timezone = time() + (60 * 60 * 7);
        $data['date_scraping'] = gmdate('Y-m-d H:i:s', $timezone);
        $data['regex'] = $data['last_chapter'];
        $data['regex'] = (float) filter_var( $data['regex'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );

        $item = Result::findOrFail($id);
        $item = $item->update($data);

        // if($item)
        //     return ResponseFormatter::success($item,'Data last chapter berhasil diupdate');
        // else
        //     return ResponseFormatter::error(null,'Data gagal diupdate', 404);
        return redirect('api/wordpress?id='.$item->id_comic);

    }
}
