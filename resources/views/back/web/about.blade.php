@extends('back.layout.app')

@section('content')
<div class="card card-flush shadow-sm">
    <div class="card-header border-0 pt-6 justify-content-end ribbon ribbon-start">
        <div class="ribbon-label bg-primary" style="font-size: large;">Halaman Tentang Kami</div>
    </div>
    <div class="card-body py-5 table-responsive">
        <form method="post" id="formtentang" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row mb-10">
                <label class="col-lg-2 col-form-label text-lg-end required">Gambar Halaman :</label>
                <div class="col-lg-10">
                    <div class="mt-1">
                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('img/web/default.jpg' )}})">
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ asset('img/web/' . $tentang->gambar )}})"></div>
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
                <label class="col-lg-2 col-form-label text-lg-end required">Tentang Perusahaan :</label>
                <div class="col-lg-10">
                    <textarea name="tentang" id="tentang">
                        {!! $tentang ? $tentang->isi : '' !!}
                    </textarea>
                </div>
            </div>
            <div class="row mb-10">
                <label class="col-lg-2 col-form-label text-lg-end required">Visi Perusahaan :</label>
                <div class="col-lg-10">
                    <textarea name="visi" id="visi">
                        {!! $visi ? $visi->isi : '' !!}
                    </textarea>
                </div>
            </div>
            <div class="row mb-10">
                <label class="col-lg-2 col-form-label text-lg-end required">Misi Perusahaan :</label>
                <div class="col-lg-10">
                    <textarea name="misi" id="misi">
                        {!! $misi ? $misi->isi : '' !!}
                    </textarea>
                </div>
            </div>
            <div class="row mb-10">
                <label class="col-lg-2 col-form-label text-lg-end required">Moto Perusahaan :</label>
                <div class="col-lg-10">
                    <textarea name="moto" id="moto">
                        {!! $moto ? $moto->isi : '' !!}
                    </textarea>
                </div>
            </div>
            <div class="row mb-10">
                <label class="col-lg-2 col-form-label text-lg-end required">Kebjikan Mutu :</label>
                <div class="col-lg-10">
                    <textarea name="mutu" id="mutu">
                        {!! $mutu ? $mutu->isi : '' !!}
                    </textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
    </div>
</div>
@endsection

@section('custom_js')
    <script>
        ClassicEditor
        .create(document.querySelector('#tentang'), {
            removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
        })
        .catch(error => {
            console.error(error);
        });

        ClassicEditor
        .create(document.querySelector('#visi'), {
            removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
        })
        .catch(error => {
            console.error(error);
        });

        ClassicEditor
        .create(document.querySelector('#misi'), {
            removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
        })
        .catch(error => {
            console.error(error);
        });

        ClassicEditor
        .create(document.querySelector('#moto'), {
            removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
        })
        .catch(error => {
            console.error(error);
        });

        ClassicEditor
        .create(document.querySelector('#mutu'), {
            removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
        })
        .catch(error => {
            console.error(error);
        });
    </script>
    {{-- <script type="text/javascript">
        function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $('#gambar_nodin').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
        }
    </script>
    <script type="text/javascript">
    $("#preview_gambar").change(function(){
        bacaGambar(this);
    });
    </script> --}}
    <script>
        $(function () {
            $("#formtentang").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                swal.fire({
                    title: "Apa Anda Yakin?",
                    text: "Memperbarui isi Tentang Kami ?",
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
                            url: "{{ url('cms-website/tentang-kami/simpan') }}",
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
    </script>

    <script type="text/javascript">
        function cekImageType(oInput, event) {
            if(oInput.files[0].size > 2000000) {
                alert('Maaf, file terlalu besar.. Maksimal 2MB')
                oInput.value = "";
                return false;
            } else {
                var _validFileExtensions = [".jpg", ".jpeg", ".png"];
                if (oInput.type == "file") {
                    var sFileName = oInput.value;
                    if (sFileName.length > 0) {
                        var blnValid = false;
                        for (var j = 0; j < _validFileExtensions.length; j++) {
                            var sCurExtension = _validFileExtensions[j];
                                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                                blnValid = true;
                                break;
                            }
                        }                   
                        if (!blnValid) {
                            alert("Maaf, hanya mendukung tipe: " + _validFileExtensions.join(", "));
                            oInput.value = "";
                            return false;
                        }
                    }
                }
                return true;
            }
        }
    </script>
@endsection
