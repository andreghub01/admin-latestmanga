@extends('layouts.admin')
@section('content')
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">List Webs</h6>
        </div>
        <div class="card-body">
            <a href="{{route('webs.create')}}" class="btn btn-outline-primary mb-2">Tambah Web +</a>
            <table class="table table-striped table-responsive">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Url</th>
                    <th scope="col">Xpath Chapter</th>
                    <th scope="col">Xpath Last Update</th>
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
                            <td>{{$item->url}}</td>
                            <td>{{$item->xpath_chapter}}</td>
                            <td>{{$item->xpath_last_update}}</td>
                            <td>
                                @if ($item->status == 1)
                                    <span class="badge badge-warning p-2">ON</span>
                                @else
                                    <span class="badge badge-danger p-2">OFF</span>
                                @endif

                            </td>
                            <td>
                                <a href="{{route('webs.edit', $item->id)}}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-fw fa-cog"></i>
                                </a>
                                <form action="{{route('webs.destroy', $item->id)}}" method="post" class="d-inline form-delete" id="form-delete">
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
                            <td class="3">Data Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
              </table>
        </div>
    </div>
@endsection
