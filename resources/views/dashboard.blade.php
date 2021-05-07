@extends('layouts.app')

@section('content')
<div class="col-md-12">
    @if (Auth::user()->level == 1)
    <div class="card card-widget widget-user">
        <div class="widget-user-header" style="background: url(&quot;https://jenderalcorp.com/assets/files/banner/sub-bnr-bg-3_jpg_1501172476.jpg&quot;)">
            <h5 class="widget-user-username" style="color: #ffffff">Selamat Datang di Sistem Absensi Karyawan</h5>

        </div>
        <div class="widget-user-image">
            <img class="img-circle elevation-2" src="{{ asset('img/logo2.jpg') }}" alt="User Avatar">
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
<section class="services padding-top-40 padding-bottom-30">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="embed-responsive embed-responsive-16by9">
                    <img class="embed-responsive-item" src="{{ asset('img/jensof1.jpg') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="testi" style="text-align: justify; width: 100%">
                    <p style="font-size: 14px; font-style: normal; line-height: 24px; letter-spacing: normal; font-family: 'Open Sans', sans-serif;">
                        <b>Sistem Absensi Karyawan Menggunakan Face Print</b> merupakan sistem yang dibuat untuk memenuhi tugas mata kuliah kerja praktik. sistem ini menggabungkan teknologi pengenalan wajah pada saat proses absensi sehingga menambah keakuratan dan keamanan data absensi. sistem ini juga dilengkapi dengan fitur pengajuan cuti karyawan dan juga hari libur perusahaan sehingga akan mempermudah pemilik perusahaan dalam pengeloaan daftar hadir dan hari kerja.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<div class="card card-widget widget-user">
    <div class="widget-user-header" style="background: url(&quot;https://jenderalcorp.com/assets/files/banner/sub-bnr-bg-3_jpg_1501172476.jpg&quot;)">
        <h5 class="widget-user-username" style="color: #ffffff">Selamat Datang di Sistem Absensi Karyawan</h5>

    </div>
    <div class="widget-user-image">
        <img class="img-circle elevation-2" src="{{ asset('img/logo2.jpg') }}" alt="User Avatar">
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col">
                <p class="text-center"><b>Jenderal Software</b></p>
            </div>
        </div>
    </div>
</div>
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
