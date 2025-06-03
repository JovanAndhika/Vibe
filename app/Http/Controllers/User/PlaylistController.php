<?php

namespace App\Http\Controllers\User;

use App\Models\Music;
use App\Models\Music_playlist;
use App\Models\Playlist;
use Illuminate\Http\Request;
use App\Models\PlaylistEntities;
use App\Http\Controllers\Controller;

class PlaylistController extends Controller {
    public function getAllMusics() {
        // jika ada request search
        $musics = collect([]);
        // cari data music berdasarkan judul
        $musics = Music::where('title', 'LIKE', "%".request('search')."%")
            ->orWhere('artist', 'LIKE', "%".request('search')."%")
            ->orderBy('release_date', 'desc')
            ->take(10)
            ->get();
        return $musics->toArray();
    }

    public function getAllPlaylist() {
        $music_id = request('music_id');
        $user_id = auth()->user()->id;

        // Retrieve all playlists owned by the current user
        $playlists = Playlist::where('user_id', $user_id)->get();

        // Add the 'is_added' attribute to each playlist
        foreach($playlists as &$playlist) {
            // Check if the current song is already in the playlist
            $is_added = Music_playlist::where('music_id', $music_id)
                ->where('playlist_id', $playlist->id)
                ->exists();

            $playlist->is_added = $is_added;
        }

        // If you want to convert the result to an array, you can use toArray()
        $playlistsArray = $playlists->toArray();

        // If you want to return the playlists as JSON
        return response()->json($playlistsArray);
    }

    public function updateMusic() {
        $music_id = request('music_id');
        $playlist_id = request('playlist_id');
        $is_added = request('is_added');

        if($is_added == 'false') {
            // jika sudah ada, maka hapus
            Music_playlist::where('music_id', $music_id)
                ->where('playlist_id', $playlist_id)
                ->delete();
            return response()->json(['message' => 'Successfully removed from playlist']);
        } else {
            // jika belum ada, maka tambahkan
            Music_playlist::create([
                'music_id' => $music_id,
                'playlist_id' => $playlist_id
            ]);
            return response()->json(['message' => 'Successfully added to playlist']);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        // menambahkan variable first music cover ke dalam collection playlists
        $playlists = Playlist::where('user_id', auth()->user()->id)->get();
        foreach($playlists as $playlist) {
            // jika merupakan liked music, hard code mengarah ke cover liked music
            if($playlist->name == 'liked songs') {
                $playlist->first_music_cover = 'img/liked-music.png';
                continue;
            }

            $musics = $playlist->musics;
            $icon = null;

            // cek isi semua lagu
            foreach($musics as $music) {
                // jika ada icon, maka jadikan icon
                if($music->icon != null) {
                    $icon = $music->icon;
                    break;
                }
            }

            // simpan ke dalam collection
            $playlist->first_music_cover = $icon;
        }

        return view('user.library', [
            "title" => "library",
            "active" => "library",
            "playlists" => $playlists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in public.
     */
    public function store(Request $request) {
        $request->validate([
            'playlist_name' => 'required|string|max:255',
            'selected_songs' => 'required|string'
        ]);

        // fetch data
        $playlistName = $request->input('playlist_name');
        $selectedSongs = json_decode($request->input('selected_songs'), true);

        // create playlist
        $playlist = Playlist::create([
            'name' => $playlistName,
            'user_id' => auth()->user()->id
        ]);

        // attach selected songs
        $playlist->musics()->attach($selectedSongs);

        return redirect()->back()->with('success', 'Playlist created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist) {
        return [
            'playlist' => $playlist,
            'musics' => $playlist->musics
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist) {
        //
    }

    /**
     * Update the specified resource in public.
     */
    public function update(Request $request, Playlist $playlist) {
        // Validate
        $request->validate([
            'playlist_name' => 'required|string|max:255',
            'selected_songs' => 'required|string'
        ]);

        // Fetch data
        $playlistName = $request->input('playlist_name');
        $selectedSongs = json_decode($request->input('selected_songs'), true);

        // Update playlist
        $playlist->update([
            'name' => $playlistName,
        ]);

        // Sync selected songs
        $playlist->musics()->sync($selectedSongs);

        return redirect()->back()->with('success', 'Playlist updated successfully!');
    }


    /**
     * Remove the specified resource from public.
     */
    public function destroy(Playlist $playlist) {
        $playlist->delete();
        return redirect()->back()->with('success', 'Playlist deleted successfully!');
    }
}
