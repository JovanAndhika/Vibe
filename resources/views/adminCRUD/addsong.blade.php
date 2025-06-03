@extends('adminCRUD.layouts.admin_main')
@section('container')
    <div class="container-md p-3">
        <br>
        <h1>Add Song</h1>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="mt-4 mb-3">

            <form method="post" action="/admin/store" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-7">
                    <label class="form-label">Title</label>
                    <input class="form-control" type="text" autofocus="true" name="title" id="title"
                        placeholder="Insert title">
                    <br>
                </div>

                <div class="col-lg-7">
                    <label class="form-label">Artist</label>
                    <input class="form-control" type="text" name="artist" id="artist"
                        placeholder="Insert singer">
                    <br>
                </div>

                <div class="col-lg-7">
                    <label class="form-label">Genre</label>
                    <select class="form-select" aria-label="Default select example" name="genre" id="genre"
                        placeholder="Choose genre">
                        <option selected>Choose genre</option>
                        <option value="Jazz">Jazz</option>
                        <option value="Pop">Pop</option>
                        <option value="Dangdut">Dangdut</option>
                        <option value="Kpop">Kpop</option>
                        <option value="Rock">Rock</option>
                        <option value="Classical">Classical</option>
                        <option value="Dance">Dance</option>
                        <option value="Phonk">Phonk</option>
                        @foreach ($newgenres as $newgenre)
                            <option value="{{ $newgenre->new_genre }}">{{ $newgenre->new_genre }}</option>
                        @endforeach
                    </select>
                    <br>
                </div>

                <div class="col-lg-7">
                    <label for="chfile" class="form-label">Insert sample song file .mp3 (maks 1mb)</label>
                    <input class="form-control" type="file" id="chfile" name="chfile">
                    <br>
                </div>

                {{-- music icon --}}
                <div class="col-lg-7">
                    <label for="icon" class="form-label">Icon Music (maks 1mb)</label>
                    <img class="img-fluid img-preview mb-3 col-sm-5 rounded mx-auto" id="img-preview" style="display: none">
                    <input class="form-control" type="file" id="icon" name="icon" onchange="previewImage();">

                    {{-- untuk error salah tipe file --}}
                    <div class="text-danger mt-1" id="icon-error" style="display: none">File harus berupa gambar!</div>
                    <br>
                </div>

                <div class="col-lg-7">
                    <label class="form-label">Release date</label>
                    <input class="form-control" type="date" name="release_date" id="release_date"
                        placeholder="Insert genre">
                    <br>
                </div>

                <div>
                    <input class="btn btn-primary btn-md col-lg-1 mt-3" type="submit" name="submit" id="submit"
                        value="add">
                </div>

            </form>

        </div>
    </div>
    
    <script>
        function previewImage() {
            // ambil input dan tag image
            const image = document.querySelector('#icon');
            const imagePreview = document.querySelector('#img-preview');
            
            // jika file bukan gambar
            if (!image.files[0].type.match(/image-*/)) {
                $('#icon-error').css('display', 'block');
                image.value = '';
                return;
            }
            
            // jika file adalah gambar
            imagePreview.style.display = 'block';
            $('#icon-error').css('display', 'none');
            
            // function untuk read file
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }
        </script>
@endsection