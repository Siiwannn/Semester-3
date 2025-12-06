@extends('layouts.app')
@section('title', 'Data User')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Manajemen Data User</h3>
    <button class="btn btn-primary mb-3 float-start me-3" id="btnAdd">+Tambah User</button>
    <table class="table table-bordered table-striped" id="userTable">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>
<!-- Modal User -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formUser" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="modal-header" style="background:#0d6efd; color:black;">
                     <h5 class="modal-title text-start w-100" id="userModalLabel">Form User</h5>
                     <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="mb-2">
                        <label>Nama</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Password <span class="text-muted">(Kosongkan jika tidak diubah)</span></label>
                        <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
                    </div>
                    <div class="mb-2">
                        <label>Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Address</label>
                        <input type="text" name="address" id="address" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Toastr & DataTables --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
$(document).ready(function () {
    // Toastr notif pojok kanan atas untuk pesan sukses dari session (hanya saat pertama kali halaman dibuka)
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

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
    // Notif sukses dari session (pojok kanan atas)
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif
    // DataTables Load
    var table = $('#userTable').DataTable({
        ajax: {
            url: "{{ route('admin.user.data') }}",
            data: function(d) {
                d._ts = Date.now(); // tambahkan timestamp agar request selalu fresh
            },
            dataSrc: function(json) {
                if(json && json.message) {
                    toastr.success(json.message);
                }
                return json.data;
            }
        },
        responsive: true,
        processing: true,
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'phone' },
            { data: 'address' },
            { data: 'role' },
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
        $('#formUser')[0].reset();
        $('#id').val('');
        $('#userModalLabel').text('Form User');
        $('#userModal').modal('show');
    });
    // Simpan / Update
    $('#formUser').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        let id = $('#id').val();
        let url = id
            ? "/admin/user/update/" + id
            : "{{ route('admin.user.store') }}";
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
                $('#userModal').modal('hide');
                $('#formUser')[0].reset();
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
    $('#userTable').on('click', '.btnEdit', function() {
        let id = $(this).data('id');
        $.get("{{ url('admin/user/edit') }}/" + id, function(res) {
$('#id').val(res.data.id);
$('#name').val(res.data.name);
$('#email').val(res.data.email);
$('#phone').val(res.data.phone);
$('#address').val(res.data.address);
$('#role').val(res.data.role);
            $('#userModalLabel').text('Edit User');
            $('#userModal').modal('show');
        }).fail(() => toastr.error('Gagal ambil data'));
    });
    // Hapus Data
    $('#userTable').on('click', '.btnDelete', function() {
        let id = $(this).data('id');
        if(!confirm('Yakin hapus data ini?')) return;
        $.ajax({
            type: "DELETE",
            url: "{{ url('admin/user/delete') }}/" + id,
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
