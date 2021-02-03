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
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Dibuat Pada</th>
                                <th>Keterangan</th>
                                <th>Tgl Mulai</th>
                                <th>Tgl Berakhir</th>
                                <th>Status</th>
                                {{-- <th>Created At</th>
                                <th>Updated At</th> --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($no = 1)
                            @foreach ($izin_data as $value)
                            <tr class="text-center">
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->user->name }}</td>
                                <td>{{ $value->created_at }}</td>
                                <td>{{ $value->keterangan }}</td>
                                <td>{{ $value->tgl_mulai }}</td>
                                <td>{{ $value->tgl_berakhir}}</td>
                                <td>
                                    @if($value->status == 0)
                                    <span class="badge badge-warning">Menunggu</span></td>
                                @elseif($value->status == 1)
                                <span class="badge badge-success">Diterima</span></td>
                                @else
                                <span class="badge badge-danger">Ditolak</span></td>
                                @endif
                                <td>
                                    @if($value->status == 0)
                                    <div class="btn-group">
                                        <a href="{{ route('izin.diterima', $value->status) }}" class="btn btn-primary btn-sm"><i class="fa fa-check"></i></a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('izin.ditolak', $value->status) }}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                    </div>
                                    @elseif($value->status == 1)
                                    diterima
                                    @else
                                    ditolak
                                    @endif


                                    {{-- <div class="btn-group">
                                        <a href="{{ route('izin.show', $value->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                </div>
                <div class="btn-group">
                    <a href="{{ route('izin.edit', $value->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                </div>
                <div class="btn-group"> --}}
                    {{-- <form action="{{ route('izin.destroy', $value->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm hapus"><i class="fas fa-trash-alt"></i></button>
                    </form> --}}
                </div>
                </td>
                </tr>
                @endforeach
                </tbody>
                <tr>
                    </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

</div>
</div>
<script>
    $(document).ready(function(){
               $('#table-Izin').DataTable();
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
{{-- </table>
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
@endsection --}}
