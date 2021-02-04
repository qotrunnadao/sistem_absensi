<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    public function index()
    {
        $data = array(
            'data_user' => User::latest()->get(),
        );
        return view('user.index', $data);
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

        if ($request->file('foto')) {
            $image = $request->file('foto');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put('fotouser/' . $image_name, file_get_contents($image));

            $data['foto'] = $image_name;
        } else {
            $data['foto'] = NULL;
        }

        //mengubah password menjadi bycript
        $data['password'] = bcrypt($data['password']);

        if (User::create($data)) {
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
}
