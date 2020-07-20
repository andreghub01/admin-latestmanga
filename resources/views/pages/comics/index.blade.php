@extends('layouts.admin')
@section('content')
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">List Comics</h6>
        </div>
        <div class="card-body">
            <a href="{{route('comics.create')}}" class="btn btn-outline-primary mb-2">Tambah Komik +</a>
             <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET">
                <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small"
                name="cari" placeholder="Cari Comics.." value="{{ old('cari') }}"
                autocomplete='off'
                aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
                </div>
            </form>
            <table class="table table-striped table-responsive">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @forelse ($items as $item)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$item->name}}</td>
                            <td>
                                {{$item->category->name}}
                            </td>
                            <td>
                                <img src="{{url('comics/'.$item->image)}}" alt="" style="width: 50px">
                            </td>
                            <td>
                                @if ($item->status == 1)
                                    <span class="badge badge-warning p-2">ON</span>
                                @else
                                    <span class="badge badge-danger p-2">OFF</span>
                                @endif

                            </td>
                            <td>
                                <a href="{{route('comics.edit', $item->id)}}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-fw fa-cog"></i>
                                </a>
                                <form action="{{route('comics.destroy', $item->id)}}" method="post" class="d-inline form-delete" id="form-delete">
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
                            <td class="6">Data Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
              </table>
              {{ $items->links() }}

        </div>
    </div>
@endsection
