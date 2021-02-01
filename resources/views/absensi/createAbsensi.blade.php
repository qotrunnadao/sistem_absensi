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
                        <label class="col-md-2" for="varchar">Nama Karyawan</label>
                        <div class="col-md-6">
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="">PILIH</option>
                                @foreach ($user as $value)
                                <option value="{{ $value->id }}" {{ $value->id == $absensi_data->user_id ? 'selected' : '' }}>{{ $value->name }}</option>
                                @endforeach
                            </select>
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
                            <input type="file" name="foto">
                            {{-- <img src="{{ asset('storage/'. $user['foto']) }}" width="70" height="100" alt="" class="img.thumbnail"> --}}
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
