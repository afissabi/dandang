<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M_user;
use App\Models\master\M_menu;
use App\Models\master\M_menu_user;
use DB;

class UserController extends Controller
{
    public function index()
    {
        return view('back.master.user');
    }

    public function datatable()
    {
        $datas = M_user::OrderBy('id_user', 'ASC')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = $value->nama;
            $data_tables[$key][] = $value->username;

            if ($value->is_aktif == 1) {
                $data_tables[$key][] = '<center><span class="badge badge-success">AKTIF</span></center>';
            } else {
                $data_tables[$key][] = '<center><span class="badge badge-danger">NON AKTIF</span></center>';
            }

            $aksi = '';

            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_user="' . $value->id_user . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_user . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

            $aksi .= '&nbsp; <a href="'. url('master/hak-akses/user/menu-user/' . encrypt($value->id_user)).'" class="menu text-dark" data-id_user="' . $value->id_user . '"><i class="fa fa-key text-info"></i> Menu Akses</a>';

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        // dd($datas);
        return response()->json($data);
    }

    public function menu_user($id)
    {
        $id_user = decrypt($id);
        $user = M_user::findOrFail($id_user);
        $menu = M_menu::whereIn('status',['0','1'])->OrderBy('urutan','ASC')->get();

        foreach($menu as $value){
            $value->sub = M_menu::where('parent_id',$value->id_menu)->where('status',3)->get();
            foreach($value->sub as $item){
                $item->sub_child = M_menu::where('sub_parent_id',$item->id_menu)->where('status',4)->get();
            }
            $value->menu_user = M_menu_user::where('id_user',$id_user)->where('id_menu',$value->id_menu)->first();
        }
        

        $data = [
            'id_user' => $id_user,
            'user'    => $user,
            'menu'    => $menu,
        ];

        return view('back.master.menuuser',$data);
    }
}
