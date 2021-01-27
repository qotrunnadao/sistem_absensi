@extends('layouts.app')
@section('title','Data Absensi')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <h5 class="card-header bg-transparent border-bottom mt-0"> Data Absensi </h5>
            <div class="card-body">
                <a href="absensi/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="table-Absensi">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th>Nama karyawan</th>
                                <th>Jenis</th>
                                <th>Foto</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Waktu</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
<script>
    var table = $("#table-Absensi").DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('absensi.data') }}",
            columns: [
                {
                    "data": "DT_RowIndex"
                },

									{
										"data": "user.name"
									},
									{
										"data": "jenis"
									},
									{
										"data": "foto"
									},
									{
										"data": "latitude"
									},
									{
										"data": "longitude"
									},
									{
										"data": "created_at"
									},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                },

            ],
        });

</script>
@endsection
