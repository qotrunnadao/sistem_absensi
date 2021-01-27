@extends('layouts.app')
@section('title',' Laporan')
@section('content')
<div class="col-md-12">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">Cetak Laporan Absensi</h3>
        </div>
        <div class="card-body">
            <form action="printlaporanpegawai" method="post" name="cetak">
                <div class="form-group row">
                    <div class="col-md-6 hi">
                        <label>Dari</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" id="dari" class="form-control datepicker" data-language="en" data-date-format="yyyy-mm-dd" name="dari">

                        </div>
                    </div>
                    <div class="col-md-6 hi">
                        <label>Sampai</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" id="sampai" class="form-control datepicker" data-language="en" data-date-format="yyyy-mm-dd" name="sampai">
                        </div>
                    </div>
                </div>
            </form>

            <a href="" onclick="this.href='/cetakabsensi/'+ document.getElementById('dari').value + '/' + document.getElementById('sampai').value " class="btn btn-primary float-right mb-3"><i class="fa fa-print"></i> Cetak</a>
        </div>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
