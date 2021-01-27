@extends('layouts.app')
@section('title',' Laporan')
@section('content')
<div class="col-md-12">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">Cetak Laporan <span class="badge-secondary badge">suhai</span></h3>
        </div>
        <div class="card-body">
            <form action="printlaporanpegawai" method="post">
                <input type="hidden" name="_token" value="RxZQicDyhYA8H17uHzXqxNs7TZikG72TmyvS9Zld">
                <div class="form-group row">
                    <div class="col-md-6 hi">
                        <label>Dari</label>
                        <input type="text" id="tgl1" class="form-control" name="tgl1">
                    </div>
                    <div class="col-md-6 hi">
                        <label>Ke</label>
                        <input type="text" id="tgl2" class="form-control" name="tgl2">
                    </div>
                </div>
                <div style="margin-top:200px" class="col-md-10 offset-1 text-right">

                    <button type="submit" name="action" value="absenkehadiran" class="print-button btn kotakbt btn-md btn-hover color-6" formtarget="_blank">
                        <span class="print-icon"></span>Kehadiran</button>

                    <button type="submit" name="action" value="absendinaspeg" class="btn btn-md btn-hover color-10 kotakbt print-button" formtarget="_blank"><span class="print-icon"></span>dinas</button>

                    <button type="submit" name="action" value="printlkh" class="btn btn-md btn-hover color-11 kotakbt print-button" formtarget="_blank"><span class="print-icon"></span><br>LKH</button>


            </form>
        </div>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
