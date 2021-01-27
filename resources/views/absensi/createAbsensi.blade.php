@extends('layouts.app')
@section('title',$button.' Absensi')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <h5 class="card-header bg-transparent border-bottom mt-0"> {{$button}} Data Absensi </h5>
            <div class="card-body">
                <form action="{{$action}}@if($button == 'Edit')/{{ $absensi_data->id}}@endif" method="post" style="padding:10px;">
                    {{ csrf_field() }}
                    @if ($button == 'Edit'){{ method_field('PUT') }}@endif

                    <div class="form-group row">
                        <label class="col-md-2" for="bigint">Nama Karyawan</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="user_id" id="user_id" placeholder="Nama Karyawan" value="@if ($button == 'Tambah'){{ old('user_id') }}@else{{ $absensi_data->user->user_id }}@endif" />
                            @if ($errors->has('user_id'))
                            <div class="text-danger">
                                {{ $errors->first('user_id') }}
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="tinyint">Jenis</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="jenis" id="jenis" placeholder="Jenis" value="@if ($button == 'Tambah'){{ old('jenis') }}@else{{ $absensi_data->jenis }}@endif" />
                            @if ($errors->has('jenis'))
                            <div class="text-danger">
                                {{ $errors->first('jenis') }}
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="varchar">Foto</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="foto" id="foto" placeholder="Foto" value="@if ($button == 'Tambah'){{ old('foto') }}@else{{ $absensi_data->foto }}@endif" />
                            @if ($errors->has('foto'))
                            <div class="text-danger">
                                {{ $errors->first('foto') }}
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="varchar">Latitude</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="@if ($button == 'Tambah'){{ old('latitude') }}@else{{ $absensi_data->latitude }}@endif" />
                            @if ($errors->has('latitude'))
                            <div class="text-danger">
                                {{ $errors->first('latitude') }}
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="varchar">Longitude</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="@if ($button == 'Tambah'){{ old('longitude') }}@else{{ $absensi_data->longitude }}@endif" />
                            @if ($errors->has('longitude'))
                            <div class="text-danger">
                                {{ $errors->first('longitude') }}
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-2">

                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> <?= $button ?></button>
                            <a href="<?= url('') ?>/absensi" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
