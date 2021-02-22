<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Libur;
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

        if (Auth::user()->level == 0) {
            $data = Absensi::with('user')->latest()->get();
            return view('absensi/indexAbsensi', compact('data'));
        } else {
            $absensi = Auth::user()->id;
            $data = Absensi::with('user')->where('user_id', $absensi)->latest()->get();
            return view('absensi/indexAbsensi', compact('data'));
        }
    }

    public function store(Request $request)
    {
        $data_libur = Libur::pluck('tanggal')->toArray();
        $cek_weekend = $this->isWeekend(date('Y-m-d'));

        if ($cek_weekend) { //weekend
            Alert::error('Gagal', 'Weekend ngapain absen');
            return redirect('/absensi');
        }

        if (in_array(date('Y-m-d'), $data_libur)) {
            Alert::error('Gagal', 'Libur ngapain absen');
            return redirect('/absensi');
        }

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
        return redirect('/absensi');
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
        $data = array(
            'data_user' => User::latest()->get(),
        );
        return view('absensi.formcetak', $data);
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

    // public function cetakuser($id)
    // {
    //     $cetakuser = Absensi::with('user')->where('user_id', $id)->get();
    //     return view('absensi.cetakuser', compact('cetakuser'));
    // }

    public function kamera(Request $request)
    {
        $data = Absensi::with('user')->latest()->get();
        return view('absensi.kamera', compact('data'));
    }

    public function isWeekend($date)
    {
        return (date('N', strtotime($date)) >= 6);
    }
}
