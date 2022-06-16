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
        <div class="ribbon-label bg-primary" style="font-size: large;">Berita/Info</div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                <i class="fa fa-plus"></i> Berita/Info
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
                    <th width="40%"><center>Keterangan</center></th>
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
                <h5 class="modal-title">Tambah Berita/Info</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="form">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Gambar Berita/Info :</label>
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
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Judul Berita/Info :</label>
                        <div class="col-lg-9">
                            <input type="text" name="judul" class="form-control" placeholder="Judul Berita/Info" required>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Isi Berita/Info :</label>
                        <div class="col-lg-9">
                            <textarea name="keterangan" id="keterangan" placeholder="Isi Berita/Info"></textarea>
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
                <h5 class="modal-title">Edit Data Berita/Info</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="formedit">
                    <input type="hidden" class="form-control" id="id_artikel" name="id_artikel">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Gambar Berita/Info :</label>
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
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Judul Berita/Info :</label>
                        <div class="col-lg-9">
                            <input type="text" name="judul" class="form-control" placeholder="Judul Aktivitas/Kegiatan" id="edit_judul" required>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Isi Berita/Info :</label>
                        <div class="col-lg-9">
                            <textarea name="keterangan" id="edit_keterangan" rows="4" class="form-control" placeholder="Isi Berita/Info"></textarea>
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
        ClassicEditor
        .create(document.querySelector('#keterangan'), {
            removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
        })
        .catch(error => {
            console.error(error);
        });

        // ClassicEditor
        // .create(document.querySelector('#edit_keterangan'), {
        //     removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
        // })
        // .catch(error => {
        //     console.error(error);
        // });
</script>
<script>
    // $("#loading").hide();
    $(function () {
        $("#form").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menambah Berita/Info Anda ?",
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
                        url: "{{ url('cms-website/artikel/berita/simpan') }}",
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
                text: "Memperbarui Berita/Info anda ?",
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
                        url: "{{ url('cms-website/artikel/berita/ubah') }}",
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
                text: "Menghapus Data Berita/Info ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('cms-website/artikel/berita/destroy') }}",
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
                url : "{{ url('cms-website/artikel/berita/datatable') }}",
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
        var artikel = $(this).data('id_artikel');

        $.ajax({
            url: "{{ url('cms-website/artikel/berita/edit') }}",
            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                artikel: artikel,
            },
            success: function(msg){
                // Add response in Modal body
                if(msg){
                    $('#id_artikel').val(msg.id_artikel);
                    $('#edit_gambar').val(msg.gambar);
                    $("#gbth").css("background-image", "url('" + msg.gambar + "')");
                    $('#edit_keterangan').val(msg.keterangan);
                    // ClassicEditor.instances.edit_keterangan.setData( '<p>This is the editor data.</p>' );
                    $('#edit_judul').val(msg.judul);
                }else{
                    $('#id_artikel').val('');
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
@endsection
