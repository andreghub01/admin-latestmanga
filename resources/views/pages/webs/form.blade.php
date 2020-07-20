@extends('layouts.admin')
@if(isset($item))
    @php
        $id = $item->id;
        $name = $item->name;
        $url = $item->url;
        $xpath_chapter = $item->xpath_chapter;
        $xpath_last_update = $item->xpath_last_update;
        $status = $item->status;
        $button = "Update";
        $action = route("webs.update",$id);
    @endphp
@else
    @php
        $id = false;
        $name = false;
        $url = false;
        $xpath_chapter = false;
        $xpath_last_update = false;
        $status = false;
        $button = "Tambah";
        $action = route("webs.store");
    @endphp
@endif
@section('content')
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Form Web</h6>
        </div>
        <div class="card-body">
            <form action="{{$action}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($id)
                    @method('PUT')
                @endif
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCity">Nama Web</label>
                    <input  type="text"
                    name="name"
                    value="{{ old('name') ? old('name') : $name }}"
                    class="form-control @error('name') is-invalid @enderror"  autocomplete='off'/>
                    @error('name') <div class="text-muted">{{ $message }}</div> @enderror
                  </div>
                  <div class="form-group col-md-4">
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
                </div>
                <div class="custom-file">
                    <label for="website">Url Website</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">http://</div>
                        </div>
                        <input  type="text"
                        name="url"
                        value="{{ old('url') ? old('url') : $url }}"
                        class="form-control @error('url') is-invalid @enderror"  autocomplete='off'/>
                    </div>
                    @error('url') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="custom-file mt-4">
                    <label for="xpath">Xpath Chapter</label>
                    <input  type="text"
                    name="xpath_chapter"
                    value="{{ old('xpath_chapter') ? old('xpath_chapter') : $xpath_chapter }}"
                    class="form-control @error('xpath_chapter') is-invalid @enderror"  autocomplete='off'/>
                    @error('xpath_chapter') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="custom-file mt-4">
                    <label for="">Xpath Last Update</label>
                    <input  type="text"
                    name="xpath_last_update"
                    value="{{ old('xpath_last_update') ? old('xpath_last_update') : $xpath_last_update }}"
                    class="form-control @error('xpath_last_update') is-invalid @enderror"  autocomplete='off'/>
                    @error('xpath_last_update') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">{{$button}}</button>
              </form>
        </div>
    </div>
@endsection
