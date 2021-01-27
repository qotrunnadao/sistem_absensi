<?php

$string = "<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ ".$m.";";



$string .= "\n\nclass " . $c . "  extends Controller
{
    function __construct()
    {
        \$this->middleware('auth');
        ";
$string .= "
    }";

if ($jenis_tabel == 'reguler_table') {

    $string .= "\n\n    public function index()
    {
        Paginator::useBootstrap();
        \$data_list = $m::paginate(10);
        return view('" . $nama_class . "/index".$m."', ['" . $nama_class . "_data' => \$data_list, 'i' => 1]);
       
    }
    public function cari(Request \$request)
    {
        // menangkap data pencarian
        \$cari = \$request->cari;
        Paginator::useBootstrap();
        // mengambil data dari table $c sesuai pencarian data
      
        \$data_list = $m::where('$pk', 'like', '$cari')->paginate(10);
        // mengirim data $c ke view index
        return view('" . $nama_class . "/index', ['" . $nama_class . "_data' => \$data_list, 'i' => 1]);
    }
    ";
} else if ($jenis_tabel == 'datatables') {

    $string .= "\n\n    public function index()
    {
        return view('" . $nama_class . "/index".$m."');
    } 
    
    public function data_json( Request \$request) 
    {
        if (\$request->ajax()) {
            \$data =  ".$m."::latest()->get();
            return Datatables::of(\$data)
                ->addIndexColumn()
                ->addColumn('action', function (\$row) {
                    \$id = \$row['$pk'];
                    \$btn = "."\"<a href='$nama_class/show/\$id' class='show btn btn-info btn-sm'>Lihat</a>
                    <a href='$nama_class/edit/\$id' class='edit btn btn-success btn-sm'>Edit</a> <a href='$nama_class/delete/\$id' class='delete btn btn-danger btn-sm'>Hapus</a>\"".";
                    return \$btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }";
}

$string .= "\n\n    public function create() 
    {
        return view('" . $nama_class . "/create".$m."', [ 'action' => url('$nama_class/store'),'button'=>'Tambah']);
    }

    public function store(Request \$request) 
    {
            \$this->validate(\$request, [";
            foreach ($non_pk as $row) {
                if ($row['column_name'] =='created_at' || $row['column_name'] =='updated_at' || $row['column_name'] =='deleted_at') {
                }else{
                    $string .= "\n\t\t\t\t'" . $row['column_name'] . "' => 'required|max:100',";
                } 
            }
$string .= "\n\t\t\t]);
            $m::create(\$request->all());
            Alert::success('Berhasil', 'Berhasil tambah data $m');
            return redirect('/$nama_class');
        }
    

    public function show(\$id) 
    {
        \$data_list = $m::find(\$id);
        // passing data $m yang didapat
        return view('" . $nama_class . "/show".$m."', ['" . $nama_class . "_data' => \$data_list]);
       
    }

    public function edit(\$id) 
    {
        \$data_list = $m::find(\$id);
        // passing data $m yang didapat
        return view('" . $nama_class . "/create".$m."', ['" . $nama_class . "_data' => \$data_list, 'action' => url('$nama_class/update'),'button'=>'Edit']);
    }
    
    public function update(\$id, Request \$request) 
    {
        \$this->validate(\$request, [";
        foreach ($non_pk as $row) {
            if ($row['column_name'] =='created_at' || $row['column_name'] =='updated_at' || $row['column_name'] =='deleted_at') {
            }else{
                $string .= "\n\t\t\t\t'" . $row['column_name'] . "' => 'required|max:100',";
            } 
        }
        $string .= "\n\t\t\t]);
               \$$nama_class = $m::where('$pk', \$id)->first();";
        foreach ($non_pk as $row) {
            if ($row['column_name'] =='created_at' || $row['column_name'] =='updated_at' || $row['column_name'] =='deleted_at') {
            }else{
                $string .= "\n\t\t\t\t \$$nama_class"."->". $row['column_name'] . " =\$request->" . $row['column_name'] . ";";
            } 
           
        }
        $string .= "
             \$$nama_class"."->save(); 
        // alihkan halaman ke halaman $m
        Alert::success('Berhasil', 'Berhasil edit data $m');
        return redirect('/$nama_class');
           
    }
    
    public function delete(\$id) 
    {
        \$$nama_class = $m::find(\$id);
        \$$nama_class"."->delete();
        // alihkan halaman ke halaman $m
        Alert::success('Berhasil', 'Berhasil hapus data $m');
        return redirect('/$nama_class');
    }
";


$string .= "\n\n}\n\n/* End of file $c_file */
/* Location: ./app/Http/Controllers/$c_file */
/* Created at " . date('Y-m-d H:i:s') . " */
/* Mohammad Irham Akbar CRUD Laravel 8 */";

$hasil_controller = createFile($string, $target . "/Http/Controllers/" . $c_file);
