@extends('back.layout.app')

@section('content')
<div class="card card-flush shadow-sm">
    <div class="card-header border-0 pt-6 justify-content-end ribbon ribbon-start">
        {{-- <h3 class="card-title">Title</h3> --}}
        <div class="ribbon-label bg-primary" style="font-size: large;">Akses Menu Role {{ $role->nama_role }}</div>
    </div>
    <div class="card-body py-5 table-responsive">
        <form method="post" class="kt-form kt-form--label-right" id="form">
            <input type="hidden" name="id_role" value="{{ $role->id_role }}">
            <table id="table" class="table table-striped gy-5 gs-7 border rounded">
                <thead>
                    <tr role="row">
                        <th width="2%"><center>NO</center></th>
                        <th><center>Nama Menu</center></th>
                        <th><center>Pilih</center></th>
                        <th><center>Create</center></th>
                        <th><center>Update</center></th>
                        <th><center>Delete</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                    ?>
                    @foreach($menu as $value)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $value->nama_menu }}</td>
                            <td><center><input type="checkbox" value="{{ $value->id_menu }}" name="id_menu[]" @if($value->menu_sub != null ) checked @endif></center></td>
                            <td><center><input type="checkbox" name="create[]" value="{{ $value->create_btn }}"></center></td>
                            <td><center><input type="checkbox" name="edit[]" value="{{ $value->edit_btn }}"></center></td>
                            <td><center><input type="checkbox" name="delete[]" value="{{ $value->delete_btn }}"></center></td>
                        </tr>
                        @foreach($value->sub as $item)
                        <tr>
                            <td>-</td>
                            <td>{{ $item->nama_menu }}</td>
                            <td><center><input type="checkbox" value="{{ $item->id_menu }}" name="id_menu[]" @if($item->sub_menu != null ) checked @endif></center></td>
                            <td><center><input type="checkbox" name="create[]" value="{{ $item->create_btn }}"></center></td>
                            <td><center><input type="checkbox" name="edit[]" value="{{ $item->edit_btn }}"></center></td>
                            <td><center><input type="checkbox" name="delete[]" value="{{ $item->delete_btn }}"></center></td>
                        </tr>
                            @foreach($item->sub_child as $data)
                            <tr>
                                <td></td>
                                <td># {{ $data->nama_menu }}</td>
                                <td><center><input type="checkbox" value="{{ $data->id_menu }}" name="id_menu[]" @if($data->sub_menu_child != null ) checked @endif></center></td>
                                <td><center><input type="checkbox" name="create[]" value="{{ $data->create_btn }}"></center></td>
                                <td><center><input type="checkbox" name="edit[]" value="{{ $data->edit_btn }}"></center></td>
                                <td><center><input type="checkbox" name="delete[]" value="{{ $data->delete_btn }}"></center></td>
                            </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            <a href="{{ url('master/hak-akses/role-user') }}" class="btn btn-warning"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        </form>
    </div>
</div>

@endsection

@section('custom_js')
<script>
$(function () {
        $("#form").submit(function(e) {
            e.preventDefault();

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menambah Data Menu Untuk Role ini ",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Tambah!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('master/hak-akses/role-user/simpan-menu') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        data: $('#form').serialize()
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
