@extends('layouts.app')
@section('title','Data User')
@section('content')
<div class="card-body">
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Data User</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i> Tambah Data</a>
                    <table id="mytable" class="table table-bordered table-hover mb-3">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Terdaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($no = 1)
                            @foreach ($data_user as $value)
                            <tr class="text-center">
                                <td>{{ $no++ }}</td>
                                <td>
                                    @if ($value->foto)
                                    <img src="{{ asset('storage/fotouser/' . $value->foto) }}" alt="{{ $value->name }}" width="70" height="100">
                                    @else
                                    <img src="{{ asset('img/not-found.png' . $value->foto) }}" alt="{{ $value->name }}" width="70" height="100">
                                    @endif

                                </td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->level == 0 ? 'admin' : 'karyawan'}}</td>
                                <td>{{ $value->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('user.show', $value->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('user.edit', $value->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    </div>
                                    {{-- <div class="btn-group">
                                        <a href="{{ route('user.destroy', $value->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></a>
                </div> --}}
                <div class="btn-group">
                    <form action="{{ route('user.destroy', $value->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm hapus"><i class="fas fa-trash-alt"></i></button>
                    </form>
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
               $('#mytable').DataTable();
           });
           $(document).ready(function() {
            $("#mytable").on('click','.hapus', function(e) {
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
