@extends('layouts.app')
@section('title','Data Libur')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <h5 class="card-header bg-transparent border-bottom mt-0"> Data Libur </h5>
            <div class="card-body">
                <a href="libur/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="table-Libur">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center" width="5%">No</th>
                                <th>Nama Libur</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                {{-- <th>Created At</th>
                                <th>Updated At</th> --}}
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
    var table = $("#table-Libur").DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('libur.data') }}",
            columns: [
                                    {
                                        "data": "DT_RowIndex"
                                    },

									{
										"data": "nama_libur"
									},
									{
										"data": "tanggal"
									},
									{
										"data": "keterangan"
									},
									// {
									// 	"data": "created_at"
									// },
									// {
									// 	"data": "updated_at"
									// },
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                },

            ],
        });
</script>
@endsection
