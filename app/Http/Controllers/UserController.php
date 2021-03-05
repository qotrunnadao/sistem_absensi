<?php

namespace App\Http\Controllers;

use CURLFile;
use App\Models\User;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    public function index()
    {
        if (Auth::user()->level == 0) {
            $data = array(
                'data_user' => User::latest()->get(),
            );
            return view('user.index', $data);
        } else {
            $user = Auth::user()->id;
            $data = User::where('id', $user)->latest()->get();
            return view('user.index', compact('data'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => route('user.store'),
            'user' => new User(),
        );
        return view('user.form', $data);
    }

    public function store(UserRequest $request)
    {
        $data = $request->all();
        // dd($data);

        if ($request->file('foto')) {
            $image = $request->file('foto');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put('fotouser/' . $image_name, file_get_contents($image));

            $data['foto'] = $image_name;
        } else {
            $data['foto'] = NULL;
        }
        //mengubah password menjadi bycript
        $data['password'] = Hash::make($data['password']);
        if (User::create($data)) {
            // Create a cURL handle
            $ch = curl_init('http://36.92.197.205/opencv/api_upload_gambar.php');
            // Create a CURLFile object
            $cfile = new CURLFile('http://localhost/absensi/public/storage/fotouser/' . $image_name, 'image/jpeg', $image_name);
            // Assign POST data
            $data = array(
                'filegambar' => $cfile,
                'namagambar' => $image_name,
                'kode_token' => 'jenderalsoftware',
            );
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            // Execute the handle
            curl_exec($ch);
            Alert::success('Berhasil', 'Berhasil Tambah Data User');
        } else {
            Alert::warning('Gagal', 'Data User Gagal Ditambahkan');
        }
        return redirect(route('user.index'));
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $data = array(
            'button' => 'Edit',
            'action' => route('user.update', $user->id),
            'user' => $user,
        );

        return view('user.form', $data);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->all();

        if ($request->file('foto')) {
            $image = $request->file('foto');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put('fotouser/' . $image_name, file_get_contents($image));

            $data['foto'] = $image_name;
        } else {
            $data['foto'] = $user->foto;
        }

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        $user->update($data);
        Alert::success('Berhasil', 'Berhasil Edit Data User');

        return redirect(route('user.index'));
    }

    public function destroy(User $user)
    {
        // hapus foto
        unlink(storage_path('app/public/fotouser/') . $user['foto']);

        $user->delete();
        Alert::success('Berhasil', 'Berhasil Hapus Data User');
        return redirect(route('user.index'));
    }

    public function getData()
    {
        $response = Curl::to('https://jsonplaceholder.typicode.com/users/1')
            ->get();


        dd($response);
    }

    public function curl()
    {
        // Create a cURL handle
        $ch = curl_init('http://36.92.197.205/opencv/api_upload_gambar.php');
        // Create a CURLFile object
        $cfile = new CURLFile('http://localhost/absensi/public/storage/fotouser/1612742738.jpg', 'image/jpeg', '1612742738.jpg');
        // Assign POST data
        $data = array(
            'filegambar' => $cfile,
            'namagambar' => '1612742738.jpg',
            'kode_token' => 'jenderalsoftware',
        );

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // Execute the handle
        curl_exec($ch);
        // dd($data);
    }




    function get_web_page($url)
    {
        $options = array(
            CURLOPT_CUSTOMREQUEST  => "POST",    // Atur type request, get atau post
            CURLOPT_POST           => true,    // Atur menjadi GET
            CURLOPT_FOLLOWLOCATION => true,    // Follow redirect aktif
            CURLOPT_CONNECTTIMEOUT => 120,     // Atur koneksi timeout
            CURLOPT_TIMEOUT        => 120,     // Atur response timeout
        );

        $ch      = curl_init($url);          // Inisialisasi Curl
        curl_setopt_array($ch, $options);    // Set Opsi
        $content = curl_exec($ch);           // Eksekusi Curl
        curl_close($ch);                     // Stop atau tutup script

        $header['content'] = $content;
        return $header;
    }
}
