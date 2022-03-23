<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\master\M_status;
use DB;

class StatusController extends Controller
{
    public function index(){

        $all = M_status::all();

        $data = [
            'all' => $all,
        ];

        return view('back.master.status',$data);
    }

    public function datatable()
    {
        $datas = M_status::OrderBy('id_status', 'ASC')->get();
        
        $data_tables = [];
        
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = $value->nama_status;
            $data_tables[$key][] = $value->keterangan;
            $data_tables[$key][] = $value->status_for;

            $aksi = '';
            
            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_status="' . $value->id_status . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_status . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

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
        $data = new M_status;

        $data->nama_status      = $request->nama_status;
        $data->keterangan       = $request->keterangan;
        $data->status_for       = $request->status_for;
        
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
        $data   = M_status::findOrFail($request->status);
        
        return response()->json($data);
    }

    public function ubah(Request $request)
    {
        $data = M_status::findOrFail($request->id_status);

        $data->nama_status      = $request->nama_status;
        $data->keterangan       = $request->keterangan;
        $data->status_for       = $request->status_for;

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

        $data = M_status::findOrFail($request->id);

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
