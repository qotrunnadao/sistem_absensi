@extends('layouts.app')

@section('content')
<div class="col-md-12">
    @if (Auth::user()->level == 1)
    <div class="card card-widget widget-user">
        <div class="widget-user-header">
            <h5 class="widget-user-username">Selamat Datang di Sistem Absensi Karyawan</h5>

        </div>
        <div class="widget-user-image">
            <img class="img-circle elevation-2" src="{{ asset('adminlte/dist/img/logoJenderal.jpg') }}" alt="User Avatar">
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <p class="text-center"><b>Jenderal Software</b></p>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-check-square"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Karyawan Masuk</span>
                <span class="info-box-number">{{ $masuk->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-house-user"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Karyawan Pulang</span>
                <span class="info-box-number">{{ $pulang->count() }}</span>
            </div>
        </div>
    </div>
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-slash"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Karyawan Izin</span>
                <span class="info-box-number">{{ $izin->count() }}</span></span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total karyawan</span>
                <span class="info-box-number">{{ $user->count() }}</span>
            </div>
        </div>
    </div>
</div>
@endif


@endsection
