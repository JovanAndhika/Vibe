@extends('user.layouts.user_main')
@section('container')
    <div class="col scrollable-div p-4" id="jumphere">
        <div class="container-fluid vh-100 d-flex flex-column">
            <div class="container-fluid flex-grow-1 p-5">

                <div class="container-fluid text-center mb-5">
                    <h1 class="fontMonsseratExtraBold" style="font-size: 50px;">Your History</h1>
                </div>

               

         



                <div class="container-fluid scrollable-div">
                    @foreach ($histories as $key => $history)
                        <div class="container-fluid text-left mb-5" id= "2">
                            <h4 class="fontMonsseratSemiBold mb-3">{{ $key }}</h4>
                            <table class="table table-striped table-hover table-dark fontMonsseratRegular">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Song</th>
                                        <th scope="col">Artist</th>
                                        <th scope="col">Last Played</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($history as $ok => $item)
                                        @if ($item->music)
                                        <tr>
                                            <th><img src="@if ($item->music->icon) {{ asset($item->music->icon) }} @else {{ asset('img/now_playing/empty_icon.jpeg') }} @endif"alt="Artist Photo" class="img-fluid rounded-3" style="max-width: 50px; max-height: 50px;"></th>
                                            <th>{{ $item->music->title }}</th>
                                            <th>{{ $item->music->artist }}</th>
                                            <th>{{ $ok }}</th>
                                            <th><a href="{{ route('user.nowPlaying') }}?music_id={{ $item->music->id }}#jumphere"><i
                                                class="bi bi-play-fill text-white"></i></a></th>
                                        </tr>
                                        @endif
                                    @endforeach




                                </tbody>
                            </table>
                        </div>
                    @endforeach


                </div>


            </div>



        </div>
    </div>
@endsection
