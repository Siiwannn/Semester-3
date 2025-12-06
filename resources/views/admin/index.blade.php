@extends('layouts.app')
@section('title', 'Data Mahasiswa')

@section('content')

<div class="container py-4">
    <h3 class="mb-4">CRUD MahasiswaData </h3>
    <button class="btn btn-primary mb-3 float-start me-3" id="btnAdd">+Tambah Data</button>
    <a href="{{route ('mahasiswa.all.pdf')}}" class="btn btn-danger mb-3 float-start">Report Pdf</a>
    <table class="table table-bordered table-striped" id="mahasiswaTable">
    <thead class="table-dark">
        <tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Angkatan</th>
            <th>Tgl Lahir</th>
            <th>No Hp</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

</div>
<!-- Edit -->
<div class="modal fade" id="mahasiswaModal" tabindex="-1" aria-labelledby="mahasiswaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
        <form id="formMahasiswa" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" id="id">    <div class="modal-header">
        <h5 class="modal-title text-center w-100" id="mahasiswaModalLabel">Tambah Mahasiswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-start">
        <div class="mb-2">
          <label>Nim</label>
          <input type="text" name="nim" id="nim" class="form-control" required>
        </div>

        <div class="mb-2">
          <label>Nama</label>
          <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <div class="mb-2">
          <label>Prodi</label>
          <select name="prodi" id="prodi" class="form-select" required>
            <option value="">-- Pilih Program Studi --</option>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
            <option value="Teknik Komputer">Teknik Komputer</option>
            <option value="Manajemen Informatika">Manajemen Informatika</option>
          </select>
        </div>

        <div class="mb-2">
          <label>Angkatan</label>
          <input type="number" name="angkatan" id="angkatan" class="form-control" required>
        </div>

        <div class="mb-2">
          <label>Tgl Lahir</label>
          <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required>
        </div>

        <div class="mb-2">
          <label>Nomor Telepon</label>
          <input type="text" name="no_hp" id="no_hp" class="form-control">
        </div>

        <div class="mb-2">
          <label>Gambar</label>
          <input type="file" name="gambar" id="gambar" class="form-control">
          <small id="previewArea" class="d-block mt-2"></small>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
   </form>
 </div>
</div>


{{-- Toastr & DataTables --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script><script>
$(document).ready(function () {
    // CSRF Setup
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    });

    // Toastr Settings
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "2000"
    };

    // DataTables Load
    var table = $('#mahasiswaTable').DataTable({
        ajax: "{{ route('admin.mahasiswa.data') }}",
        responsive: true,
        processing: true,
        columns: [
            { data: 'nim' },
            { data: 'nama' },
            { data: 'prodi' },
            { data: 'angkatan' },
            { data: 'tgl_lahir' },
            { data: 'no_hp' },
            {
                data: 'gambar',
                render: function (data) {
                    return data ? `<img src="/storage/${data}" width="50" class="rounded">` : 'No Image';
                }
            },
            {
                data: 'id',
                render: function (id) {
                    return `
                        <button class="btn btn-sm btn-warning btnEdit" data-id="${id}">Edit</button>
                        <button class="btn btn-sm btn-danger btnDelete" data-id="${id}">Delete</button>
                    `;
                }
            }
        ]
    });

    // Tambah Data
    $('#btnAdd').click(function() {
        $('#formMahasiswa')[0].reset();
        $('#id').val('');
        $('#previewArea').html('');
        $('#mahasiswaModalLabel').text('Tambah Mahasiswa');
        $('#mahasiswaModal').modal('show');
    });

    // Simpan / Update
    $('#formMahasiswa').submit(function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    let id = $('#id').val();

    let url = id
        ? "/admin/mahasiswa/update/" + id
        : "{{ route('admin.mahasiswa.store') }}";

    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function(){
            $('.btn-success').attr('disabled', true).text('Menyimpan...');
        },
        success: function(res) {
            toastr.success(res.message);
            $('#mahasiswaModal').modal('hide');
            $('#formMahasiswa')[0].reset();
            table.ajax.reload(null, false);
        },
        complete: function(){
            $('.btn-success').attr('disabled', false).text('Simpan');
        },
        error: function(err) {
            toastr.error('Gagal menyimpan data');
            console.log(err);
        }
    });
});

    // Edit Data
    $('#mahasiswaTable').on('click', '.btnEdit', function() {
        let id = $(this).data('id');
        $.get("{{ url('admin/mahasiswa/edit') }}/" + id, function(res) {
            $('#id').val(res.id);
            $('#nim').val(res.nim);
            $('#nama').val(res.nama);
            $('#prodi').val(res.prodi);
            $('#angkatan').val(res.angkatan);
            $('#tgl_lahir').val(res.tgl_lahir);
            $('#no_hp').val(res.no_hp);
            $('#previewArea').html(res.gambar ? `<img src="/storage/${res.gambar}" width="80" class="rounded mt-2">` : '');
            $('#mahasiswaModalLabel').text('Edit Mahasiswa');
            $('#mahasiswaModal').modal('show');
        }).fail(() => toastr.error('Gagal ambil data'));
    });

    // Hapus Data
    $('#mahasiswaTable').on('click', '.btnDelete', function() {
        let id = $(this).data('id');
        if(!confirm('Yakin hapus data ini?')) return;
        $.ajax({
            type: "DELETE",
            url: "{{ url('admin/mahasiswa/delete') }}/" + id,
            success: function(res) {
                toastr.info(res.message);
                table.ajax.reload(null, false);
            },
            error: function() {
                toastr.error('Gagal menghapus data');
            }
        });
    });
});
</script>
@endsection
