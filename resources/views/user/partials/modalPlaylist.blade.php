{{-- MODAL CREATE PLAYLIST --}}
<div class="modal fade" id="createPlaylistModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex text-center justify-content-center"
                style="background-color: rgb(238, 181, 0)">
                <h1 class="fontMonsseratExtraBold text-center" id="exampleModalLabel"
                    style="font-size: 35px; color: black">Create Playlist</h1>
            </div>

            <div class="modal-body fontMonsseratRegular bg-dark">
                <form method="post" action="{{ url('/user/playlists') }}" id="createPlaylistForm">
                    @csrf
                    {{-- Playlist Name --}}
                    <h1 class="fontMonsseratSemiBold" style="font-size: 20px;">Playlist Name</h1>
                    <div class="input-group my-3">
                        <input type="text" class="form-control fontMonsseratSemiBold bg-dark text-white"
                            aria-describedby="basic-addon1" style="background-color: darkslategrey" name="playlist_name"
                            id="playlistNameCreate" required>
                    </div>
                    <div class="invalid-feedback mb-5" id="errorNameCreate">
                        Nama tidak boleh kosong!
                    </div>

                    {{-- Hidden Input untuk Selected Music --}}
                    <input type="hidden" name="selected_songs" id="selectedSongsInputCreate">


                    {{-- Search Song --}}
                    <h1 class="fontMonsseratSemiBold mt-5" style="font-size: 20px;">Search songs to add</h1>
                    <div class="input-group my-3">
                        <input type="text" class="form-control fontMonsseratRegular bg-dark text-white"
                            aria-describedby="basic-addon1" style="background-color: darkslategrey" id="keywordCreate">
                    </div>
                    <table class="table table-striped table-hover table-dark mb-5">
                        <thead>
                            <tr>
                                <th class="fontMonsseratSemiBold" scope="col"> </th>
                                <th class="fontMonsseratSemiBold" scope="col">Song</th>
                                <th class="fontMonsseratSemiBold" scope="col">Artist</th>
                                <th class="fontMonsseratSemiBold" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="text-left" id="searchMusicCreate">
                            {{-- placeholder --}}
                            <tr>
                                <th colspan="4" class="text-secondary">Type and search the music you desire...</th>
                            </tr>
                        </tbody>
                    </table>

                    {{-- Song Added --}}
                    <h1 class="p-2 fontMonsseratSemiBold my-3 mt-5" style="font-size: 20px"> Songs Added</h1>
                    <table class="table table-striped table-hover table-dark">
                        <thead>
                            <tr>
                                <th class="fontMonsseratSemiBold" scope="col"> </th>
                                <th class="fontMonsseratSemiBold" scope="col">Song</th>
                                <th class="fontMonsseratSemiBold" scope="col">Artist</th>
                                <th class="fontMonsseratSemiBold" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="text-left" id="selectedMusicCreate">
                            {{-- placeholder --}}
                            <tr id="placeholderSearchedCreate">
                                <th colspan="4" class="text-secondary">No musics selected...</th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="invalid-feedback" id="errorSongCreate">
                        Setidaknya pilih satu lagu!
                    </div>
                </form>
            </div>

            {{-- Buttons --}}
            <div class="modal-footer" style="background-color: rgb(238, 181, 0)">
                <button type="button" class="btn btn-outline-dark fontMonsseratSemiBold"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-dark fontMonsseratSemiBold"
                    id="createPlaylist">Create</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT PLAYLIST --}}
<div class="modal fade" id="editPlaylistModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex text-center justify-content-center"
                style="background-color: rgb(238, 181, 0)">
                <h1 class="fontMonsseratExtraBold text-center" id="exampleModalLabel"
                    style="font-size: 35px; color: black">Edit Playlist</h1>
            </div>

            <div class="modal-body fontMonsseratRegular bg-dark">
                <form method="post" action="{{ url('/user/playlists') }}" id="editPlaylistForm">
                    @csrf
                    @method('put')
                    {{-- Playlist Name --}}
                    <h1 class="fontMonsseratSemiBold" style="font-size: 20px;">Playlist Name</h1>
                    <div class="input-group my-3">
                        <input type="text" class="form-control fontMonsseratSemiBold bg-dark text-white"
                            aria-describedby="basic-addon1" style="background-color: darkslategrey"
                            name="playlist_name" id="playlistNameEdit" required>
                    </div>
                    <div class="invalid-feedback mb-5" id="errorNameEdit">
                        Nama tidak boleh kosong!
                    </div>

                    {{-- Hidden Input untuk Selected Music --}}
                    <input type="hidden" name="selected_songs" id="selectedSongsInputEdit">


                    {{-- Search Song --}}
                    <h1 class="fontMonsseratSemiBold mt-5" style="font-size: 20px;">Search songs to add</h1>
                    <div class="input-group my-3">
                        <input type="text" class="form-control fontMonsseratRegular bg-dark text-white"
                            aria-describedby="basic-addon1" style="background-color: darkslategrey" id="keywordEdit">
                    </div>
                    <table class="table table-striped table-hover table-dark mb-5">
                        <thead>
                            <tr>
                                <th class="fontMonsseratSemiBold" scope="col"> </th>
                                <th class="fontMonsseratSemiBold" scope="col">Song</th>
                                <th class="fontMonsseratSemiBold" scope="col">Artist</th>
                                <th class="fontMonsseratSemiBold" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="text-left" id="searchMusicEdit">
                            {{-- placeholder --}}
                            <tr>
                                <th colspan="4" class="text-secondary">Type and search the music you desire...</th>
                            </tr>
                        </tbody>
                    </table>

                    {{-- Song Added --}}
                    <h1 class="p-2 fontMonsseratSemiBold my-3 mt-5" style="font-size: 20px"> Songs Added</h1>
                    <table class="table table-striped table-hover table-dark">
                        <thead>
                            <tr>
                                <th class="fontMonsseratSemiBold" scope="col"> </th>
                                <th class="fontMonsseratSemiBold" scope="col~">Song</th>
                                <th class="fontMonsseratSemiBold" scope="col">Artist</th>
                                <th class="fontMonsseratSemiBold" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="text-left" id="selectedMusicEdit">
                            {{-- placeholder --}}
                            <tr id="placeholderSearchedEdit">
                                <th colspan="4" class="text-secondary">No musics selected...</th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="invalid-feedback" id="errorSongEdit">
                        Setidaknya pilih satu lagu!
                    </div>
                </form>
            </div>

            {{-- Buttons --}}
            <div class="modal-footer" style="background-color: rgb(238, 181, 0)">
                <button type="button" class="btn btn-outline-dark fontMonsseratSemiBold"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-dark fontMonsseratSemiBold"
                    id="editPlaylist">Edit</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL FOR DELETE --}}
<div class="modal fade" id="deletePlaylist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex text-center justify-content-center"
                style="background-color: rgb(238, 181, 0)">
                <h1 class="fontMonsseratExtraBold text-center" id="exampleModalLabel"
                    style="font-size: 35px; color: black">Delete Modal</h1>
            </div>

            <div class="modal-body fontMonsseratRegular bg-dark">
                Are you sure you want to delete this playlist?
            </div>

            {{-- Buttons --}}
            <div class="modal-footer" style="background-color: rgb(238, 181, 0)">
                <button type="button" class="btn btn-outline-dark fontMonsseratSemiBold"
                    data-bs-dismiss="modal">Close</button>
                <form method="post" id="deleteForm">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-outline-dark fontMonsseratSemiBold"
                        id="deleteButton">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
{{-- FOR CREATE MODAL --}}
<script>
    $(document).ready(function() {
        // ketika melakukan search
        $("#keywordCreate").keypress(function() {
            // mendapatkan text dalam search
            var search = $("#keywordCreate").val();

            // fetch menggunakan ajax
            $.ajax({
                type: "GET",
                url: "{{ route('user.musics') }}?search=" + search,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') //ini wajib
                },
                success: function name(response) {
                    // reset isi tabel
                    $("#searchMusicCreate").html('');

                    if (response.length == 0) {
                        // jika tidak ditemukan hasil, outputkan peringatan
                        $("#searchMusicCreate").append(
                            "<tr>" +
                            "<th colspan='4' class='text-secondary'>No music found</th>" +
                            "</tr>"
                        );
                    } else {
                        // jika ada response, maka append ke table semuanya
                        $.each(response, function(index, item) {

                            console.log(item);
                            var src = "";
                            if (item.icon == null)
                                src =
                                "{{ url('img/now_playing/empty_icon.jpeg') }}";
                            else
                                src = item.icon;

                            $("#searchMusicCreate").append(
                                `
                              <tr>
                                <th><img src="${src}" class="img-fluid rounded-3" style="max-width: 50px; max-height: 50px;" alt=""></th>
                                <th>${item.title}</th>
                                <th>${item.artist}</th>
                                <th><a href='#' onclick="addItemCreate(${item.id}, '${item.title}', '${item.artist}', '${item.icon}')"><i class='bi bi-plus-lg text-white'></i></a></th>
                              </tr>
                              `
                            );
                        });
                    }
                }
            });
        });

        // ketika modal ditutup
        $('#createPlaylistModal').on('hidden.bs.modal', function() {
            // Mengosongkan nilai input
            $('input[type="text"]').val('');

            // Mereset tabel pencarian
            $("#searchMusicCreate").html('');
            $("#searchMusicCreate").append(
                "<tr>" +
                "<th colspan='4' class='text-secondary'>Type and search the music you desire...</th>" +
                "</tr>"
            );

            // Mereset tabel lagu yang sudah dipilih
            $("#selectedMusicCreate").html('');
            $("#selectedMusicCreate").append(
                "<tr id='placeholderSearchedCreate'>" +
                "<th colspan='4' class='text-secondary'>No musics selected...</th>" +
                "</tr>"
            );

            // mereset error
            $('#errorNameCreate').css('display', 'none');
            $('#errorSongCreate').css('display', 'none');
        });

        // ketika tombol save diklik
        $("#createPlaylist").click(function() {
            // pengecekan input apakah kosong atau tidak
            if ($('#playlistNameCreate').val() == '' || $('#placeholderSearchedCreate').length > 0) {
                // jika kosong, maka tampilkan peringatan
                $('#errorNameCreate').css('display', $('#playlistNameCreate').val() == '' ? 'block' :
                    'none');
                $('#errorSongCreate').css('display', $('#placeholderSearchedCreate').length > 0 ?
                    'block' : 'none');
                return;
            }

            // Mendapatkan data lagu yang sudah dipilih
            var selectedSongs = [];

            $("#selectedMusicCreate tr").each(function(index, row) {
                var songId = $(row).attr("id").replace("item", "");
                selectedSongs.push(songId);
            });

            // Menyimpan ID lagu ke dalam input tersembunyi
            $("#selectedSongsInputCreate").val(JSON.stringify(selectedSongs));

            // Submit formulir
            $("#createPlaylistForm").submit();
        });
    });

    function addItemCreate(id, title, artist, icon) {
        // hapus placeholder
        $("#placeholderSearchedCreate").remove();

        // cek apakah lagu sudah di add
        if (!$("#item" + id).length) {
            var src = "";
            if (icon == null)
                src = "{{ url('img/now_playing/empty_icon.jpeg') }}";
            else
                src = icon;

            // jika belum ada, maka append ke table
            $("#selectedMusicCreate").append(
                `
          <tr id=item${id}>
            <th><img src="${src}" class="img-fluid rounded-3" style="max-width: 50px; max-height: 50px;" alt=""></th>
            <th>${title}</th>
            <th>${artist}</th>
            <th><a href='#' onclick="deleteItemCreate(${id})"><i class='bi bi-trash-fill text-white'></i></a></th>
          </tr>
          `
            );
        }
    }

    function deleteItemCreate(id) {
        // hapus row
        $("#item" + id).remove();

        // cek apakah sudah tidak ada lagu yang di add
        if ($("#selectedMusicCreate").children().length == 0) {
            // jika tidak ada, maka append placeholder
            $("#selectedMusicCreate").append(
                `
          <tr id="placeholderSearchedCreate">
            <th colspan="4" class="text-secondary">No musics selected...</th>
          </tr>
          `
            );
        }
    }
</script>

{{-- FOR EDIT MODAL --}}
<script>
    $(document).ready(function() {
        // FOR EDIT MODAL
        $("#keywordEdit").keypress(function() {
            // mendapatkan text dalam search
            var search = $("#keywordEdit").val();

            // fetch menggunakan ajax
            $.ajax({
                type: "GET",
                url: "{{ route('user.musics') }}?search=" + search,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') //ini wajib
                },
                success: function name(response) {
                    // reset isi tabel
                    $("#searchMusicEdit").html('');

                    if (response.length == 0) {
                        // jika tidak ditemukan hasil, outputkan peringatan
                        $("#searchMusicEdit").append(
                            "<tr>" +
                            "<th colspan='4' class='text-secondary'>No music found</th>" +
                            "</tr>"
                        );
                    } else {
                        // jika ada response, maka append ke table semuanya
                        $.each(response, function(index, item) {
                            var src = "";
                            if (item.icon == null)
                                src =
                                "{{ url('img/now_playing/empty_icon.jpeg') }}";
                            else
                                src =  icon;

                            $("#searchMusicEdit").append(
                                `
                              <tr>
                                <th><img src="${src}" class="img-fluid rounded-3" style="max-width: 50px; max-height: 50px;" alt=""></th>
                                <th>${item.title}</th>
                                <th>${item.artist}</th>
                                <th><a href='#' onclick="addItemEdit(${item.id}, '${item.title}', '${item.artist}','${item.icon}')"><i class='bi bi-plus-lg text-white'></i></a></th>
                              </tr>
                              `
                            );
                        });
                    }
                }
            });
        });

        // ketika tombol edit diklik
        $("#editPlaylist").click(function() {
            // pengecekan error
            if ($('#playlistNameEdit').val() == '' || $('#placeholderSearchedEdit').length > 0) {
                // jika kosong, maka tampilkan peringatan
                $('#errorNameEdit').css('display', $('#playlistNameEdit').val() == '' ? 'block' :
                    'none');
                $('#errorSongEdit').css('display', $('#placeholderSearchedEdit').length > 0 ? 'block' :
                    'none');
                return;
            }

            // Mendapatkan data lagu yang sudah dipilih
            var selectedSongs = [];

            $("#selectedMusicEdit tr").each(function(index, row) {
                var songId = $(row).attr("id").replace("item", "");
                selectedSongs.push(songId);
            });

            // Menyimpan ID lagu ke dalam input tersembunyi
            $("#selectedSongsInputEdit").val(JSON.stringify(selectedSongs));

            // Submit formulir
            $("#editPlaylistForm").submit();
        });
    });

    function loadItem(playlist_id) {
        // fetch menggunakan ajax
        $.ajax({
            type: "GET",
            url: "{{ url('/user/playlists') }}/" + playlist_id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') //ini wajib
            },
            success: function name(response) {
                // reset isi tabel
                $("#selectedMusicEdit").html('');

                // ubah judul
                $("#playlistNameEdit").val(response.playlist.name);
                $("#editPlaylistForm").attr("action", "{{ url('/user/playlists') }}" + "/" +
                    playlist_id);

                if (response.musics.length == 0) {
                    // jika tidak ditemukan hasil, outputkan peringatan
                    $("#selectedMusicEdit").append(
                        "<tr>" +
                        "<th colspan='4' class='text-secondary'>No music found</th>" +
                        "</tr>"
                    );
                } else {
                    $.each(response.musics, function(index, item) {
                        var src = "";
                        if (item.icon == null)
                            src = "{{ url('img/now_playing/empty_icon.jpeg') }}";
                        else
                            src = item.icon;

                        $("#selectedMusicEdit").append(
                            `
                                <tr id="item${item.id}">
                                    <th><img src="${src}" class="img-fluid rounded-3" style="max-width: 50px; max-height: 50px;" alt=""></th>
                                    <th>${item.title}</th>
                                    <th>${item.artist}</th>
                                    <th><a href='#' onclick="deleteItemEdit(${item.id})"><i class='bi bi-trash-fill text-white'></i></a></th>
                                </tr>
                            `
                        );
                    });
                }
            }
        });
    }

    function addItemEdit(id, title, artist, icon) {
        // hapus placeholder
        $("#placeholderSearchedEdit").remove();

        // cek apakah lagu sudah di add
        if (!$("#item" + id).length) {
            // menentukan src
            var src = "";
            if (icon == null)
                src = "{{ url('img/now_playing/empty_icon.jpeg') }}";
            else
                src = icon;

            // jika belum ada, maka append ke table
            $("#selectedMusicEdit").append(
                `
          <tr id=item${id}>
            <th><img src="${src}" class="img-fluid rounded-3" style="max-width: 50px; max-height: 50px;" alt=""></th>
            <th>${title}</th>
            <th>${artist}</th>
            <th><a href='#' onclick="deleteItemEdit(${id})"><i class='bi bi-trash-fill text-white'></i></a></th>
          </tr>
          `
            );
        }
    }

    function deleteItemEdit(id) {
        // hapus row
        $("#item" + id).remove();

        // cek apakah sudah tidak ada lagu yang di add
        if ($("#selectedMusicEdit").children().length == 0) {
            // jika tidak ada, maka append placeholder
            $("#selectedMusicEdit").append(
                `
          <tr id="placeholderSearchedEdit">
            <th colspan="4" class="text-secondary">No musics selected...</th>
          </tr>
          `
            );
        }
    }
</script>

{{-- FOR DELETE --}}
<script>
    function deletePlaylist(id) {
        // set action form
        $("#deleteForm").attr("action", "{{ url('/user/playlists') }}" + "/" + id);
    }
</script>
