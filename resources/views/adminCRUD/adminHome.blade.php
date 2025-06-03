@extends('adminCRUD.layouts.admin_main')
@section('container')
<section class="my-4">
    <div class="px-5 container-fluid table-responsive-md">
      <table id="song_list" class="table table-striped dataTable no-footer" style="width:100%">
        <thead>
          <tr>
            <th></th>
            <th>Title</th>
            <th>Artist</th>
            <th>Genre</th>
            <th>Album</th>
            <th>Release date</th>
            <th>Status</th>
          </tr>
        </thead>

        <tbody>
          @foreach($musics as $music)
          <tr>
            <td></td>
            <td>{{$music->title}}</td>
            <td>{{$music->artist}}</td>
            <td>{{$music->genre}}</td>
            <td><audio controls>
                <source src="{{ asset($music->file_path) }}" type="audio/mpeg">
              </audio></td>
            <td>{{$music->release_date}}</td>
            <td>
              <div class="mt-1 d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="{{route('admin.edit', ['music' => $music])}}" class="btn btn-secondary btn-sm">Edit</a>
                <form action="{{route('admin.destroy', ['music' => $music])}}" method="post">
                  @method('delete')
                  @csrf
                  <button class="confirm-delete btn btn-danger btn-sm" name="hapus_data" id="hapus_data">Delete</button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </section>


  <script>
    $(document).ready(function() {
      $('.confirm-delete').click(function(event) {
        let form = $(this).closest("form");
        event.preventDefault();
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        })
      })
      $('#song_list').DataTable();
    });

    $('#song_list').dataTable({
      "ordering": true
    });
  </script>

@endsection