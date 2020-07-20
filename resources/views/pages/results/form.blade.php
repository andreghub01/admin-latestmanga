@extends('layouts.admin')
@if(isset($item))
    @php
        $id = $item->id;
        $comic = $item->comic;
        $id_web = $item->id_web;
        $short_url = $item->short_url;
        $last_chapter = $item->last_chapter;
        $regex = $item->regex;
        $last_update = $item->last_update;
        $date_scraping = $item->date_scraping;
        $status = $item->status;
        $button = "Update";
        $action = route("results.update",$id);
    @endphp
@else
    @php
        $id = false;
        $id_web = false;
        $short_url = '';
        $last_chapter = '';
        $regex = '';
        $last_update = '';
        $date_scraping = '';
        $status = '';
        $button = "Tambah";
        $action = route("results.store");
    @endphp
@endif
@section('content')
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Form Results</h6>
        </div>
        <div class="card-body">
            <form action="{{$action}}" method="POST">
                @csrf
                @if ($id)
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="exampleInputEmail1">Judul Komik</label>
                    <input class="form-control" type="text" placeholder="{{$comic->name}}" readonly>
                    <input class="form-control" type="hidden" name="id_comic" value="{{$comic->id}}">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputState">Web Competitor</label>
                        <select id="inputState" class="form-control" name="id_web">
                            @foreach ($webs as $webItem)
                                @php
                                    $web_status = $webItem->status == 1 ? "On" : "Off"
                                @endphp
                                @if ($webItem->id == $id_web)
                                    <option value="{{$webItem->id}}" selected>{{$webItem->url. " (". $web_status.")"}}</option>
                                @else
                                    <option value="{{$webItem->id}}" >{{$webItem->url. " (". $web_status.")"}}</option>
                                @endif

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="inputCity">Short Url</label>
                        <input  type="text"
                        name="short_url"
                        value="{{ old('short_url') ? old('short_url') : $short_url }}"
                        class="form-control @error('short_url') is-invalid @enderror"  autocomplete='off' placeholder="exmpl: /blabla/blabla"/>
                        <small id="emailHelp" class="form-text text-muted">Contoh: /manga/comic123</small>
                        @error('short_url') <div class="text-muted">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputState">Last Chapter</label>
                        <input  type="text"
                        name="last_chapter"
                        value="{{ old('last_chapter') ? old('last_chapter') : $last_chapter }}"
                        class="form-control @error('last_chapter') is-invalid @enderror" autocomplete='off'/>
                        @error('last_chapter') <div class="text-muted">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputCity">Regex</label>
                        <input  type="text"
                        name="regex"
                        value="{{ old('regex') ? old('regex') : $regex }}"
                        class="form-control @error('regex') is-invalid @enderror" autocomplete='off'/>
                        @error('regex') <div class="text-muted">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputState">Last Update</label>
                        <input  type="text"
                        name="last_update"
                        value="{{ old('last_update') ? old('last_update') : $last_update }}"
                        class="form-control @error('last_update') is-invalid @enderror" autocomplete='off'/>
                        @error('last_update') <div class="text-muted">{{ $message }}</div> @enderror
                    </div>
                    <div class="input-group date col-md-4">
                        <div class="form-group">
                            <label for="inputState">Date Scraping</label>
                            <div class="input-group-addon">
                               <span class="glyphicon glyphicon-th"></span>
                            </div>
                            <input placeholder="Tanggal Scraping" type="text" class="form-control datepicker" name="date_scraping"
                            value="{{ old('date_scraping') ? old('date_scraping') : $date_scraping }}" autocomplete='off'/>
                        </div>
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
                <button type="submit" class="btn btn-primary mt-2">{{$button}}</button>
              </form>
        </div>
    </div>
@endsection
@push('after-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush
@push('after-footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
 $(function(){
  $(".datepicker").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
  });
 });
</script>
@endpush
