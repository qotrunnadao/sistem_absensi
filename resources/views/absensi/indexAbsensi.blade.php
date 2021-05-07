@extends('layouts.app')
@section('title','Data Absensi')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header bg-transparent border-bottom mt-0">
                <h6><i class="fa fa-table"></i> Riwayat Absensi Karyawan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="table-Absensi">
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
                            @foreach ($data as $value)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->user->name }}</td>
                                <td>{{ $value->created_at }}</td>
                                <td>{{ $value->jenis == 1 ? 'masuk' : 'pulang'  }}</td>
                                <td>
                                    @if ($value->foto)
                                    <img src="{{ asset('storage/absensi/' . $value->foto) }}" alt="{{ $value->name }}" class="foto">
                                    @else
                                    <img src="{{ asset('img/not-found.png' . $value->foto) }}" alt="{{ $value->name }}" class="foto">
                                    @endif</td>
                                <td>{{ $value->latitude }}</td>
                                <td>{{ $value->longitude }}</td>
                                <td>
                                    @if(Auth::user()->level == 0)
                                    <div class="btn-group">
                                        <form action="{{ route('absensi.delete', $value->id) }}" method="GET">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm hapus"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                    @endif
                                    <div class="btn-group">
                                        <a href="{{ route('absensi.show', $value->id) }}" class='show btn btn-info btn-sm'><i class='fa fa-eye'></i></a>
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
            $("#table-Absensi").on('click','.hapus', function(e) {
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
