@if(empty($stok))
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('/stok') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/stok/' . $stok->stok_id . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Stok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form input fields -->
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <select name="fk_barang_id" id="barang_id" class="form-control" required>
                            <option value="">- Pilih Barang -</option>
                            @foreach ($barang as $l)
                                <option value="{{ $l->barang_id }}" {{ $l->barang_id == $stok->fk_barang_id ? 'selected' : '' }}>
                                    {{ $l->barang_nama }}
                                </option>
                            @endforeach
                        </select>
                        <small id="error-barang_id" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama Supplier</label>
                        <select name="fk_supplier_id" id="supplier_id" class="form-control" required>
                            <option value="">- Pilih Supplier -</option>
                            @foreach ($supplier as $s)
                                <option value="{{ $s->supplier_id }}" {{ $s->supplier_id == $stok->fk_supplier_id ? 'selected' : '' }}>
                                    {{ $s->supplier_nama }}
                                </option>
                            @endforeach
                        </select>
                        <small id="error-supplier_id" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama User</label>
                        <select name="fk_user_id" id="user_id" class="form-control" required>
                            <option value="">- Pilih User -</option>
                            @foreach ($user as $u)
                                <option value="{{ $u->user_id }}" {{ $u->user_id == $stok->fk_user_id ? 'selected' : '' }}>
                                    {{ $u->nama }}
                                </option>
                            @endforeach
                        </select>
                        <small id="error-user_id" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Stok</label>
                        <input value="{{ $stok->stok_jumlah }}" type="number" name="stok_jumlah" id="stok_jumlah" class="form-control" required min="0">
                        <small id="error-stok_jumlah" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Stok</label>
                        <input value="{{ $stok->stok_tanggal }}" type="date" name="stok_tanggal" id="stok_tanggal" class="form-control" required>
                        <small id="error-stok_tanggal" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
@endif

<script>
// JavaScript for AJAX submission and validation
$(document).ready(function() {
    $("#form-edit").validate({
        rules: {
            fk_barang_id: { required: true, number: true },
            fk_supplier_id: { required: true, number: true },
            fk_user_id: { required: true, number: true },
            stok_jumlah: { required: true, number: true, min: 0 },
            stok_tanggal: { required: true, date: true }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if (response.status) {
                        $('#myModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        });
                        datastok.ajax.reload();
                    } else {
                        $('.error-text').text('');
                        $.each(response.msgField, function(prefix, val) {
                            $('#error-' + prefix).text(val[0]);
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Error: ' + xhr.responseText
                    });
                }
            });
            return false; // Mencegah form dari submit normal
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>