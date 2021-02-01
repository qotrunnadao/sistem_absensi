@extends('layouts.app')
@section('title','Lihat Izin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header bg-transparent border-bottom mt-0"> Detail Data Izin </h5>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <td width="20%"><b>Nama Karyawan</b></td>
                        <td>{{ $izin_data->user->name }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Keterangan</b></td>
                        <td>{{ $izin_data->keterangan }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Tgl Mulai</b></td>
                        <td>{{ $izin_data->tgl_mulai }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Tgl Berakhir</b></td>
                        <td>{{ $izin_data->tgl_berakhir }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Status</b></td>
                        <td>{{ $izin_data->status == 0 ? 'menunggu' : 'diterima'}}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Created At</b></td>
                        <td>{{ $izin_data->created_at }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Updated At</b></td>
                        <td>{{ $izin_data->updated_at }}</td>
                    </tr>
                </table>
                <a href="<?= url('') ?>/izin" class="btn btn-danger float-right my-3">
                    <i class="fas fa-sign-out-alt"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
