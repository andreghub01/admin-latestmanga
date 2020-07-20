@extends('layouts.admin')
@if(isset($item))
    @php
        $id = $item->id;
        $name = $item->name;
        $status = $item->status;
        $id_category = $item->id_category;
        $id_wordpress = $item->id_wordpress;
        $id_wordpress_media = $item->id_wordpress_media;
        $content = $item->content;
        $alternative = $item->alternative;
        $author = $item->author;
        $language = $item->language;
        $detail_status = $item->detail_status;
        $genres = $item->genres;
        $rating = $item->rating;
        $views = $item->views;
        $image = $item->image;
        $button = "Update";
        $action = route("comics.update",$id);
    @endphp
@else
    @php
        $id = false;
        $name = false;
        $status = false;
        $id_category = false;
        $id_wordpress = false;
        $id_wordpress_media = false;
        $content = false;
        $alternative = false;
        $author = false;
        $language = false;
        $detail_status = false;
        $genres = false;
        $rating = false;
        $views = false;
        $image = false;
        $button = "Tambah";
        $action = route("comics.store");
    @endphp
@endif
@section('content')
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Form Comics</h6>
        </div>
        <div class="card-body">
            <form action="{{$action}}" method="POST" >
                @csrf
                @if ($id)
                    @method('PUT')
                    <input type="hidden" name="id_wordpress" value="{{$id_wordpress}}">
                    <input type="hidden" name="id_wordpress_media" value="{{$id_wordpress_media}}">
                @endif
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCity">Nama Komik</label>
                    <input  type="text"
                    name="name"
                    value="{{ old('name') ? old('name') : $name }}"
                    class="form-control @error('name') is-invalid @enderror"  autocomplete='off'/>
                    @error('name') <div class="text-muted">{{ $message }}</div> @enderror
                  </div>
                  <div class="form-group col-md-2">
                    <label for="inputState">Status</label>
                    <select id="inputState" class="form-control" name="status">
                        @if ($status == 1)
                            <option value="1" selected>ON</option>
                            <option value="0" >OFF</option>

                        @else
                            <option value="0" selected>OFF</option>
                            <option value="1" >ON</option>
                        @endif
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="category">Kategori</label>
                    <select id="inputState" class="form-control" name="id_category">
                        @foreach ($category as $c)
                            @if ($c->id == $id_category)
                                <option value="{{$c->id}}" selected>{{$c->name}}</option>
                            @else
                                <option value="{{$c->id}}" >{{$c->name}}</option>
                            @endif

                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                    <label for="inputCity">Gambar Komik</label>
                    <input  type="text"
                    name="image"
                    value="{{ old('image') ? old('image') : $image }}"
                    class="form-control @error('image') is-invalid @enderror"  autocomplete='off'/>
                    @error('image') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">{{$button}}</button>
        </div>
    </div>

    {{-- Detail Comics --}}

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Form Comics</h6>
        </div>
        <div class="card-body">
                <div class="form-group">
                    <label for="inputCity">Sipnosis Komik</label>
                    <textarea name="content" class="form-control @error('name') is-invalid @enderror">{{ old('content') ? old('content') : $content }}</textarea>
                    @error('content') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="alternative">Alternative</label>
                    <input  type="text"
                    name="alternative"
                    value="{{ old('alternative') ? old('alternative') : $alternative }}"
                    class="form-control @error('alternative') is-invalid @enderror"  autocomplete='off'/>
                    @error('alternative') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="author">Author</label>
                    <input  type="text"
                    name="author"
                    value="{{ old('author') ? old('author') : $author }}"
                    class="form-control @error('author') is-invalid @enderror"  autocomplete='off'/>
                    @error('author') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="language">Language</label>
                    <input  type="text"
                    name="language"
                    value="{{ old('language') ? old('language') : $language }}"
                    class="form-control @error('language') is-invalid @enderror"  autocomplete='off'/>
                    @error('language') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="detail_status">Detail Status</label>
                    <input  type="text"
                    name="detail_status"
                    value="{{ old('detail_status') ? old('detail_status') : $detail_status }}"
                    class="form-control @error('detail_status') is-invalid @enderror"  autocomplete='off'/>
                    @error('detail_status') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="genres">Genres</label>
                    <input  type="text"
                    name="genres"
                    value="{{ old('genres') ? old('genres') : $genres }}"
                    class="form-control @error('genres') is-invalid @enderror"  autocomplete='off'/>
                    @error('genres') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label for="rating">Rating</label>
                        <input  type="number"
                        name="rating"
                        value="{{ old('rating') ? old('rating') : $rating }}"
                        class="form-control @error('rating') is-invalid @enderror"  autocomplete='off'/>
                        @error('rating') <div class="text-muted">{{ $message }}</div> @enderror

                    </div>
                    <div class="col-6">
                        <label for="views">Views</label>
                        <input  type="text"
                        name="views"
                        value="{{ old('views') ? old('views') : $views }}"
                        class="form-control @error('views') is-invalid @enderror"  autocomplete='off'/>
                        @error('views') <div class="text-muted">{{ $message }}</div> @enderror

                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">{{$button}}</button>
              </form>
        </div>
    </div>
@endsection
