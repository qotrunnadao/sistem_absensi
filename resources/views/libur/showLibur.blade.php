@extends('layouts.app')
@section('title','Lihat Libur')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="callout callout-danger">
            <h5>Libur {{ $libur_data->nama_libur }}</h5>
            <p>{{ $libur_data->keterangan }} <br>
                {{ $libur_data->tanggal }}</p>
        </div>
        <div class="card card-outline card-info">
            <h5 class="card-header bg-transparent border-bottom mt-0"> Detail Data Libur </h5>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <td width="20%"><b>Nama Libur</b></td>
                        <td>{{ $libur_data->nama_libur }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Tanggal</b></td>
                        <td>{{ $libur_data->tanggal }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Keterangan</b></td>
                        <td>{{ $libur_data->keterangan }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Created At</b></td>
                        <td>{{ $libur_data->created_at }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Updated At</b></td>
                        <td>{{ $libur_data->updated_at }}</td>
                    </tr>
                </table>
                <a href="<?= url('') ?>/libur" class="btn btn-danger float-right my-3">
                    <i class="fas fa-sign-out-alt"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
