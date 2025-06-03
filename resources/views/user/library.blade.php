@extends('user.layouts.user_main')
@section('container')
    <div class="col scrollable-div p-4 " id="jumphere">
        <div class="container-fluid vh-100 d-flex flex-column">
            <div class="container-fluid flex-grow-1 p-5">
                <div class="container-fluid text-center">
                    <h1 class="fontMonsseratExtraBold" style="font-size: 50px;">Your Playlists</h1>
                </div>

                {{-- flash card --}}
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <div class="container-fluid text-center my-5">
                    <button type="button" class="btn btn-outline-light fontMonsseratSemiBold" data-bs-toggle="modal"
                        data-bs-target="#createPlaylistModal">Add Playlist</button>
                    @include('user.partials.modalPlaylist')
                </div>

                <div class="container-fluid">
                    @if ($playlists->isEmpty())
                        <div class="container-fluid text-center p-3">
                            <h1 class="fontMonsseratSemiBold" style="font-size: 30px;">You don't have any playlist yet. Try
                                creating new one!
                            </h1>
                        </div>
                    @else
                        <div class="row justify-content-evenly">
                            @foreach ($playlists as $playlist)
                                {{-- playlist card --}}
                                <div class="col-xl-4 col-lg-6 d-flex justify-content-center g-5">
                                    <div class="card bg-dark text-white border-secondary" style="min-width: 200px; max-width: 300px; border-radius: 1rem">
                                        {{-- playlist cover --}}
                                        <img src="@if ($playlist->name == 'liked songs') {{ asset($playlist->first_music_cover) }} @elseif($playlist->first_music_cover != null) {{ asset( $playlist->first_music_cover) }} @else {{ asset('img/now_playing/empty_icon.jpeg') }} @endif"
                                            class="card-img-top" alt="Playlist's Cover" style="border-radius: 1rem 1rem 0 0">

                                        <div class="card-body">
                                            {{-- playlist title --}}
                                            <h6 class="card-title text-center fontMonsseratSemiBold">{{ $playlist->name }}
                                            </h6>

                                            <div class="d-flex justify-content-center">
                                                {{-- edit --}}
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editPlaylistModal"
                                                    class="text-decoration-none text-white"
                                                    onclick="loadItem({{ $playlist->id }})"><i
                                                        class="bi bi-pen-fill fs-4 mx-3"></i></a>

                                                {{-- delete --}}
                                                @if ($playlist->name != 'liked songs')
                                                    <a href="#" class="text-decoration-none text-white"
                                                        onclick="deletePlaylist({{ $playlist->id }})" data-bs-toggle="modal"
                                                        data-bs-target="#deletePlaylist">
                                                        <i class="bi bi-trash-fill fs-4 mx-3"></i>
                                                    </a>
                                                @endif

                                                {{-- play --}}
                                                <a href="{{ route('user.nowPlaying') . '?playlist_id=' . $playlist->id }}&index=0"
                                                    class="text-white"><i class="bi bi-play-fill fs-4 mx-3"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
