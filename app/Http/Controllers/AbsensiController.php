<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiController  extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $absensi = Auth::user()->id;
        $absensi = Absensi::with('user')->latest()->get();
        return view('absensi/indexAbsensi', compact('absensi'));
    }

    public function store(Request $request)
    {
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = time() . '.png';
        $data = $request->all();

        Storage::disk('public')->put('absensi/' . $fileName, $image_base64);
        $data['foto'] = $fileName;

        Absensi::create($data);
        Alert::success('Berhasil', 'Berhasil tambah data Absensi');
        return redirect('/dashboard');
    }


    public function show($id)
    {
        $data_list = Absensi::with('user')->find($id);
        // passing data Absensi yang didapat
        return view('absensi/showAbsensi', ['absensi_data' => $data_list]);
    }

    public function delete($id)
    {

        $absensi = Absensi::find($id);

        // hapus foto
        unlink(storage_path('app/public/absensi/') . $absensi['foto']);

        $absensi->delete();
        // alihkan halaman ke halaman Absensi
        Alert::success('Berhasil', 'Berhasil hapus data Absensi');
        return redirect('/absensi');
    }

    public function cetak()
    {
        return view('absensi.formcetak');
    }

    public function cetakabsensi($dari, $sampai)
    {
        $cetakabsensi = Absensi::with('user')->whereBetween('created_at', [$dari, $sampai])->get();
        $izin = Izin::with('user')->where('status', 1)->get();
        return view(
            'absensi.cetakabsensi',
            compact(
                'cetakabsensi',
                'dari',
                'sampai',
                'izin',
            ),
        );
    }

    public function kamera(Request $request)
    {
        $data = Absensi::with('user')->latest()->get();
        return view('absensi.kamera', compact('data'));
    }
}
