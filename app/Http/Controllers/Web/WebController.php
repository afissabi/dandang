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

        $data = [
            'tentang' => $tentang,
            'visi'    => $visi,
            'misi'    => $misi,
        ];

        return view('back.web.about', $data);
    }

    public function storetentang(Request $request)
    {
        $tentang = M_about::where('type', 0)->first();
        $visi    = M_about::where('type', 1)->first();
        $misi    = M_about::where('type', 2)->first();

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
        
        // $request->validate([
        //     'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        if ($request->file('gambar')) {
            $imagePath = $request->file('gambar');
            $imageName = 'gambar-tentang-kami.jpg';

            $path = $request->file('gambar')->move('img/web', $imageName, 'public');
        }

        $data->type = 0;
        $data->isi  = $request->tentang;
        $data->path = '/public/' . $path;
        $data->gambar = $imageName;

        $datav->type = 1;
        $datav->isi  = $request->visi;

        $datam->type = 2;
        $datam->isi  = $request->misi;

        try {
            $data->save();
            $datav->save();
            $datam->save();

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
