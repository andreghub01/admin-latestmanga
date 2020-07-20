@extends('layouts.admin')
@section('content')
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">{{$comic->name}} <span class="badge badge-primary">Status : {{$comic->status == 1 ? 'Tayang' : 'Tidak Tayang'}}</span></h6>
        </div>
        <div class="card-body">
            <a href="{{route('results.create').'?id_comic='.$comic->id}}" class="btn btn-primary mb-2">Tambah List +</a>
            <a href="{{route('results.index')}}" class="btn btn-outline-primary mb-2">Kembali</a>
            <a href="{{route('results.show', $comic->id).'?orderby=regex'}}" class="btn btn-outline-success mb-2">Regex (Desc)</a>
            <a href="{{route('results.show', $comic->id).'?orderby=date_scraping'}}" class="btn btn-outline-success mb-2">Date Ccraping (Desc)</a>

            <table class="table table-striped table-responsive">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Web</th>
                    <th scope="col">Last Chapter</th>
                    <th scope="col">Last Update</th>
                    <th scope="col">Date Scraping</th>
                    <th scope="col">Regex</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @forelse ($items as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            {{ $item['web']['name'] }}
                            <p>web : {{$item['web']['status'] == 1 ? 'Tayang' : 'Tidak Tayang'}}</p>
                        </td>
                        <td>{{ $item['last_chapter'] }}</td>
                        <td>{{ $item['last_update'] }}</td>
                        <td>{{ $item['date_scraping'] }}</td>
                        <td>
                            <a href="http://{{ $item['web']['url'].$item['short_url'] }}" target="_blank">
                                {{ $item['regex'] }}
                            </a>
                        </td>
                        <td>
                            @if ($item->status == 1)
                                <span class="badge badge-warning">Tayang</span>
                            @else
                                <span class="badge badge-danger">Tidak Tayang</span>
                            @endif

                        </td>
                        <td>
                            <a href="{{route('results.edit', $item->id)}}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-fw fa-cog"></i>
                            </a>
                            <form action="{{route('results.destroy', $item->id)}}" method="post" class="d-inline form-delete" id="form-delete">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    @empty
                        <tr>
                            <td class="text-center" colspan="8">Data Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
              </table>
        </div>
    </div>
@endsection
