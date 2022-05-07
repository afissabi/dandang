@extends('back.layout.app')

@section('custom_css')
    <style>
        /* #loading{
            display: flex !important;
            justify-content: center;
            align-items: center;
        } */
    </style>
@endsection

@section('content')
<div class="card card-flush shadow-sm">
    <div class="card-header border-0 pt-6 justify-content-end ribbon ribbon-start">
        <div class="ribbon-label bg-primary" style="font-size: large;">Aktivitas/Kegiatan</div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                <i class="fa fa-plus"></i> Aktivitas/Kegiatan
            </button>
        </div>
    </div>
    <div class="card-body py-5 table-responsive">
        <table id="table" class="table table-striped gy-5 gs-7 border rounded">
            <thead>
                <tr role="row">
                    <th width="2%"><center>NO</center></th>
                    <th><center>Gambar</center></th>
                    <th><center>Judul</center></th>
                    <th><center>Keterangan</center></th>
                    <th width="15%"><center>Detail</center></th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah Data --}}
<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog mw-700px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Aktivitas/Kegiatan</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="form">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Pilih Type galeri :</label>
                        <div class="col-lg-2">
                            <center><input type="radio" name="type" value="0" style="width: 30px;height: 30px;margin-top: 5px;"/><p>Gambar</p></center>
                        </div>
                        <div class="col-lg-2">
                            <center><input type="radio" name="type" value="1" style="width: 30px;height: 30px;margin-top: 5px;"/><p>Link Youtube</p></center>
                        </div>
                    </div>
                    <div class="row mb-10" id="vgambar" style="display:none">
                        <label class="col-lg-3 col-form-label text-lg-end required">Gambar Galeri :</label>
                        <div class="col-lg-9">
                            <div class="mt-1">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('img/web/default.jpg' )}})">
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url()"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Gambar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="gambar" id="addgambar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="gambar_remove"/>
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batalkan">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Gambar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            @error('image')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-10" id="vlink" style="display:none">
                        <label class="col-lg-3 col-form-label text-lg-end required">Link Video :</label>
                        <div class="col-lg-9">
                            <input type="text" name="link" id="addlink" class="form-control" placeholder="Link Video">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Judul Galeri :</label>
                        <div class="col-lg-9">
                            <input type="text" name="judul" class="form-control" placeholder="Judul Galeri" required>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Keterangan :</label>
                        <div class="col-lg-9">
                            <textarea name="keterangan" class="form-control" rows="4" placeholder="Keterangan"></textarea>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit Data --}}
<div class="modal fade" tabindex="-1" id="edit">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Galeri</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="formedit">
                    <input type="hidden" class="form-control" id="id_galeri" name="id_galeri">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Pilih Type galeri :</label>
                        <div class="col-lg-2">
                            <center><input type="radio" name="type" value="0" id="edit_type_0" style="width: 30px;height: 30px;margin-top: 5px;"/><p>Gambar</p></center>
                        </div>
                        <div class="col-lg-2">
                            <center><input type="radio" name="type" value="1" id="edit_type_1" style="width: 30px;height: 30px;margin-top: 5px;"/><p>Link Youtube</p></center>
                        </div>
                    </div>
                    <div class="row mb-10" id="egambar" style="display:none">
                        <label class="col-lg-3 col-form-label text-lg-end required">Gambar Galeri :</label>
                        <div class="col-lg-9">
                            <div class="mt-1">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('img/web/default.jpg' )}})">
                                    <div class="image-input-wrapper w-125px h-125px" id="gbth"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Gambar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="gambar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="gambar_remove" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batalkan">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Gambar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            @error('image')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-10" id="elink" style="display:none">
                        <label class="col-lg-3 col-form-label text-lg-end required">Link Video :</label>
                        <div class="col-lg-9">
                            <input type="text" name="link" class="form-control" placeholder="Link Video" id="edit_link" required>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Judul Galeri :</label>
                        <div class="col-lg-9">
                            <input type="text" name="judul" class="form-control" placeholder="Judul Galeri" id="edit_judul" required>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Keterangan :</label>
                        <div class="col-lg-9">
                            <textarea name="keterangan" class="form-control" rows="4" placeholder="Keterangan" id="edit_keterangan"></textarea>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Loading --}}
<div class="modal fade" tabindex="-1" id="loading" style="">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 85%;background-color: rgba(0,0,0,.0001) !important;box-shadow: none;">
            <div class="modal-body">
                <center>
                    <i class="fa fa-spinner fa-spin" style="font-size: 85px;color: cadetblue;"></i>
                    <br><br>
                    <h3 style="color: #ffffff;background: cadetblue;">Proses menyimpan data...</h3>
                </center>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script>
    // $("#loading").hide();

    $(function () {
        $("#form").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menambah Galeri Web Anda ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Perbarui!",
                closeOnConfirm: false,
                allowOutsideClick: false,
            }).then(function(result) {
                $('#loading').modal({backdrop:'static', keyboard:false});
                $('#loading').modal('show');
                if (result.value) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:'POST',
                        url: "{{ url('cms-website/artikel/galeri/simpan') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                    })
                    .done(function(hasil) {
                        var tittle = "";
                        var icon = "";
                        $('#loading').modal('hide');

                        if (hasil.status == true) {
                            title = "Berhasil!";
                            icon = "success";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                                allowOutsideClick: false,
                            }).then(function() {
                                $('#loading').modal('hide');
                                $('#kt_modal_1').modal('hide');
                                load_data_table();
                            });
                        } else {
                            title = "Gagal!";
                            icon = "error";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                            })
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        errorNotification();
                    });
                }
            });
        });
    })

    $(function () {
        $("#formedit").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Memperbarui galeri web anda ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Perbarui!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                
                if (result.value) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:'POST',
                        url: "{{ url('cms-website/artikel/galeri/ubah') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                    })
                    .done(function(hasil) {
                        var tittle = "";
                        var icon = "";

                        if (hasil.status == true) {
                            title = "Berhasil!";
                            icon = "success";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                            }).then(function() {
                                load_data_table();
                                $('#edit').modal('hide');
                            });
                        } else {
                            title = "Gagal!";
                            icon = "error";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                            })
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        errorNotification();
                    });
                }
            });
        });
    })

    function hapus(id_data) {
            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menghapus Data Galeri ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('cms-website/artikel/galeri/destroy') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        data: {
                            id : id_data
                        }
                    })
                    .done(function(hasil) {
                        var tittle = "";
                        var icon = "";

                        if (hasil.status == true) {
                            title = "Berhasil!";
                            icon = "success";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                            }).then(function(result) {
                                load_data_table();
                            })
                        } else {
                            title = "Gagal!";
                            icon = "error";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                            })
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        errorNotification();
                    });
                }
            });
        }
</script>
<script>
    var tabelData;

    $(function () {
        tabelData = $('#table').DataTable({
            language: {
                lengthMenu: "Show _MENU_",
            },
            dom:
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">",
            ajax: {
                url : "{{ url('cms-website/artikel/galeri/datatablegaleri') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: function(data){
                }
            },
            columnDefs: [{
                targets: [2, 3, 4],
                className: ''
            }]
        });
    })

    /* detail informasi subjek survey per kelurahan */
    $('#table').on('click', '.edit', function (e) {
        var galeri = $(this).data('id_galeri');

        $.ajax({
            url: "{{ url('cms-website/artikel/galeri/edit') }}",
            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                galeri: galeri,
            },
            success: function(msg){
                // Add response in Modal body
                if(msg){
                    $('#id_galeri').val(msg.id_galeri);
                    $('#edit_link').val(msg.link);
                    $('#edit_gambar').val(msg.link);
                    $("#gbth").css("background-image", "url('" + msg.link + "')");
                    if (msg.type == 1){
                        $('#edit_type_1').prop('checked', true);
                        $('#edit_type_0').prop('checked', false);
                        $("#egambar").hide();
                        $("#elink").show();
                    }else{
                        $('#edit_type_0').prop('checked', true);
                        $('#edit_type_1').prop('checked', false);
                        $("#egambar").show();
                        $("#elink").hide();
                    }

                    $('#edit_keterangan').val(msg.keterangan);
                    $('#edit_judul').val(msg.judul);
                }else{
                    $('#id_galeri').val('');
                    $('#edit_link').val('');
                    $('#edit_type').val('');
                    $('#edit_keterangan').val('');
                    $('#edit_judul').val('');
                }
                // Display Modal
                $('#edit').modal('show');
            }
        });
    });

    function load_data_table() {
        tabelData.ajax.reload(null, 'refresh');
    }
</script>

<script type="text/javascript">
    $('input[type="radio"]').click(function () {
        var inputValue = $(this).attr("value");
        if (inputValue == 0) {
            $("#vgambar").show();
            $("#vlink").hide();
            $("#egambar").show();
            $("#elink").hide();
            $("#addgambar").prop('required',true);
            $("#addlink").removeAttr('required');
        } else {
            $("#vgambar").hide();
            $("#vlink").show();
            $("#egambar").hide();
            $("#elink").show();
            $("#addlink").prop('required',true);
            $("#addgambar").removeAttr('required');
        }
    });
</script>
@endsection
