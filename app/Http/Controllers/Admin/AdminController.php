<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Music;
use App\Models\Newgenre;
use App\Models\Discovery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AdminController extends Controller
{
    //Controller Admin
    public function index()
    {
        $musics = Music::all();
        return view('adminCRUD.adminHome', ['musics' => $musics]);
    }


    public function add_song()
    {
        $data = Newgenre::all();
        return view('adminCRUD.addsong', ['newgenres' => $data]);
    }


    public function store_song(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'genre' => 'required',
            'chfile' => 'required|file|mimes:mp3,wav,ogg|max:1500',
            'icon' => 'nullable|image|file|max:1500',
            'release_date' => 'required|date',
        ]);

        // Upload audio ke Cloudinary
        if ($request->hasFile('chfile')) {
            $uploadAudio = Cloudinary::upload(
                $request->file('chfile')->getRealPath(),
                [
                    'resource_type' => 'auto',
                    'folder' => 'songs/audio',
                ]
            );

            $data['file_path'] = $uploadAudio->getSecurePath();     // URL
            $data['file_public_id'] = $uploadAudio->getPublicId();  // ID untuk penghapusan
        }

        // Upload icon ke Cloudinary
        if ($request->hasFile('icon')) {
            $uploadIcon = Cloudinary::upload(
                $request->file('icon')->getRealPath(),
                [
                    'folder' => 'songs/icons',
                ]
            );

            $data['icon'] = $uploadIcon->getSecurePath();            // URL
            $data['icon_public_id'] = $uploadIcon->getPublicId();    // ID
        }

        // Simpan ke database
        Music::create($data);

        return back()->with('success', 'Song has been added');
    }




    public function edit_song(Music $music)
    {
        $data = Newgenre::all();
        return view('adminCRUD.editsong', ['music' => $music, 'newgenres' => $data]);
    }



    public function update_song(Music $music, Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'genre' => 'required',
            'release_date' => 'required|date',
        ]);

        // Ganti audio jika ada file baru
        if ($request->hasFile('chfile')) {
            $request->validate(['chfile' => 'file|mimes:mp3,wav,ogg|max:1500']);

            // Hapus file lama dari Cloudinary
            if ($music->file_public_id) {
                Cloudinary::destroy($music->file_public_id, ['resource_type' => 'video']);
            }

            // Upload file baru
            $uploadAudio = Cloudinary::upload(
                $request->file('chfile')->getRealPath(),
                [
                    'resource_type' => 'auto',
                    'folder' => 'songs/audio',
                ]
            );

            $data['file_path'] = $uploadAudio->getSecurePath();
            $data['file_public_id'] = $uploadAudio->getPublicId();
        }

        // Ganti icon jika ada file baru
        if ($request->hasFile('icon')) {
            $request->validate(['icon' => 'image|file|max:1500']);

            // Hapus icon lama
            if ($music->icon_public_id) {
                Cloudinary::destroy($music->icon_public_id);
            }

            // Upload icon baru
            $uploadIcon = Cloudinary::upload(
                $request->file('icon')->getRealPath(),
                [
                    'folder' => 'songs/icons',
                ]
            );

            $data['icon'] = $uploadIcon->getSecurePath();
            $data['icon_public_id'] = $uploadIcon->getPublicId();
        }

        // Update ke database
        $music->update($data);

        return redirect()->route('admin.edit', ['music' => $music])
            ->with('success', 'Edit confirmed');
    }


    public function destroy_song(Music $music)
    {
        // Hapus audio dari Cloudinary jika ada
        if ($music->file_public_id) {
            Cloudinary::destroy($music->file_public_id, ['resource_type' => 'video']); // audio dianggap video oleh Cloudinary
        }

        // Hapus icon dari Cloudinary jika ada
        if ($music->icon_public_id) {
            Cloudinary::destroy($music->icon_public_id); // default: image
        }

        // Hapus data dari database
        $music->delete();

        return redirect()->route('admin.index')->with('success', 'Song has been deleted.');
    }



    public function view_user()
    {
        $user = DB::table('users')
            ->where('is_admin', false)
            ->get();

        return view('adminCRUD.adminViewUser', ['users' => $user]);
    }


    public function view_admin()
    {
        $user = DB::table('users')
            ->where('is_admin', true)
            ->get();

        return view('adminCRUD.adminViewAdmin', ['users' => $user]);
    }

    public function deactivate_user(User $user)
    {

        $query = DB::table('users')
            ->where('is_admin', false)
            ->where('id', $user->id)
            ->update(['activation' => false]);

        return redirect(route('admin.viewuser', ['successdeactivate' => $query]));
    }

    public function deactivate_admin(User $user)
    {
        $query = DB::table('users')
            ->where('is_admin', true)
            ->where('id', $user->id)
            ->update(['activation' => false]);

        return redirect(route('admin.viewadmin', ['successdeactivate' => $query]));
    }

    public function reactivate_user(User $user)
    {

        $query = DB::table('users')
            ->where('is_admin', false)
            ->where('id', $user->id)
            ->update(['activation' => true]);

        return redirect(route('admin.viewuser', ['successdeactivate' => $query]));
    }

    public function reactivate_admin(User $user)
    {
        $query = DB::table('users')
            ->where('is_admin', true)
            ->where('id', $user->id)
            ->update(['activation' => true]);

        return redirect(route('admin.viewadmin', ['successdeactivate' => $query]));
    }


    //EDIT DISCOVERY LAGU
    public function discover()
    {
        $musics = DB::table('music')
            ->join('discoveries', 'music.category_id', '=', 'discoveries.id')
            ->select('music.*', 'discoveries.disc_category')
            ->get();

        return view('adminCRUD.admindiscover', ['musics' => $musics]);
    }

    public function edit_discover(Music $music)
    {
        $discoveries = Discovery::all();
        $old_category = Discovery::where('id', $music->category_id)->value('disc_category');

        return view('adminCRUD.editdiscover', ['music' => $music, 'discoveries' => $discoveries, 'old_category' => $old_category]);
    }


    public function update_discover(Request $request, Music $music)
    {
        $validasi = $request->validate([
            'disc_category' => 'required'
        ]);

        $data = AdminController::getId($request->input('disc_category'));
        DB::table('music')
            ->where('id', $music->id)
            ->update(['category_id' => $data]);
        return back();
    }

    public static function getId($disc_category)
    {
        return DB::table('discoveries')
            ->where('disc_category', $disc_category)
            ->value('id');
    }



    //BAGIAN UNTUK CRUD DISCOVERY
    public function adddiscovery()
    {
        $data = Discovery::where('id', '!=', 1)->get();
        $newgenres = Newgenre::all();
        return view('adminCRUD.adddiscovery', ['discoveries' => $data, 'newgenres' => $newgenres]);
    }


    public function store_adddiscovery(Request $request)
    {
        if ($request->has('addDiscovery')) {
            $data = $request->validate([
                'disc_category' => 'required|unique:discoveries,disc_category'
            ]);
            Discovery::create($data);
            return redirect(route('admin.adddiscovery'))->with('successAdd', 'category berhasil ditambah');
        }
    }

    public function edit_adddiscovery(Discovery $discovery)
    {

        return view('adminCRUD.editdiscovercategory', ['discovery' => $discovery]);
    }

    public function update_adddiscovery(Request $request, Discovery $discovery)
    {
        $data = $request->validate([
            'disc_category' => 'required|unique:discoveries,disc_category'
        ]);

        $discovery->update($data);
        return back()->with('success', 'data berhasil diupdate');
    }

    public function destroy_adddiscovery(Discovery $discovery)
    {
        $data = Music::where('category_id', $discovery->id)->update(['category_id' => 1]);
        Discovery::destroy($discovery->id);
        return back();
    }


    //CRUD NEW GENRE
    public function store_newgenre(Request $request)
    {
        if ($request->has('addGenre')) {
            $data = $request->validate([
                'new_genre' => 'required|unique:newgenres,new_genre'
            ]);

            Newgenre::create($data);
            return redirect(route('admin.adddiscovery'))->with('successGenre', 'genre berhasil ditambah');
        }
    }


    public function edit_newgenre(Newgenre $newgenre)
    {

        return view('adminCRUD.editnewgenre', ['newgenre' => $newgenre]);
    }

    public function update_newgenre(Request $request, Newgenre $newgenre)
    {
        $data = $request->validate([
            'new_genre' => 'required|unique:newgenres,new_genre'
        ]);

        Music::where('genre', $newgenre->new_genre)->update(['genre' => $request->input('new_genre')]);
        $newgenre->update($data);
        return back()->with('success', 'data berhasil diupdate');
    }

    public function destroy_newgenre(Newgenre $newgenre)
    {
        $data = Music::where('genre', $newgenre->new_genre)->update(['genre' => 'no genre']);

        Newgenre::destroy($newgenre->id);
        return back();
    }
}
