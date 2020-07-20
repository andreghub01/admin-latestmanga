<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComicsRequest;
use App\Models\Category;
use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari = $request->input('cari');
        $items = Comic::with('category')
                        ->where('name','like',"%".$cari."%")
                        ->paginate(10);

        return view('pages.comics.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('pages.comics.form')->with([
            'category' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComicsRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['image']= isset($data['image'])? $data['image'] : "";
        $data['id_wordpress'] = isset($data['id_wordpress'])? $data['id_wordpress'] : 0;
        $data['id_wordpress_media']= isset($data['id_wordpress_media'])? $data['id_wordpress_media'] : 0;

        Comic::create($data);
        return redirect()->route('comics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Comic::findOrFail($id);
        $category = Category::all();
        return view('pages.comics.form', [
            'item' => $item,
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['image']= isset($data['image'])? $data['image'] : "";
        $data['id_wordpress'] = isset($data['id_wordpress'])? $data['id_wordpress'] : 0;
        $data['id_wordpress_media']= isset($data['id_wordpress_media'])? $data['id_wordpress_media'] : 0;

        $item = Comic::findOrFail($id);
        $item->update($data);

        return redirect()->route('comics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Comic::findOrFail($id);
        $item->delete();

        return redirect()->route('comics.index');
    }
}
