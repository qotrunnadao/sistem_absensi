@extends('layouts.app')
@section('title','Data User')
@section('content')
@if (Auth::user()->level == 0)
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <h5 class="card-header bg-transparent border-bottom mt-0"> Data User </h5>
            <div class="card-body">
                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                <div class="table-responsive mt-3">
                    <table id="mytable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                    <img src="{{ asset('storage/fotouser/' . $value->foto) }}" alt="{{ $value->name }}" class="foto">
                                    @else
                                    <img src="{{ asset('img/not-found.png' . $value->foto) }}" alt="{{ $value->name }}" class="foto">
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
            </div>
        </div>
    </div>
</div>
@else
@foreach ($data as $value)
<div class="row">

    <div class="col-md-3">

        <div class="card card-info card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    @if ($value->foto)
                    <img src="{{ asset('storage/fotouser/' . $value->foto) }}" alt="{{ $value->name }}" class="foto profile-user-img img-fluid img-circle">
                    @else
                    <img src="{{ asset('img/not-found.png' . $value->foto) }}" alt="{{ $value->name }}" class="foto profile-user-img img-fluid img-circle">
                    @endif
                </div>
                <h3 class="profile-username text-center">{{ $value->name }}</h3>
                <p class="text-muted text-center">

                    <span class="badge badge-success">{{ $value->level == 0 ? 'admin' : 'karyawan'}}</span>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <h5 class="card-header bg-transparent border-bottom mt-0"> Profil </h5>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="post">
                            <div class="card-body">
                                <dl>
                                    <dt><i class="fas fa-envelope"></i> Email</dt>
                                    <dd>{{ $value->email }}</dd>
                                    <dt><i class="fas fa-sort-numeric-up-alt"></i> Dibuat Pada</dt>
                                    <dd>{{ $value->created_at }}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="post clearfix">
                            <div class="btn-group">
                                <a href="{{ route('user.show', $value->id) }}" class="btn btn-info float-right"><i class="fa fa-eye"></i></a>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('user.edit', $value->id) }}" class="btn btn-warning float-right"><i class="fa fa-edit"></i></a>
                            </div>

                        </div>
                        <!-- /.post -->
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endforeach
@endif
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
