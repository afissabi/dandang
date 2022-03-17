<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\master\M_role;
use App\Models\master\M_menu;
use App\Models\master\M_menu_user;
use DB;

class RoleController extends Controller
{
    public function index()
    {
        return view('back.master.role');
    }

    public function datatable()
    {
        $datas = M_role::OrderBy('nama_role', 'ASC')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = $value->nama_role;
            $data_tables[$key][] = $value->keterangan;

            if ($value->is_aktif == 1) {
                $data_tables[$key][] = '<center><span class="badge badge-success">AKTIF</span></center>';
            } else {
                $data_tables[$key][] = '<center><span class="badge badge-danger">NON AKTIF</span></center>';
            }

            $aksi = '';

            $aksi .= '<center>';

            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_role="' . $value->id_role . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_role . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

            $aksi .= '<br><a href="' . url('master/hak-akses/role-user/menu/' . encrypt($value->id_role)) . '" class="btn btn-info" style="padding: 5px;border-radius: 5px;" data-id_user="' . $value->id_role . '"><i class="fa fa-key"></i> Menu Akses</a>';

            $aksi .= '</center>';

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        // dd($datas);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = new M_role;

        $data->nama_role    = $request->nama_role;
        $data->keterangan   = $request->keterangan;
        $data->is_aktif     = $request->aktif_menu ? 1 : 0;

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Berhasil Disimpan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function edit(Request $request)
    {
        $data   = M_role::findOrFail($request->role);

        return response()->json($data);
    }

    public function ubah(Request $request)
    {
        $data = M_role::findOrFail($request->id_role);

        $data->nama_role    = $request->nama_role;
        $data->keterangan   = $request->keterangan;
        $data->is_aktif     = $request->aktif_menu ? 1 : 0;

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Berhasil Disimpan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function destroy(Request $request)
    {

        $data = M_role::findOrFail($request->id);

        if ($data->delete()) {

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Terhapus!',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Terhapus!',
            ]);
        }
    }

    public function menu($id)
    {
        $id_role = decrypt($id);
        $role = M_role::findOrFail($id_role);
        $menu = M_menu::whereIn('status', ['0', '1', '5'])->OrderBy('urutan', 'ASC')->where('deleted_at', null)->get();

        foreach ($menu as $value) {
            $value->sub = M_menu::where('parent_id', $value->id_menu)->whereIn('status', ['3','6'])->where('deleted_at', null)->get();
            $value->menu_sub = M_menu_user::where('id_role', $id_role)->where('id_menu', $value->id_menu)->where('deleted_at', null)->first();
            foreach ($value->sub as $item) {
                $item->sub_child = M_menu::where('sub_parent_id', $item->id_menu)->where('status', 4)->where('deleted_at', null)->get();
                $item->sub_menu  = M_menu_user::where('id_role', $id_role)->where('id_menu', $item->id_menu)->where('deleted_at', null)->first();
                foreach($item->sub_child as $data){
                    $data->menu_child  = M_menu_user::where('id_role', $id_role)->where('id_menu', $item->id_menu)->where('deleted_at', null)->first();
                    $data->sub_menu_child  = M_menu_user::where('id_role', $id_role)->where('id_menu', $item->id_menu)->where('deleted_at', null)->first();
                }
            }
            // $value->menu_user = M_menu_user::where('id_role', $id_role)->where('id_menu', $value->id_menu)->where('deleted_at',null)->first();
        }


        $data = [
            'id_role' => $id_role,
            'role'    => $role,
            'menu'    => $menu,
        ];

        return view('back.master.menurole', $data);
    }

    public function storeMenu(Request $request)
    {
        try {
            for ($i = 0; $i < count($request->id_menu); $i++) {
                if (isset($request->id_menu[$i])) {

                    $cek = M_menu_user::where('id_role', $request->id_role)->where('id_menu', $request->id_menu[$i])->first();

                    if ($cek == null) {
                        $data = new M_menu_user;
                    } else {
                        $data = M_menu_user::findOrFail($cek->id_menu_user);
                    }

                    $data->id_role    = $request->id_role;
                    $data->id_menu    = $request->id_menu[$i];

                    $data->save();
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Berhasil Disimpan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }
}
