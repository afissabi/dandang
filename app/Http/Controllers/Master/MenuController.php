<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\master\M_menu;
use DB;

class MenuController extends Controller
{
    public function index(){

        $all = M_menu::where('status',1)->get();

        $data = [
            'all' => $all,
        ];

        return view('back.master.menu',$data);
    }

    public function role()
    {
        return view('back.master.role');
    }

    public function datatable()
    {
        $datas = M_menu::OrderBy('status', 'ASC')->OrderBy('urutan', 'ASC')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = $value->nama_menu;
            $data_tables[$key][] = $value->url_menu;
            $data_tables[$key][] = $value->icon ? '<center><span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill"><i class="' . $value->icon . '"></i><br>' . $value->icon . '</span></center>' : '';
            
            if ($value->status == 0) {
                $data_tables[$key][] = '<center><span class="badge badge-success">TUNGGAL</span></center>';
            } elseif($value->status == 1) {
                $data_tables[$key][] = '<center><span class="badge badge-info">PARENT</span></center>';
            } elseif ($value->status == 2){
                $data_tables[$key][] = '<center><span class="badge badge-danger">CHILD</span></center>';
            }

            if ($value->is_aktif == 1) {
                $data_tables[$key][] = '<center><span class="badge badge-success">AKTIF</span></center>';
            } else {
                $data_tables[$key][] = '<center><span class="badge badge-danger">NON AKTIF</span></center>';
            }

            $aksi = '';

            $aksi .= '&nbsp; <a href="' . url('master/menu/edit', ['id' => $value->id_menu]) . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_menu . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

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
        $data = new M_menu;

        $data->nama_menu    = $request->nama_menu;
        $data->status       = $request->status;
        $data->parent_id    = $request->parent;
        $data->is_aktif     = $request->aktif_menu ? 1 : 0;
        $data->urutan       = $request->urut;
        $data->icon         = $request->icon;
        $data->url_menu     = $request->url_menu;
        
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

        $data = M_menu::findOrFail($request->id);

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
}
