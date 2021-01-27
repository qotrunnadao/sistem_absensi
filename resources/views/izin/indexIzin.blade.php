@extends('layouts.app')
@section('title','Data Izin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <h5 class="card-header bg-transparent border-bottom mt-0"> Data Izin </h5>
            <div class="card-body">
                <a href="izin/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="table-Izin">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th>Nama Karyawan</th>
                                <th>Keterangan</th>
                                <th>Tgl Mulai</th>
                                <th>Tgl Berakhir</th>
                                <th>Status</th>
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
    var table = $("#table-Izin").DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('izin.data') }}",
            columns: [
                {
                    "data": "DT_RowIndex"
                },

									{
										"data": "user.name"
									},
									{
										"data": "keterangan"
									},
									{
										"data": "tgl_mulai"
									},
									{
										"data": "tgl_berakhir"
									},
									{
										"data": "status"
									},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                },

            ],
        });
        $(document).ready(function() {
            $("#table-izin").on('click','.hapus', function(e) {
                e.preventDefault();
                var form = $(this).parents('form');
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah anda yakin menghapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.value) {
                        form.submit();
                    }
                })
            });
        });

</script>
@endsection
