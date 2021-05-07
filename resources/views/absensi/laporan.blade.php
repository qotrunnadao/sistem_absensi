@extends('layouts.app')
@section('title',' Laporan')
@section('content')
<div class="col-md-12">
    <div class="card card-outline card-info">
        <h5 class="card-header bg-transparent border-bottom mt-0"> Cetak Laporan Per User </h5>
        <div class="card-body">
            <div class="table-responsive mt-3">
                <table id="mytable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr class="text-center">
                            <th width="5%">No.</th>
                            <th>Nama</th>
                            <th>Jumlah Masuk</th>
                            <th>Jumlah Izin</th>
                            {{-- <th width="20%">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php ($no = 1)
                        @foreach ($data as $value)
                        <tr class="text-center">
                            <td>{{ $no++ }}</td>
                            <td>{{ $value->user->name }}</td>
                            <td>{{ $value->izin->count() }}</td>
                            <td>{{ $value->absensi->count() }}</td>
                            {{-- <td>
                                <div class="btn-group">
                                    <a href="{{ route('cetakuser', $user_id) }}" onclick="this.href='/cetakuser/'+ document.getElementById('id').value" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
            </div>
            </td> --}}
            </tr>
            @endforeach
            </tbody>
            <tr>
                </table>
        </div>
    </div>
</div>
</div>

@endsection
