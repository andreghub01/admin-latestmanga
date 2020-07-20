@extends('layouts.admin')
@if(isset($item))
    @php
        $id = $item->id;
        $name = $item->name;
        $id_wordpress_tag = $item->id_wordpress_tag;
        $button = "Update";
        $action = route("tags.update",$id);
    @endphp
@else
    @php
        $id = false;
        $name = false;
        $id_wordpress_tag = false;
        $button = "Tambah";
        $action = route("tags.store");
    @endphp
@endif
@section('content')
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Form Tag</h6>
        </div>
        <div class="card-body">
            <form action="{{$action}}" method="POST" >
                @csrf
                @if ($id)
                    @method('PUT')
                @endif
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCity">Nama tag</label>
                    <input  type="text"
                    name="name"
                    value="{{ old('name') ? old('name') : $name }}"
                    class="form-control @error('name') is-invalid @enderror"  autocomplete='off'/>
                    @error('name') <div class="text-muted">{{ $message }}</div> @enderror
                  </div>
                  <div class="form-group col-md-4">
                    <label for="tagsite">Id Wordpress</label>
                    <input  type="number"
                    name="id_wordpress_tag"
                    value="{{ old('id_wordpress_tag') ? old('id_wordpress_tag') : $id_wordpress_tag }}"
                    class="form-control @error('id_wordpress_tag') is-invalid @enderror"  autocomplete='off'/>
                    @error('id_wordpress_tag') <div class="text-muted">{{ $message }}</div> @enderror
                  </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">{{$button}}</button>
              </form>
        </div>
    </div>
@endsection
