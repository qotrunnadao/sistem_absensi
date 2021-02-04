@extends('layouts.app')
@section('title','Data User')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <h5 class="card-header bg-transparent border-bottom mt-0"> {{$button}} Data User </h5>
            <div class="card-body">
                <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @if ($button =='Edit')@method('PATCH')@endif
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-2" for="varchar">Nama</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama User" value="@if ($button == 'Tambah'){{ old('name') }}@else{{ $user->name }}@endif" />
                            @if ($errors->has('name'))
                            <div class="text-danger">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="varchar">Email</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="@if ($button == 'Tambah'){{ old('email') }}@else{{ $user->email }}@endif" />
                            @if ($errors->has('email'))
                            <div class="text-danger">
                                {{ $errors->first('email') }}
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="varchar">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="varchar">Level</label>
                        <div class="col-md-6">
                            <select class="form-control custom-select" name="level" id="level" placeholder="level" value="@if ($button == 'Tambah'){{ old('email') }}@else{{ $user->level }}@endif">
                                <option value="1" {{ $user->level == 1 ? 'selected' : '' }}>Karyawan</option>
                                <option value="0" {{ $user->level == 0 ? 'selected' : '' }}>Admin</option>
                            </select>
                            @if ($errors->has('level'))
                            <div class="text-danger">
                                {{ $errors->first('level') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="foto">Foto</label>
                        <div class="col-md-2">
                            @if($button == 'Tambah')
                            <img src="{{ asset('img/not-found.png') }}" class="img-thumbnail img-preview" alt="{{ $user->name }}">
                            @else
                            <img src="public/storage/fotouser/<?= $user->foto; ?>" class="img-thumbnail img-preview" alt="{{ $user->name }}">
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImg()">
                                @if($button == 'Tambah')
                                <label class="custom-file-label" for="foto">Pilih File</label>
                                @else
                                <label class="custom-file-label" for="foto"><?= $user->foto; ?></label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-2">
                            <button type="submit" class="btn btn-primary my-3"><i class="fas fa-save"></i> <?= $button ?></button>
                            <a href="<?= url('') ?>/user" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
