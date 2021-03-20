<?php

namespace App\Http\Controllers;

use CURLFile;
use App\Models\Izin;
use App\Models\User;
use App\Models\Libur;
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
        $absensi = Auth::user()->id;
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
        $fileName = time() . '.jpg';
        $data = $request->all();

        Storage::disk('public')->put('absensi/' . $fileName, $image_base64);
        $data['foto'] = $fileName;

        Absensi::create($data);
        // Create a cURL handle
        $ch = curl_init('http://36.92.197.205/opencv/api_upload_gambar.php');
        // Create a CURLFile object
        $cfile = new CURLFile('http://localhost/absensi/public/storage/absensi/' . $fileName, 'image/jpeg', $fileName);
        // Assign POST data
        $data = array(
            'filegambar' => $cfile,
            'namagambar' => $fileName,
            'kode_token' => 'jenderalsoftware',
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // Execute the handle
        curl_exec($ch);
        Alert::success('Berhasil', 'Berhasil tambah data Absensi');
        return redirect('/absensi/verifikasi');
    }

    public function verifikasi()
    {
        $session = Auth::user()->id;
        $user =  DB::table('users')->select('foto')->where('id', $session)->first();
        $absensi = Absensi::with('user')->select('foto')->where('user_id', $session)->limit(1)->latest(1);
        $hasil_scan = time();

        $ch = curl_init('http://36.92.197.205/opencv/verif_foto.php?gambar_master=1615283094&&gambar_scan=1615283243&&hasil_scan=hasilscan&&kode_token=jenderalsoftware');
        $data = array(
            'gambar_master' => $user,
            'gambar_scan' => $absensi,
            'hasil_scan' => $hasil_scan,
            'kode_token' => 'jenderalsoftware',
        );
        dd($data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);
        //dd($ch);
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
        if (Auth::user()->level == 0) {
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
        } else {
            $absensi = Auth::user()->id;
            $cetakabsensi = Absensi::with('user')->where('user_id', $absensi)->whereBetween('created_at', [$dari, $sampai])->get();
            $izin = Izin::with('user')->where('user_id', $absensi)->where('status', 1)->get();
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
    }


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
