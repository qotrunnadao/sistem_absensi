<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\User;
use App\Models\Absensi;

class DashboardController extends Controller
{
    public function index()
    {

        $absensi = Absensi::with('user')->get();
        $masuk = Absensi::where('jenis', 1)->get();
        $pulang = Absensi::where('jenis', 2)->get();
        $izin = Izin::where('status', 1)->get();
        $user = User::where('level', 1)->get();
        return view('dashboard', compact(
            'absensi',
            'masuk',
            'pulang',
            'izin',
            'user',
        ));
    }
}
