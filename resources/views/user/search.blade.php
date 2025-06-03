@extends('user.layouts.user_main')
@section('container')
    <div class="col scrollable-div p-4" id="jumphere">
        <div class="container-fluid d-flex flex-column">
            <div class="container-fluid flex-grow-1 p-5">

                <div class="container-fluid text-center mb-5">
                    <h1 class="fontMonsseratExtraBold" style="font-size: 50px;">Search</h1>
                </div>

                <div class="container-fluid text-center justify-content-center align-content-center flex-nowrap mb-4">
                    {{-- Search --}}
                    <form method="get" action="{{ route('user.search') }}" id="searchForm">
                        <input type="text" class="form-control fontMonsseratRegular" placeholder="What to listen to?"
                            aria-label="Username" aria-describedby="addon-wrapping" id="searchKeyword" name="keyword"
                            value="{{ request('keyword') }}">
                    </form>

                </div>

                {{-- button search --}}
                <div class="container-fluid d-flex justify-content-center text-center mb-5">
                    <div class="container-fluid">
                        <div class="btn-group fontMonsseratExtraBold">
                            <button type="button" class="btn btn-outline-light" id="search-artist">Search by
                                Artist</button>
                            <button type="button" class="btn btn-outline-light" id="search-title">Search by Title</button>

                            {{-- script untuk set value input hidden searchBy dan submit --}}
                            <script>
                                $(document).ready(function() {
                                    form = $("#searchForm");
                                    $("#search-artist").click(function() {
                                        // create new hidden input
                                        var input = $("<input>")
                                            .attr("type", "hidden")
                                            .attr("name", "searchBy").val("artist");

                                        // Submit the form
                                        form.append(input).submit();
                                    });

                                    $("#search-title").click(function() {
                                        // create new hidden input
                                        var input = $("<input>")
                                            .attr("type", "hidden")
                                            .attr("name", "searchBy").val("title");

                                        // Submit the form
                                        form.append(input).submit();
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>

                {{-- pengecekan search --}}
                @if (request()->has('keyword'))
                    @if ($musics->isEmpty())
                        {{-- jika hasil search music belum ada --}}
                        <div class="container-fluid text-center">
                            <h1 class="fontMonsseratSemiBold" style="font-size: 20px;">No results found</h1>
                        </div>
                    @else
                        {{-- jika hasil search music ada --}}
                        {{-- judul --}}
                        <div class="container-fluid text-center">
                            <h1 class="fontMonsseratSemiBold" style="font-size: 20px;">Results</h1>
                        </div>

                        {{-- TODO: ubah menjadi cards, bukan table --}}
                        {{-- tabel --}}
                        <div class="container-fluid ">
                            <table class="table table-striped table-hover table-dark">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="fontMonsseratSemiBold" scope="col">Song</th>
                                        <th class="fontMonsseratSemiBold" scope="col">Artist</th>
                                        <th class="fontMonsseratSemiBold" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-left">
                                    @foreach ($musics as $music)
                                        <tr>
                                            <th><img src="@if ($music->icon) {{ asset($music->icon) }} @else {{ asset('img/now_playing/empty_icon.jpeg') }} @endif"alt="Artist Photo"
                                                    class="img-fluid rounded-3" style="max-width: 50px; max-height: 50px;">
                                            </th>
                                            <th>{{ $music->title }}</th>
                                            <th>{{ $music->artist }}</th>
                                            <th><a href="{{ route('user.nowPlaying') }}?music_id={{ $music->id }}"><i
                                                        class="bi bi-play-fill text-white"></i></a></th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- pagination --}}
                        {{-- TODO: rapikan pagination --}}
                        <div class="d-flex justify-content-center">
                            {{ $musics->links() }}
                        </div>
                    @endif
                @endif

                {{-- genre --}}
                <div class="container-fluid my-3">
                    <div class="row h-100" id="mainRow">
                        <style>
                            .uppercase {
                                text-transform: uppercase;
                            }

                            .btn-genre {
                                background: none;
                                color: inherit;
                                border: none;
                                padding: 0;
                            }
                        </style>

                        <div class="col-lg-3 col-md-4 col-sm-6 my-3" style="height: 150px;">
                            <form id="myForm" method="post" action="{{ route('user.jazz') }}">
                                <div class="card text-dark text-center genre" onclick="this.parentNode.submit()">
                                    <div class="card-body text-center align-items-center justify-content-center"
                                        style="height: 150px;">
                                        @csrf
                                        @method('post')
                                        <h4 class=" mt-5 uppercase fontMonsseratExtraBold ">JAZZ</h4>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 my-3" style="height: 150px;">
                            <form id="myForm2" method="post" action="{{ route('user.pop') }}">
                                <div class="card text-dark text-center genre" onclick="this.parentNode.submit()">
                                    <div class="card-body text-center align-items-center justify-content-center"
                                        style="height: 150px;">
                                        @csrf
                                        @method('post')
                                        <h4 class=" mt-5 uppercase fontMonsseratExtraBold ">pop</h4>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="col-lg-3 col-md-4 col-sm-6 my-3" style="height: 150px;">
                            <form id="myForm2" method="post" action="{{ route('user.dangdut') }}">
                                <div class="card text-dark text-center genre" onclick="this.parentNode.submit()">
                                    <div class="card-body text-center align-items-center justify-content-center"
                                        style="height: 150px;">
                                        @csrf
                                        @method('post')
                                        <h4 class=" mt-5 uppercase fontMonsseratExtraBold ">dangdut</h4>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 my-3" style="height: 150px;">
                            <form id="myForm2" method="post" action="{{ route('user.kpop') }}">
                                <div class="card text-dark text-center genre" onclick="this.parentNode.submit()">
                                    <div class="card-body text-center align-items-center justify-content-center"
                                        style="height: 150px;">
                                        @csrf
                                        @method('post')
                                        <h4 class=" mt-5 uppercase fontMonsseratExtraBold ">kpop</h4>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 my-3" style="height: 150px;">
                            <form id="myForm2" method="post" action="{{ route('user.dangdut') }}">
                                <div class="card text-dark text-center genre" onclick="this.parentNode.submit()">
                                    <div class="card-body text-center align-items-center justify-content-center"
                                        style="height: 150px;">
                                        @csrf
                                        @method('post')
                                        <h4 class=" mt-5 uppercase fontMonsseratExtraBold ">dangdut</h4>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 my-3" style="height: 150px;">
                            <form id="myForm2" method="post" action="{{ route('user.rock') }}">
                                <div class="card text-dark text-center genre" onclick="this.parentNode.submit()">
                                    <div class="card-body text-center align-items-center justify-content-center"
                                        style="height: 150px;">
                                        @csrf
                                        @method('post')
                                        <h4 class=" mt-5 uppercase fontMonsseratExtraBold ">rock</h4>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 my-3" style="height: 150px;">
                            <form id="myForm2" method="post" action="{{ route('user.classical') }}">
                                <div class="card text-dark text-center genre" onclick="this.parentNode.submit()">
                                    <div class="card-body text-center align-items-center justify-content-center"
                                        style="height: 150px;">
                                        @csrf
                                        @method('post')
                                        <h4 class=" mt-5 uppercase fontMonsseratExtraBold ">classical</h4>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 my-3" style="height: 150px;">
                            <form id="myForm2" method="post" action="{{ route('user.ponk') }}">
                                <div class="card text-dark text-center genre" onclick="this.parentNode.submit()">
                                    <div class="card-body text-center align-items-center justify-content-center"
                                        style="height: 150px;">
                                        @csrf
                                        @method('post')
                                        <h4 class=" mt-5 uppercase fontMonsseratExtraBold ">ponk</h4>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- additional genre from admin --}}
                        @foreach ($newgenres as $newgenre)
                            <div class="col-lg-3 col-md-4 col-sm-6 my-3" style="height: 150px;">
                                <form id="myForm2" method="post"
                                    action="{{ route('user.newgenre', ['newgenre' => $newgenre]) }}">
                                    <div class="card text-dark text-center genre" onclick="this.parentNode.submit()">
                                        <div class="card-body text-center align-items-center justify-content-center"
                                            style="height: 150px;">
                                            @csrf
                                            @method('post')
                                            <h4 class=" mt-5 uppercase fontMonsseratExtraBold ">{{ $newgenre->new_genre }}
                                            </h4>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- discover playlist from admin --}}
                <div class="container-fluid my-3">
                    <div class="row h-100" id="mainRow">
                        <h2 class="text-white">Discover Playlists</h2>
                        @include('user.partials.modalDiscoverPlaylist')
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- untuk randomizer body color playlist --}}
    <script>
        window.onload = function() {
            var colors = ['#8ADAB2', 'orange', 'yellow', 'green', '#DF826C', '#8ACDD7', 'violet'];
            var cards = document.getElementsByClassName('card-body');
            for (var i = 0; i < cards.length; i++) {
                var random_color = colors[Math.floor(Math.random() * colors.length)];
                cards[i].style.backgroundColor = random_color;
            }
        }
    </script>
@endsection
