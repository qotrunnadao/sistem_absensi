<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Absensi;
use Illuminate\Support\Facades\Storage;

class AbsensiController  extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $absensi = Absensi::with('user')->get();
        return view('absensi/indexAbsensi', compact('absensi'));
    }

    // public function data_json(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data =  Absensi::with('user')->latest()->get();
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function ($row) {
    //                 $id = $row['id'];
    //                 $btn = "<a href='absensi/show/$id' class='show btn btn-info btn-sm'><i class='fa fa-eye'></i></a>";
    //                 return $btn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }

    public function create()
    {
        return view('absensi/createAbsensi', ['action' => url('absensi/store'), 'button' => 'Tambah']);
    }

    public function store(Request $request)
    {
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = time() . '.png';

        $this->validate($request, [
            'user_id' => 'required|max:100',
            'jenis' => 'required|max:100',
            'foto' => 'required|max:100',
            'latitude' => 'required|max:100',
            'longitude' => 'required|max:100',
        ]);

        $data = $request->all();

        Storage::disk('public')->put('absensi/' . $fileName, file_get_contents($image_base64));
        Absensi::create($data);
        $data['foto'] = $fileName;

        Alert::success('Berhasil', 'Berhasil tambah data Absensi');
        return redirect('/dashboard');
    }


    public function show($id)
    {
        $data_list = Absensi::with('user')->find($id);
        // passing data Absensi yang didapat
        return view('absensi/showAbsensi', ['absensi_data' => $data_list]);
    }

    // public function edit($id)
    // {
    //     $data_list = Absensi::find($id);
    //     // passing data Absensi yang didapat
    //     return view('absensi/createAbsensi', ['absensi_data' => $data_list, 'action' => url('absensi/update'), 'button' => 'Edit']);
    // }

    // public function update($id, Request $request)
    // {
    //     $this->validate($request, [
    //         'user_id' => 'required|max:100',
    //         'jenis' => 'required|max:100',
    //         'foto' => 'required|max:100',
    //         'latitude' => 'required|max:100',
    //         'longitude' => 'required|max:100',
    //     ]);
    //     $absensi = Absensi::where('id', $id)->first();
    //     $absensi->user_id = $request->user_id;
    //     $absensi->jenis = $request->jenis;
    //     $absensi->foto = $request->foto;
    //     $absensi->latitude = $request->latitude;
    //     $absensi->longitude = $request->longitude;
    //     $absensi->save();
    //     // alihkan halaman ke halaman Absensi
    //     Alert::success('Berhasil', 'Berhasil edit data Absensi');
    //     return redirect('/absensi');
    // }

    public function delete($id)
    {
        $absensi = Absensi::find($id);
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
        // dd(["dari :" . $dari, "sampai :" . $sampai]);
        $cetakabsensi = Absensi::with('user')->whereBetween('created_at', [$dari, $sampai])->get();
        return view('absensi.cetakabsensi', compact('cetakabsensi'));
    }
}
