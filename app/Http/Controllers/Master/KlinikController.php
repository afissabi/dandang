<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\master\M_klinik;
use App\Models\master\M_poli;
use App\Models\master\M_status;
use DB;
use Str;

class KlinikController extends Controller
{
    public function index(){

        $status = M_status::where('status_for', 1)->get();

        $data = [
            'status' => $status,
        ];

        return view('back.master.klinik.daftar',$data);
    }

    public function datatable()
    {
        $datas = M_klinik::where('is_aktif',1)->OrderBy('status', 'ASC')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = $value->nama_klinik;
            $data_tables[$key][] = $value->alamat;
            $data_tables[$key][] = $value->telp . '<br> WA :' . $value->whatsapp;
            $data_tables[$key][] = $value->email;
            $data_tables[$key][] = 'IG :' . $value->instagram ? $value->instagram : '-' . '<br>TW :' . $value->twitter;
            $data_tables[$key][] = $value->stat->nama_status;

            if ($value->is_aktif == 1) {
                $data_tables[$key][] = '<center><span class="badge badge-success">AKTIF</span></center>';
            } else {
                $data_tables[$key][] = '<center><span class="badge badge-danger">NON AKTIF</span></center>';
            }

            $aksi = '';
            
            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_klinik="' . $value->id_klinik . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_klinik . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

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
        $data = new M_klinik;

        $data->nama_klinik  = $request->nama_klinik;
        $data->alamat       = $request->alamat;
        $data->telp         = $request->telp;
        $data->email        = $request->email;
        $data->whatsapp     = $request->whatsapp;
        $data->instagram    = $request->instagram;
        $data->twitter      = $request->twitter;
        $data->status       = $request->status;
        $data->is_aktif     = $request->aktif_klinik ? 1 : 0;
        
        
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
        $data   = M_klinik::findOrFail($request->klinik);
        
        return response()->json($data);
    }

    public function ubah(Request $request)
    {
        $data = M_klinik::findOrFail($request->id_klinik);

        $data->nama_klinik  = $request->nama_klinik;
        $data->alamat       = $request->alamat;
        $data->telp         = $request->telp;
        $data->email        = $request->email;
        $data->whatsapp     = $request->whatsapp;
        $data->instagram    = $request->instagram;
        $data->twitter      = $request->twitter;
        $data->status       = $request->status;
        $data->is_aktif     = $request->aktif_klinik ? 1 : 0;

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

        $data = M_klinik::findOrFail($request->id);

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

    public function indexpoli(){

        $klinik = M_klinik::where('is_aktif', 1)->get();

        $data = [
            'klinik' => $klinik,
        ];

        return view('back.master.klinik.poli',$data);
    }

    public function datatablepoli()
    {
        $datas = M_poli::where('is_aktif',1)->OrderBy('nama_poli', 'ASC')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = $value->nama_poli;
            $data_tables[$key][] = $value->keterangan;
            $data_tables[$key][] = $value->klinik->nama_klinik;

            if ($value->is_aktif == 1) {
                $data_tables[$key][] = '<center><span class="badge badge-success">AKTIF</span></center>';
            } else {
                $data_tables[$key][] = '<center><span class="badge badge-danger">NON AKTIF</span></center>';
            }

            $aksi = '';
            
            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_poli="' . $value->id_poli . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_poli . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        // dd($datas);
        return response()->json($data);
    }

    public function storepoli(Request $request)
    {
        $data = new M_poli;

        $data->nama_poli    = $request->nama_poli;
        $data->keterangan   = $request->keterangan;
        $data->telp         = $request->telp;
        $data->slug         = Str::slug($request->nama_poli, '-');
        $data->klinik_id    = $request->klinik;
        $data->is_aktif     = $request->aktif_poli ? 1 : 0;
        
        
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

    public function editpoli(Request $request)
    {
        $data   = M_poli::findOrFail($request->poli);
        
        return response()->json($data);
    }

    public function ubahpoli(Request $request)
    {
        $data = M_poli::findOrFail($request->id_poli);

        $data->nama_poli    = $request->nama_poli;
        $data->keterangan   = $request->keterangan;
        $data->telp         = $request->telp;
        $data->slug         = Str::slug($request->nama_poli, '-');
        $data->klinik_id    = $request->klinik;
        $data->is_aktif     = $request->aktif_poli ? 1 : 0;

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

    public function destroypoli(Request $request)
    {

        $data = M_poli::findOrFail($request->id);

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
