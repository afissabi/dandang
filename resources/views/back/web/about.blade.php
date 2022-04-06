@extends('back.layout.app')

@section('content')
<div class="card card-flush shadow-sm">
    <div class="card-header border-0 pt-6 justify-content-end ribbon ribbon-start">
        <div class="ribbon-label bg-primary" style="font-size: large;">Tentang Kami</div>
    </div>
    <div class="card-body py-5 table-responsive">
        <form method="post" id="formtentang">
            <textarea name="tentang" id="tentang">
                {!! $tentang ? $tentang->isi : '' !!}
            </textarea>
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
    </script>
    <script>
        $(function () {
            $("#formtentang").submit(function(e) {
                e.preventDefault();

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
                            type: "post",
                            url: "{{ url('cms-website/tentang-kami/simpan') }}",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            dataType: "json",
                            data: $('#formtentang').serialize()
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
@endsection
