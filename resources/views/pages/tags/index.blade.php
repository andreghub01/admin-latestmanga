@extends('layouts.admin')
@section('content')
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tags Comic</h6>
        </div>
        <div class="card-body">
            <a href="{{route('tags.create')}}" class="btn btn-outline-primary mb-2">Tambah Tag +</a>
            <table class="table table-striped table-responsive">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Id Wordpress</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @forelse ($items as $item)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$item->name}}</td>
                            <td class="text-center">{{$item->id_wordpress_tag}}</td>
                            <td>
                                <a href="{{route('tags.edit', $item->id)}}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-fw fa-cog"></i>
                                </a>
                                {{-- <form action="{{route('tags.destroy', $item->id)}}" method="post" class="d-inline form-delete" id="form-delete">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td class="4">Data Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
              </table>
        </div>
    </div>
@endsection
