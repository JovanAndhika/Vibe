@extends('user.layouts.user_main')
@section('container')

<div class="col scrollable-div p-4" id="jumphere">
    <div class="container-fluid d-flex flex-column">
        <div class="container-fluid flex-grow-1 p-5">

            <div class="container-fluid text-center mb-2">
                <h1 class="fontMonsseratExtraBold" style="font-size: 50px;">Home</h1>
            </div>

            <div class="container-fluid text-center mb-5">
                <h1 class="fontMonsseratRegular" style="font-size: 25px;">Greetings, {{ auth()->user()->username }} !
                </h1>
            </div>

            <div class="container-fluid text-center mb-3">
                <h1 class="fontMonsseratRegular" style="font-size: 18px;">Not sure what to listen yet? Here's list of
                    our songs.</h1>
            </div>

            <div class="container-fluid ">
                {{-- pengecekan search --}}
                @if ($musics->isEmpty())
                {{-- jika tidak ada music --}}
                <div class="container-fluid text-center">
                    <h1 class="fontMonsseratSemiBold" style="font-size: 20px;">No musics out yet. Stay tune!</h1>
                </div>
                @else
                {{-- jika ada music --}}
                <div class="container-fluid ">
                    <table class="table table-striped table-hover table-dark">
                        <thead>
                            <tr>
                                <th class="fontMonsseratSemiBold" scope="col"></th>
                                <th class="fontMonsseratSemiBold" scope="col">Song</th>
                                <th class="fontMonsseratSemiBold" scope="col">Artist</th>
                                <th class="fontMonsseratSemiBold" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="text-left">
                            @foreach ($musics as $music)
                            <tr>
                                <th><img src="{{ $music->icon ? asset($music->icon) : asset('img/now_playing/empty_icon.jpeg') }}"
                                        alt="Artist Photo"
                                        class="img-fluid rounded-3"
                                        style="max-width: 50px; max-height: 50px;"></th>
                                <th>{{ $music->title }}</th>
                                <th>{{ $music->artist }}</th>
                                <th><a href="{{ route('user.nowPlaying') }}?music_id={{ $music->id }}#jumphere"><i
                                            class="bi bi-play-fill text-white"></i></a></th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- pagination --}}
                    <div class="d-flex justify-content-center">
                        {{ $musics->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection