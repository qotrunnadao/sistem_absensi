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
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama karyawan</th>
                                <th>Waktu</th>
                                <th>Jenis</th>
                                <th>Foto</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            {{--  looping database  --}}
                            @php ($no = 1)
                            @foreach ($absensi as $value)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->user->name }}</td>
                                <td>{{ $value->created_at }}</td>
                                <td>{{ $value->jenis == 1 ? 'masuk' : 'pulang'  }}</td>
                                <td>{{ $value->ShowFoto }}</td>
                                <td>{{ $value->latitude }}</td>
                                <td>{{ $value->longitude }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="absensi/show/$id" class='show btn btn-info btn-sm'><i class='fa fa-eye'></i></a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="absensi/delete/$id" class='show btn btn-danger btn-sm'><i class='fa fa-trash-alt'></i></a>
                                    </div>


                                </td>
                            </tr>
                            @endforeach
                            {{--  end looping database --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
<script>
    $(document).ready(function(){
               $('#table-Absensi').DataTable();
           });
           $(document).ready(function() {
            $("#table-Izin").on('click','.hapus', function(e) {
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
