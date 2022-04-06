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

        $data = [
            'tentang' => $tentang,
        ];

        return view('back.web.about', $data);
    }

    public function storetentang(Request $request)
    {
        $tentang = M_about::where('type', 0)->first();
        if($tentang){
            $data = M_about::findOrFail($tentang->id_about);
        }else{
            $data = new M_about;
        }
        
        $data->type = 0;
        $data->isi  = $request->tentang;

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
}
