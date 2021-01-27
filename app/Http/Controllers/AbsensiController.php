<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Absensi;

class AbsensiController  extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('absensi/indexAbsensi');
    }

    public function data_json(Request $request)
    {
        if ($request->ajax()) {
            $data =  Absensi::with('user')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = $row['id'];
                    $btn = "<a href='absensi/show/$id' class='show btn btn-info btn-sm'><i class='fa fa-eye'></i></a>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('absensi/createAbsensi', ['action' => url('absensi/store'), 'button' => 'Tambah']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|max:100',
            'jenis' => 'required|max:100',
            'foto' => 'required|max:100',
            'latitude' => 'required|max:100',
            'longitude' => 'required|max:100',
        ]);
        Absensi::create($request->all());
        Alert::success('Berhasil', 'Berhasil tambah data Absensi');
        return redirect('/absensi');
    }


    public function show($id)
    {
        $data_list = Absensi::find($id);
        // passing data Absensi yang didapat
        return view('absensi/showAbsensi', ['absensi_data' => $data_list]);
    }

    public function edit($id)
    {
        $data_list = Absensi::find($id);
        // passing data Absensi yang didapat
        return view('absensi/createAbsensi', ['absensi_data' => $data_list, 'action' => url('absensi/update'), 'button' => 'Edit']);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|max:100',
            'jenis' => 'required|max:100',
            'foto' => 'required|max:100',
            'latitude' => 'required|max:100',
            'longitude' => 'required|max:100',
        ]);
        $absensi = Absensi::where('id', $id)->first();
        $absensi->user_id = $request->user_id;
        $absensi->jenis = $request->jenis;
        $absensi->foto = $request->foto;
        $absensi->latitude = $request->latitude;
        $absensi->longitude = $request->longitude;
        $absensi->save();
        // alihkan halaman ke halaman Absensi
        Alert::success('Berhasil', 'Berhasil edit data Absensi');
        return redirect('/absensi');
    }

    public function delete($id)
    {
        $absensi = Absensi::find($id);
        $absensi->delete();
        // alihkan halaman ke halaman Absensi
        Alert::success('Berhasil', 'Berhasil hapus data Absensi');
        return redirect('/absensi');
    }

    public function aksisimpan()
    {
        $img = $_POST['image'];
        $folderPath = public_path('fotoAbsensi/');

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
    }

    public function cetak()
    {
        return view('absensi.formcetak');
    }

    public function cetakabsensi($dari, $sampai)
    {
        dd(["dari :" . $dari, "sampai :" . $sampai]);
        $cetakabsensi = Absensi::with('user')->whereBetween('created_at', [$dari, $sampai])->latest()->get();
        return view('absensi.cetakabsensi', compact('cetakabsensi'));
    }
}
