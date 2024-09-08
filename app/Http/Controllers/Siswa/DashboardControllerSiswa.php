<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\TahunAjaranModel;
use App\Models\Admin\PeriodeModel;

class DashboardControllerSiswa extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }
    public function index(){
            $menu = 'home';
            $submenu= 'home';
            return view ('Siswa/home',compact('menu','submenu'));
    }

    public function AjaxData() {
        $Periode = PeriodeModel::Dashboard();
        if ($Periode == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $Periode]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }
}
