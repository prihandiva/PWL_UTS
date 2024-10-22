<form action="{{ url('/stok/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Stok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tanggal Stok</label>
                    <input type="date" name="stok_tanggal" id="stok_tanggal" class="form-control" required>
                    <small id="error-stok_tanggal" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Jumlah Stok</label>
                    <input type="number" name="stok_jumlah" id="stok_jumlah" class="form-control" required min="0>
                    <small id="error-stok_jumlah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Barang</label>
                    <select name="fk_barang_id" id="fk_barang_id" class="form-control" required>
                        <option value="">- Pilih Barang -</option>
                        @foreach ($barang as $b)
                            <option value="{{ $b->barang_id }}">{{ $b->barang_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-fk_barang_id" class="error-text form-text text-danger"></small>
                </div>

                <!-- Input untuk Supplier -->
                <div class="form-group">
                    <label>Supplier</label>
                    <select name="fk_supplier_id" id="fk_supplier_id" class="form-control" required>
                        <option value="">- Pilih Supplier -</option>
                        @foreach ($supplier as $s)
                            <option value="{{ $s->supplier_id }}">{{ $s->supplier_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-fk_supplier_id" class="error-text form-text text-danger"></small>
                </div>

                <!-- Input untuk User -->
                <div class="form-group">
                    <label>Pengguna</label>
                    <select name="fk_user_id" id="fk_user_id" class="form-control" required>
                        <option value="">- Pilih Pengguna -</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}">{{ $u->nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-fk_user_id" class="error-text form-text text-danger"></small>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form-tambah").validate({
            rules: {
                fk_supplier_id: {
                    required: true
                },
                fk_barang_id: {
                    required: true
                },
                fk_user_id: {
                    required: true
                },
                stok_jumlah: {
                    required: true,
                    number: true,
                    min: 0 // Pastikan jumlah stok tidak negatif
                },
                stok_tanggal: {
                    required: true,
                    date: true
                },
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
                            dataStok.ajax.reload();
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
                    error: function(xhr, status, error) {
                        // Tangani error dari server
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
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>