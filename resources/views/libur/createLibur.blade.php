@extends('layouts.app')
@section('title',$button.' Libur')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <h5 class="card-header border-bottom mt-0"> {{$button}} Data Libur </h5>
            <div class="card-body">
                <form action="{{$action}}@if($button == 'Edit')/{{ $libur_data->id}}@endif" method="post" style="padding:10px;">
                    {{ csrf_field() }}
                    @if ($button == 'Edit'){{ method_field('PUT') }}@endif
                    <div class="form-group row">
                        <label class="col-md-2" for="varchar">Nama Libur</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="nama_libur" id="nama_libur" placeholder="Nama Libur" value="@if ($button == 'Tambah'){{ old('nama_libur') }}@else{{ $libur_data->nama_libur }}@endif" />
                            @if ($errors->has('nama_libur'))
                            <div class="text-danger">
                                {{ $errors->first('nama_libur') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="date">Tanggal</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control datepicker" data-language="en" data-date-format="yyyy-mm-dd" name="tanggal" id="tanggal" placeholder="Tanggal" value="@if ($button == 'Tambah'){{ old('tanggal') }}@else{{ $libur_data->tanggal }}@endif" readonly />
                                @if ($errors->has('tanggal'))
                                <div class="text-danger">
                                    {{ $errors->first('tanggal') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="varchar">Keterangan</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="@if ($button == 'Tambah'){{ old('keterangan') }}@else{{ $libur_data->keterangan }}@endif" />
                            @if ($errors->has('keterangan'))
                            <div class="text-danger">
                                {{ $errors->first('keterangan') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> <?= $button ?></button>
                            <a href="<?= url('') ?>/libur" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
