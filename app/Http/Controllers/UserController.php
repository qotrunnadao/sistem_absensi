<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'data_user' => User::latest()->get(),
        );
        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => route('user.store'),
            'user' => new User(),
        );

        // session()->flash('success', 'data berhasil ditambahkan');
        return view('user.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        //mengubah password menjadi bycript
        $data['password'] = bcrypt($data['password']);
        if (User::create($data)) {
            Alert::success('Berhasil', 'Berhasil Tambah Data User');
        } else {
            Alert::warning('Gagal', 'Data User Gagal Ditambahkan');
        }

        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data = array(
            'button' => 'Edit',
            'action' => route('user.update', $user->id),
            'user' => $user,
        );

        // session()->flash('success', 'data berhasil ditambahkan');
        return view('user.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->all();
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }
        $user->update($data);
        Alert::success('Berhasil', 'Berhasil Edit Data User');

        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        Alert::success('Berhasil', 'Berhasil Hapus Data Libur');
        return redirect(route('user.index'));
    }
}
