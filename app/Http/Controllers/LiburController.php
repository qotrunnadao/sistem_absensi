<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Yajra\Datatables\Datatables;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Libur;

class LiburController  extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('libur/indexLibur');
    }

    public function data_json(Request $request)
    {
        if ($request->ajax()) {
            $data =  Libur::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = $row['id'];
                    $btn = "<a href='libur/show/$id' class='show btn btn-info btn-sm'><i class='fa fa-eye'></i></a>
                    <a href='libur/edit/$id' class='edit btn btn-warning btn-sm'><i class='fa fa-edit'></i></a> <a href='libur/delete/$id' class='delete btn btn-danger btn-sm'><i class='fa fa-trash-alt'></i></a>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('libur/createLibur', ['action' => url('libur/store'), 'button' => 'Tambah']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_libur' => 'required|max:100',
            'tanggal' => 'required|max:100',
            'keterangan' => 'required|max:100',
        ]);
        Libur::create($request->all());
        Alert::success('Berhasil', 'Berhasil tambah data Libur');
        return redirect('/libur');
    }


    public function show($id)
    {
        $data_list = Libur::find($id);
        // passing data Libur yang didapat
        return view('libur/showLibur', ['libur_data' => $data_list]);
    }

    public function edit($id)
    {
        $data_list = Libur::find($id);
        // passing data Libur yang didapat
        return view('libur/createLibur', ['libur_data' => $data_list, 'action' => url('libur/update'), 'button' => 'Edit']);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nama_libur' => 'required|max:100',
            'tanggal' => 'required|max:100',
            'keterangan' => 'required|max:100',
        ]);
        $libur = Libur::where('id', $id)->first();
        $libur->nama_libur = $request->nama_libur;
        $libur->tanggal = $request->tanggal;
        $libur->keterangan = $request->keterangan;
        $libur->save();
        // alihkan halaman ke halaman Libur
        Alert::success('Berhasil', 'Berhasil edit data Libur');
        return redirect('/libur');
    }

    public function delete($id)
    {
        $libur = Libur::find($id);
        $libur->delete();
        // alihkan halaman ke halaman Libur
        Alert::success('Berhasil', 'Berhasil hapus data Libur');
        return redirect('/libur');
    }
}

/* End of file LiburController.php */
/* Location: ./app/Http/Controllers/LiburController.php */
