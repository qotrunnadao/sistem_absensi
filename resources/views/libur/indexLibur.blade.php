@extends('layouts.app')
@section('title','Data Libur')
@section('content')
@if (Auth::user()->level == 0)
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header bg-transparent border-bottom mt-0">
                <a href="libur/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a> </div>
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="table-Libur">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center" width="5%">No</th>
                                <th>Nama Libur</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($no = 1)
                            @foreach ($libur_data as $value)
                            <tr class="text-center">
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->nama_libur }}</td>
                                <td>{{ $value->tanggal }}</td>
                                <td>{{ $value->keterangan }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('libur.show', $value->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('libur.edit', $value->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    </div>

                                    <div class="btn-group">
                                        <form action="{{ route('libur.destroy', $value->id) }}" method="GET">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm hapus"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif(Auth::user()->level == 1)
<div class="row">
    @foreach ($libur_data as $value)
    <div class="col-md-4">
        <div class="callout callout-danger">
            <h5>Libur {{ $value->nama_libur }}</h5>
            <p>{{ $value->keterangan }} <br>
                {{ $value->tanggal }}</p>
        </div>
    </div>
    @endforeach

</div>
@endif
@endsection
@section('javascripts')
<script>
    $(document).ready(function(){
               $('#table-Libur').DataTable();
           });
           $(document).ready(function() {
            $("#table-Libur").on('click','.hapus', function(e) {
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
