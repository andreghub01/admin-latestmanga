<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResultsRequest;
use App\Models\Comic;
use App\Models\Result;
use App\Models\Web;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari = $request->input('cari');
        $items = Comic::where('status', 1)
                        ->where('name','like',"%".$cari."%")
                        ->with(['result'])
                        ->paginate(10);

        return view('pages.results.index')->with([
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id_comic = $request->input('id_comic');
        $comic = Comic::findOrFail($id_comic);
        $webs = Web::where('status', 1)->get();

        return view('pages.results.form')->with([
            'comic' => $comic,
            'webs' => $webs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResultsRequest $request)
    {
        $data = $request->all();

        Result::create($data);
        return redirect()->route('results.show', $data['id_comic']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $comic = Comic::findOrFail($id);
        $orderby = $request->input('orderby');

        if ($orderby) {
            $items = Result::with(['web'])
                            ->where('id_comic', $id)
                            ->orderBy($orderby, 'DESC')
                            ->get();
        }else{
            $items = Result::with(['web'])
                            ->where('id_comic', $id)
                            ->orderBy('id_web', 'ASC')
                            ->get();

        }
        return view('pages.results.results')->with([
            'items' => $items,
            'comic' => $comic
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $webs = Web::all();
        $item = Result::with(['comic'])->find($id);

        return view('pages.results.form')->with([
            'item' => $item,
            'webs' => $webs
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ResultsRequest $request, $id)
    {
        $data = $request->all();

        $item = Result::findOrFail($id);
        $item->update($data);

        return redirect()->route('results.show', $data['id_comic']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // panggil model,jika datanya adamunculin, jika tidak masuk halaman 404
        $item = Result::findOrFail($id);
        $item->delete();
        // blikin user kehalaman sebelumnya
        return redirect()->route('results.show', $item->id_comic);
    }
}
