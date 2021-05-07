@extends('layouts.app')
@section('title',' Laporan')
@section('content')
<div class="col-md-12">
    <div class="card card-outline card-info">
        <h6 class="card-header bg-transparent border-bottom mt-0"> Cetak Laporan Absensi
        </h6>
        <div class="card-body">
            <form action="printlaporanpegawai" method="post" name="cetak">
                <div class="form-group row">
                    <div class="col-md-6 hi">
                        <label>Dari</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" id="dari" class="form-control datepicker" data-language="id" data-date-format="yyyy-mm-dd" name="dari">

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
</div>
<!-- /.card -->
<div class="col-md-12">
    <div class="card card-outline card-info">
        <h6 class="card-header bg-transparent border-bottom mt-0"> Rekapitulasi Data Kehadiran Karyawan</h6>
        <div class="card-body">
            <div class="table-responsive mt-3">
                <table id="mytable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr class="table-bordered text-center">
                            <th width="5%">No</th>
                            <th>Nama Karyawan</th>
                            <th>Jumlah Masuk</th>
                            <th>Jumlah Izin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php ($no = 1)
                        @foreach($data_user as $value)

                        <?php
                            $masuk = \App\Models\Absensi::where(['user_id' => $value->id, 'jenis' => 1,])->get()->count();
                            $izin =  \App\Models\Izin::where(['user_id' => $value->id, 'status' => 1])->get()->count();
                            ?>


                        <tr class="text-center">
                            <td>{{ $no++ }}</td>
                            <td>{{ $value->name}}</td>
                            <td>{{ $masuk }}</td>
                            <td>{{ $izin }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
