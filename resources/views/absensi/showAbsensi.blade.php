@extends('layouts.app')
@section('title','Lihat Absensi')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <h5 class="card-header bg-transparent border-bottom mt-0"> Detail Data Absensi </h5>
            <div class="card-body">
                <table class="table table-striped">
                    <div class="mb-3 float-left">
                        @if ($absensi_data->foto)
                        <img src="{{ asset('storage/absensi/' . $absensi_data->foto) }}" alt="{{ $absensi_data->name }}" class="fotoDetail">
                        @else
                        <img src="{{ asset('img/not-found.png' . $absensi_data->foto) }}" alt="{{ $absensi_data->name }}" class="fotoDetail">
                        @endif
                    </div>
                    <tr>
                        <td width="20%"><b>Nama Karyawan</b></td>
                        <td>{{ $absensi_data->user->name }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Jenis</b></td>
                        <td>{{ $absensi_data->jenis == 1 ? 'masuk' : 'pulang' }}</td>
                    </tr>

                    <tr>
                        <td width="20%"><b>Latitude</b></td>
                        <td>{{ $absensi_data->latitude }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Longitude</b></td>
                        <td>{{ $absensi_data->longitude }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Created At</b></td>
                        <td>{{ $absensi_data->created_at }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Updated At</b></td>
                        <td>{{ $absensi_data->updated_at }}</td>
                    </tr>
                </table>
                <a href="<?= url('') ?>/absensi" class="btn btn-danger float-right my-3">
                    <i class="fas fa-sign-out-alt"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
