<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\web\M_about;
use DB;
use Str;

class WebController extends Controller
{
    public function indextentang()
    {
        $tentang = M_about::where('type', 0)->first();
        $visi    = M_about::where('type', 1)->first();
        $misi    = M_about::where('type', 2)->first();
        $moto    = M_about::where('type', 3)->first();
        $mutu    = M_about::where('type', 4)->first();

        $data = [
            'tentang' => $tentang,
            'visi'    => $visi,
            'misi'    => $misi,
            'moto'    => $moto,
            'mutu'    => $mutu,
        ];

        return view('back.web.about', $data);
    }

    public function storetentang(Request $request)
    {
        $tentang = M_about::where('type', 0)->first();
        $visi    = M_about::where('type', 1)->first();
        $misi    = M_about::where('type', 2)->first();
        $moto    = M_about::where('type', 3)->first();
        $mutu    = M_about::where('type', 4)->first();

        // $validatedData = $request->validate([
        //     'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        // ]);

        if($tentang){
            $data = M_about::findOrFail($tentang->id_about);
        }else{
            $data = new M_about;
        }

        if ($visi) {
            $datav = M_about::findOrFail($visi->id_about);
        } else {
            $datav = new M_about;
        }

        if ($misi) {
            $datam = M_about::findOrFail($misi->id_about);
        } else {
            $datam = new M_about;
        }

        if ($moto) {
            $datamt = M_about::findOrFail($moto->id_about);
        } else {
            $datamt = new M_about;
        }

        if ($mutu) {
            $datamu = M_about::findOrFail($mutu->id_about);
        } else {
            $datamu = new M_about;
        }
        
        // $request->validate([
        //     'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        if ($request->file('gambar')) {
            $imagePath = $request->file('gambar');
            $imageName = 'gambar-tentang-kami.jpg';

            $path = $request->file('gambar')->move('img/web', $imageName, 'public');
        }else{
            $imageName = 'default.jpg';
        }

        $data->type = 0;
        $data->isi  = $request->tentang;
        // $data->path = '/public/' . $path;
        $data->gambar = $imageName;

        $datav->type = 1;
        $datav->isi  = $request->visi;

        $datam->type = 2;
        $datam->isi  = $request->misi;

        $datamt->type = 3;
        $datamt->isi  = $request->moto;

        $datamu->type = 4;
        $datamu->isi  = $request->mutu;

        try {
            $data->save();
            $datav->save();
            $datam->save();
            $datamt->save();
            $datamu->save();

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

    public function indexgaleri()
    {
        // $tentang = M_about::where('type', 0)->first();

        // $data = [
        //     'tentang' => $tentang,
        // ];

        return view('back.web.galeri');
    }
}
