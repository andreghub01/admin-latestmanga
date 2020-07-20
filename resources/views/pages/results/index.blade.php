@extends('layouts.admin')
@section('content')
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">List Comics</h6>
        </div>
        <div class="card-body">
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
            <table class="table table-striped table-responsive mt-3">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Results</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">View</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @forelse ($items as $item)
                        <tr>
                            <th scope="row"> {{$i++}}</th>
                            <td> {{$item->name}}</td>
                            <td>
                                {{count($item->result)}} Webs
                            </td>
                            <td>
                                <img src="{{url('comics/'.$item->image)}}" alt="" style="width: 50px">
                            </td>
                            <td>
                                @if ($item->status == 1)
                                    <span class="badge badge-warning">Tayang</span>
                                @else
                                    <span class="badge badge-danger">Tidak Tayang</span>
                                @endif

                            </td>
                            <td>
                                <a href="{{route('results.show', $item->id)}}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-fw fa-cog"></i>
                                </a>
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
