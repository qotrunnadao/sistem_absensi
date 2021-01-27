<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use RealRashid\SweetAlert\Facades\Alert;

class IzinController  extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('izin/indexIzin');
    }

    public function data_json(Request $request)
    {
        if ($request->ajax()) {
            $data =  Izin::with('user')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = $row['id'];
                    $btn = "<a href='izin/delete/$id' class='delete btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></a>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        $data = [
            'action' => url('izin/store'),
            'button' => 'Tambah',
            'user' => User::get(),
            'izin_data' => new Izin(),
        ];
        return view('izin/createIzin', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|max:100',
            'keterangan' => 'required|max:100',
            'tgl_mulai' => 'required|max:100',
            'tgl_berakhir' => 'required|max:100',
            'status' => 'required|max:100',
        ]);
        Izin::create($request->all());
        Alert::success('Berhasil', 'Berhasil tambah data Izin');
        return redirect('/izin');
    }


    public function show($id)
    {
        $data_list = Izin::find($id);
        $data = [
            'izin_data' => $data_list
        ];
        // passing data Izin yang didapat
        return view('izin/showIzin', $data);
    }

    public function edit($id)
    {
        $data_list = Izin::find($id);
        $data = [
            'user' => User::get(),
            'izin_data' => $data_list,
            'action' => url('izin/update'),
            'button' => 'Edit'
        ];
        // passing data Izin yang didapat
        return view('izin/createIzin', $data);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|max:100',
            'keterangan' => 'required|max:100',
            'tgl_mulai' => 'required|max:100',
            'tgl_berakhir' => 'required|max:100',
            'status' => 'required|max:100',
        ]);

        $izin = Izin::where('id', $id)->first();
        // $izin->user_id = $request->user->name;
        $izin->user_id = $request->user_id;
        $izin->keterangan = $request->keterangan;
        $izin->tgl_mulai = $request->tgl_mulai;
        $izin->tgl_berakhir = $request->tgl_berakhir;
        $izin->status = $request->status;
        $izin->save();
        // alihkan halaman ke halaman Izin
        Alert::success('Berhasil', 'Berhasil edit data Izin');
        return redirect('/izin');
    }

    public function delete($id)
    {
        $izin = Izin::find($id);
        $izin->delete();
        // alihkan halaman ke halaman Izin
        Alert::success('Berhasil', 'Berhasil hapus data Izin');
        return redirect('/izin');
    }
}

/* End of file IzinController.php */
/* Location: ./app/Http/Controllers/IzinController.php */
