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
        // $cek_weekend = $this->isWeekend(date('Y-m-d'));
        // if ($cek_weekend) { //weekend
        //     Alert::error('Gagal', 'Weekend ngapain absen');
        //     return redirect('/absensi');
        // }
        // if (in_array(date('Y-m-d'), $data_libur)) {
        //     Alert::error('Gagal', 'Libur ngapain absen');
        //     return redirect('/absensi');
        // }
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
        //Alert::success('Berhasil', 'Berhasil tambah data Absensi');
        return redirect('/absensi/verifikasi');
    }

    public function verifikasi()
    {
        $session = Auth::user()->id;
        $user =  DB::table('users')->select('foto')->where('id', $session)->first();
        $absensi = Absensi::with('user')->select('*')->where('user_id', $session)->latest()->first();
        $last_foto = str_replace('.jpg', '', $absensi->foto);
        $foto_master = str_replace('.jpg', '', $user->foto);
        $hasil_scan = time();
        //dd($absensi);

        $link = "http://36.92.197.205/opencv/verif_foto.php?gambar_master=" . $foto_master . "&&gambar_scan=" . $last_foto . "&&hasil_scan=" . $hasil_scan . "&&kode_token=jenderalsoftware";
        //dd($link);
        $ch = curl_init("http://36.92.197.205/opencv/verif_foto.php?gambar_master=" . $foto_master . "&&gambar_scan=" . $last_foto . "&&hasil_scan=" . $hasil_scan . "&&kode_token=jenderalsoftware");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //response returned but stored not displayed in browser
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch); //executing request
        $err = curl_error($ch);
        $hasil = json_encode($result);
        //dd(json_decode($hasil));
        $word = "true";
        $mystring = $result;
        if (strpos($mystring, $word) !== false) {
            //echo "muka tidak sesuai";
            unlink(storage_path('app/public/absensi/') . $absensi['foto']);
            $absensi->delete();
            Alert::error('Gagal', 'Muka Tidak Sesuai');
            return redirect('/absensi');
        } else {

            $url = "http://36.92.197.205/opencv/test_hasil/" . $hasil_scan . ".jpg";
            if ($url) {
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::disk('public')->put('hasil_absensi/' . $name, $contents);
                Alert::success('Berhasil', 'Berhasil tambah data Absensi');
                return redirect('/absensi');
            }
        }
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
