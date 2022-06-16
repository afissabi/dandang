<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\web\M_about;
use App\Models\web\M_galeri;
use App\Models\web\M_aktivitas;
use App\Models\web\M_artikel;
use Carbon\Carbon;
use DB;
use Image;
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

    public function tablegaleri()
    {
        $datas = M_galeri::OrderBy('id_galeri', 'ASC')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            if($value->type == 0){
                $data_tables[$key][] = '<center><i class="fa fa-image"></i> Gambar</center>';
                $data_tables[$key][] = '<center><img src="'. asset('img/web/galeri/thumbnail/' . $value->link ) . '" style="width: 100px;"></center>';
            }else{
                $data_tables[$key][] = '<center><i class="fa fa-video"></i> Link Video</center>';
                $data_tables[$key][] = $value->link;
            }
            $data_tables[$key][] = $value->judul;
            $data_tables[$key][] = $value->keterangan;

            $aksi = '';

            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_galeri="' . $value->id_galeri . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_galeri . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        // dd($datas);
        return response()->json($data);
    }

    public function storegaleri(Request $request)
    {
        $data = new M_galeri;
        $id_galeri = M_galeri::max('id_galeri') + 1;

        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $destinationPath = public_path('/img/web/galeri/thumbnail');
            $img = Image::make($image->path());
            $imageName = $request->type . '-' . Carbon::now()->format("Y-m-d") . '-' . $id_galeri . '.jpg';

            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $imageName);

            $destinationPath = public_path('/img/web/galeri/');
            $image->move($destinationPath, $imageName);
        } else {
            $imageName = $request->link;
        }

        $data->type       = $request->type;
        $data->judul      = $request->judul;
        $data->keterangan = $request->keterangan;
        $data->link       = $imageName;

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

    public function editgaleri(Request $request)
    {
        $data = M_galeri::findOrFail($request->galeri);

        if($data->type == 0){
            $link = asset('img/web/galeri/thumbnail/' . $data->link);
        }else{
            $link = $data->link;
        }
        
        $data =[
            'link'          => $link,
            'type'          => $data->type,
            'judul'         => $data->judul,
            'keterangan'    => $data->keterangan,
            'id_galeri'     => $data->id_galeri,
        ];

        return response()->json($data);
    }

    public function ubahgaleri(Request $request)
    {
        $data = M_galeri::findOrFail($request->id_galeri);
        
        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $destinationPath = public_path('/img/web/galeri/thumbnail');
            $img = Image::make($image->path());
            $imageName = $request->type . '-' . Carbon::now()->format("Y-m-d") . '-' . $request->id_galeri . '.jpg';

            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $imageName);

            $destinationPath = public_path('/img/web/galeri/');
            $image->move($destinationPath, $imageName);
        } else {
            $imageName = $request->link;
        }

        $data->type       = $request->type;
        $data->judul      = $request->judul;
        $data->keterangan = $request->keterangan;
        $data->link       = $imageName;

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

    public function destroygaleri(Request $request)
    {
        $data = M_galeri::findOrFail($request->id);

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

    // Controller Untuk Aktivitas
    public function indexaktivitas()
    {
        return view('back.web.aktivitas');
    }

    public function tableaktivitas()
    {
        $datas = M_aktivitas::OrderBy('id_aktivitas', 'ASC')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = '<center><img src="'. asset('img/web/aktivitas/thumbnail/' . $value->gambar ) . '" style="width: 100px;"></center>';
            $data_tables[$key][] = $value->judul;
            $data_tables[$key][] = $value->keterangan;

            $aksi = '';

            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_aktivitas="' . $value->id_aktivitas . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_aktivitas . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        // dd($datas);
        return response()->json($data);
    }

    public function storeaktivitas(Request $request)
    {
        $data = new M_aktivitas;
        $id_aktivitas = M_aktivitas::max('id_aktivitas') + 1;

        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $destinationPath = public_path('/img/web/aktivitas/thumbnail');
            $img = Image::make($image->path());
            $imageName =  'av-' . Carbon::now()->format("Y-m-d") . '-' . $id_aktivitas . '.jpg';

            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $imageName);

            $destinationPath = public_path('/img/web/aktivitas/');
            $image->move($destinationPath, $imageName);
        } else {
            $imageName = 'default.jpg';
        }

        $data->judul      = $request->judul;
        $data->keterangan = $request->keterangan;
        $data->gambar     = $imageName;

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

    public function editaktivitas(Request $request)
    {
        $data = M_aktivitas::findOrFail($request->aktivitas);

        $gambar = asset('img/web/aktivitas/thumbnail/' . $data->gambar);
        
        $data =[
            'gambar'        => $gambar,
            'judul'         => $data->judul,
            'keterangan'    => $data->keterangan,
            'id_aktivitas'  => $data->id_aktivitas,
        ];

        return response()->json($data);
    }

    public function ubahaktivitas(Request $request)
    {
        $data = M_aktivitas::findOrFail($request->id_aktivitas);
        
        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $destinationPath = public_path('/img/web/aktivitas/thumbnail');
            $img = Image::make($image->path());
            $imageName = 'av-' . Carbon::now()->format("Y-m-d") . '-' . $request->id_aktivitas . '.jpg';

            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $imageName);

            $destinationPath = public_path('/img/web/aktivitas/');
            $image->move($destinationPath, $imageName);
        } else {
            $imageName = 'default.jpg';
        }

        $data->judul      = $request->judul;
        $data->keterangan = $request->keterangan;
        $data->gambar     = $imageName;

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

    public function destroyaktivitas(Request $request)
    {
        $data = M_aktivitas::findOrFail($request->id);

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

    // Controller Untuk Berita
    public function indexnews()
    {
        return view('back.web.artikel');
    }

    public function tablenews()
    {
        $datas = M_artikel::OrderBy('id_artikel', 'ASC')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = '<center><img src="'. asset('img/web/artikel/thumbnail/' . $value->gambar ) . '" style="width: 100px;"></center>';
            $data_tables[$key][] = $value->judul;
            $data_tables[$key][] = substr($value->isi, 0, 100) . '...';

            $aksi = '';

            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_artikel="' . $value->id_artikel . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_artikel . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        // dd($datas);
        return response()->json($data);
    }

    public function storenews(Request $request)
    {
        $data = new M_artikel;
        $id_artikel = M_artikel::max('id_artikel') + 1;

        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $destinationPath = public_path('/img/web/artikel/thumbnail');
            $img = Image::make($image->path());
            $imageName =  'at-' . Carbon::now()->format("Y-m-d") . '-' . $id_artikel . '.jpg';

            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $imageName);

            $destinationPath = public_path('/img/web/artikel/');
            $image->move($destinationPath, $imageName);
        } else {
            $imageName = 'default.jpg';
        }

        $data->judul      = $request->judul;
        $data->isi        = $request->keterangan;
        $data->gambar     = $imageName;

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

    public function editnews(Request $request)
    {
        $data = M_artikel::findOrFail($request->artikel);

        $gambar = asset('img/web/artikel/thumbnail/' . $data->gambar);

        $data =[
            'gambar'        => $gambar,
            'judul'         => $data->judul,
            'keterangan'    => $data->isi,
            'id_artikel'    => $data->id_artikel,
        ];

        return response()->json($data);
    }

    public function ubahnews(Request $request)
    {
        $data = M_artikel::findOrFail($request->id_artikel);
        
        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $destinationPath = public_path('/img/web/artikel/thumbnail');
            $img = Image::make($image->path());
            $imageName = 'at-' . Carbon::now()->format("Y-m-d") . '-' . $request->id_artikel . '.jpg';

            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $imageName);

            $destinationPath = public_path('/img/web/artikel/');
            $image->move($destinationPath, $imageName);
        } else {
            $imageName = 'default.jpg';
        }

        $data->judul      = $request->judul;
        $data->isi        = $request->keterangan;
        $data->gambar     = $imageName;

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

    public function destroynews(Request $request)
    {
        $data = M_artikel::findOrFail($request->id);

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