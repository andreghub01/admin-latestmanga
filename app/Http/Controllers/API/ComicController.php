<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use Illuminate\Http\Request;
// use JD\Cloudder\Facades\Cloudder;


class ComicController extends Controller
{
    public function all(Request $request)
    {
        $all = $request->input('all');

        // $limit = $request->input('limit', 6);
        if ($all == 'true'){
            $comics = Comic::where('status', 1)->get(['id','name']);

            if($comics)
                return ResponseFormatter::success($comics,'Data last chapter berhasil diambil');
            else
                return ResponseFormatter::error(null,'Data produk tidak ada', 404);
        }
    }

    public function updateDetail(Request $request, $id)
    {
        $data = $request->all();
        $item = Comic::findOrFail($id);
        if (isset($data['image'])) {
            if ($item->image == "" || $item->image == null) {
                // $data['image'] = "https:".$data['image'];

                $filename = $item->slug.'.jpg';
                $this->save_image($data['image'], $filename);
                $data['image'] = $filename;
            }
        }else{
            $data['image'] = "";
        }
        $item = $item->update($data);

        // if($item)
        //     return ResponseFormatter::success($item,'Data comic berhasil diupdate');
        // else
        //     return ResponseFormatter::error(null,'Data gagal diupdate', 404);
        return redirect('api/wordpress?id='.$id);
    }

    function save_image($inPath,$outPath)
    { //Download images from remote servers
        $in=    fopen($inPath, "rb");
        $out=   fopen("comics/".$outPath, "wb");
        while ($chunk = fread($in,8192))
        {
            fwrite($out, $chunk, 8192);
        }
        fclose($in);
        fclose($out);
    }
}
