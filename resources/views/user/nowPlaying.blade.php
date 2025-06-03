@extends('user.layouts.user_main')
@section('container')
    <div class="col scrollable-div p-4" id="jumphere">
        <div class="container-fluid vh-100 d-flex flex-column">
            {{-- MUSIC SECTION --}}
            @if (isset($music))
                {{-- Playlist Name --}}
                @if (isset($playlist))
                    <div class="row d-flex justify-content-center">
                        <h1 class="fontMonsseratSemiBold text-center text-warning" style="font-size: 30px;">Playlist : <span
                                class="text-white">{{ $playlist->name }}</span></h1>
                    </div>
                @endif

                {{-- Music Cover --}}
                <div class="row flex-grow-1">
                    <div class="col d-flex align-items-center justify-content-center m-3">
                        <img src="@if ($music->icon) {{ asset('storage/' . $music->icon) }} @else {{ asset('img/now_playing/empty_icon.jpeg') }} @endif"
                            alt="Artist Photo" class="img-fluid rounded-3" style="max-width: 500px; max-height: 500px;">
                    </div>
                </div>

                {{-- Title --}}
                <div class="row d-flex justify-content-center">
                    <h1 class="fontMonsseratSemiBold text-center" style="font-size: 30px;" id="myTitle">
                        {{ $music->title }}
                    </h1>
                </div>

                {{-- Artist --}}
                <div class="row d-flex justify-content-center">
                    <h1 class="fontMontserratThin text-center text-white-50" style="font-size: 12px;" id="myArtist">
                        {{ $music->artist }}
                    </h1>
                </div>

                <div class="row">
                    <div class="col d-flex justify-content-center my-3" style="font-size: 30px;">
                        {{-- Bookmark --}}
                        <a data-id="{{ $music->id }}" data-bs-toggle="modal" data-bs-target="#bookmark-modal"
                            id="bookmark-btn"><i class="bi bi-bookmark-fill mx-3"></i></a>

                        {{-- Audio --}}
                        <audio controls autoplay>
                            <source src="{{ asset('storage/' . $music->file_path) }}" type="audio/mpeg" id="myAudio">
                        </audio>

                        {{-- Like --}}
                        <form action="{{ route('user.addlike', ['music' => $music]) }}" method="post">
                            @method('post')
                            @csrf
                            <button type="submit" name="addlike" id="addlike"
                                style="background: none; color: inherit; border: none; padding: 0;"><i
                                    class="bi @if ($isLiked) bi-heart-fill @else bi-heart @endif mx-3"></i></button>
                        </form>
                    </div>
                </div>

                {{-- PLAYLIST TABLE --}}
                @if (isset($playlist))
                    @csrf
                    <div class="container-fluid text-left mb-5" id="2">
                        <table class="table table-striped table-hover table-dark fontMonsseratRegular">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col">Song</th>
                                    <th scope="col">Artist</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($musics as $item)
                                    <tr>
                                        <th><img src="@if ($item->icon) {{ asset($item->icon) }} @else {{ asset('img/now_playing/empty_icon.jpeg') }} @endif"alt="Artist Photo"
                                                class="img-fluid rounded-3" style="max-width: 50px; max-height: 50px;"></th>
                                        <th>{{ $item->title }}</th>
                                        <th>{{ $item->artist }}</th>
                                        <th><a
                                                href="{{ route('user.nowPlaying') . '/?playlist_id=' . request('playlist_id') . '&index=' . $loop->index }}"><i
                                                    class="bi bi-play-fill text-white"></i></a></th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <script></script>
                @endif

            {{-- WITHOUT MUSIC SECTION --}}
            @else
                <div class="container-fluid text-center my-5">
                    <h1 class="fontMonsseratSemiBold" style="font-size: 20px;">No Music Currently Playing. Play your first
                        music <a href="{{ route('user.index') }}" class="text-warning"> now!</a></h1>
                </div>
            @endif
        </div>
    </div>

    {{-- MODAL --}}
    @include('user.partials.modalBookmark')
@endsection
