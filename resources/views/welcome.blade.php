<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                /* height: 100vh; */
                margin: 0;
            }

            .full-height {
                /* height: 100vh; */
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 10px;
            }

            .pagination {
                justify-content: center;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/') }}">Home</a>
                        @if (Auth::user()->roles == "ADMIN")
                            <a href="{{ url('/admin') }}">DASHBOARD</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Last Chapter
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                    <div class="mt-2">
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
                    </div>
                </div>

                <table class="table table-striped text-left mt-2">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Komik</th>
                        <th scope="col">1</th>
                        <th scope="col">2</th>
                        <th scope="col">3</th>
                      </tr>
                    </thead>
                    <tbody class="">
                        <?php $i = 1 ?>
                        @foreach ($items as $item)
                            @php
                                $results = App\Models\Result::whereHas('web', function ($query) {
                                                                return $query->where('status', '=', 1);
                                                                })
                                                            ->with(['web'])
                                                            ->where(['id_comic'=> $item->id, 'status'=> 1])
                                                            ->orderBy('regex', 'DESC')
                                                            ->take(3)
                                                            ->get(['id','id_comic','id_web','short_url','last_chapter','regex','date_scraping']);
                            @endphp
                                <tr>
                                    <th>{{$i++}}</th>
                                    <th scope="row">{{$item->name}}</th>
                                    @forelse ($results as $result)
                                        <td> <a href="http://{{$result->web->url.$result->short_url}}">{{$result->regex}}</a></td>
                                    @empty
                                        <td colspan="3"> Kosong </td>
                                    @endforelse
                                </tr>
                        @endforeach
                    </tbody>
                  </table>
                      {{ $items->links() }}
            </div>
        </div>
    </body>
</html>
