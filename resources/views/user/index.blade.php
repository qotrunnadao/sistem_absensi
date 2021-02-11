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

        <div class="card card-danger card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    @if ($value->foto)
                    <img src="{{ asset('storage/fotouser/' . $value->foto) }}" alt="{{ $value->name }}" class="profile-user-img img-fluid img-circle">
                    @else
                    <img src="{{ asset('img/not-found.png' . $value->foto) }}" alt="{{ $value->name }}" class="profile-user-img img-fluid img-circle">
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
    <div class="col-md-8">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link  active" href="#activity" data-toggle="tab">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.edit', $value->id) }}" data-toggle="tab">Edit Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Change Password</a></li>
                </ul>
            </div>
            <!-- /.card-header -->
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
                            <!-- /.user-block -->
                        </div>
                        <!-- /.post -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        <form class="form-horizontal" method="post" action="https://demo.absenpegawai.com/updateprofil" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="bM7uUzEo1Xhodks8lst88VLorlsFyPmrg7fQozHd">
                            <input type="hidden" name="txtid" value="91">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ID Bot Telegram</label>
                                    <input type="text" name="txtbottele" value="" class="form-control" id="exampleInputEmail1" placeholder="Masukan ID anda">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">No Tlp (0853977xxx)
                                        <br><span class="text-danger"> Belum di verifikasi</span> <button type="submit" class="badge badge-warning">Verifikasi</button>

                                    </label>
                                    <input type="text" name="txtnope" maxlength="13" value="" class="form-control" placeholder="No Tlp" id="myinput" onkeypress="return isNumber(event);">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="email" name="txtemail" class="form-control" value="suhai@gmail.com" required="" placeholder="Alamat Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">NIP</label>
                                    <input type="number" name="txtnip" class="form-control" value="" placeholder="NIP">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="avatar" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">Upload</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="text-secondary">(File <b>.jpg</b> <b>.jpeg</b> <b>.png</b> dan ukuran maksimal <b>2MB</b>)</p>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm text-right btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal" action="updatepass" method="post">
                            <input type="hidden" name="_token" value="bM7uUzEo1Xhodks8lst88VLorlsFyPmrg7fQozHd">
                            <input type="hidden" name="txtid" value="91">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password Lama</label>
                                    <input type="password" class="form-control" name="txtoldpass" placeholder="Old Password" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password Baru</label>
                                    <input type="password" class="form-control" name="txtnewpass" placeholder="New Password" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password Baru (Confirm)</label>
                                    <input type="password" class="form-control" name="txtnewpassconf" placeholder="New Password (Confirm)" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-sm text-right btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
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
