@extends('layouts.app')
@section('title','Data User')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <h5 class="card-header bg-transparent border-bottom mt-0"> Detail Data User </h5>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <div class="mb-3 float-left">
                            @if ($user->foto)
                            <img src="{{ asset('storage/fotouser/' . $user->foto) }}" alt="{{ $user->name }}" class="fotoDetail">
                            @else
                            <img src="{{ asset('img/not-found.png' . $user->foto) }}" alt="{{ $user->name }}" class="fotoDetail">
                            @endif
                        </div>

                    </tr>
                    <tr>
                        <td widht="20%"><b>Nama</b></td>
                        <td> {{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td widht="20%"><b>Email</b></td>
                        <td> {{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td widht="20%"><b>Level</b></td>
                        <td> {{ $user->level == 1 ? 'Karyawan' : 'Admin' }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Dibuat Pada</b></td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Diubah Pada</b></td>
                        <td>{{ $user->updated_at }}</td>
                    </tr>
                </table>
                <a href="<?= url('') ?>/user" class="btn btn-danger float-right my-3">
                    <i class="fas fa-sign-out-alt"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
