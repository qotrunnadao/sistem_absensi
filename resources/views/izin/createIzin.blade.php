@extends('layouts.app')
@section('title',$button.' Izin')
@section('content')
@if (Auth::user()->level == 0)
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <h5 class="card-header border-bottom mt-0"> {{$button}} Data Izin </h5>
            <div class="card-body">
                <form action="{{$action}}@if($button == 'Edit')/{{ $izin_data->id}}@endif" method="post" style="padding:10px;">
                    {{ csrf_field() }}
                    @if ($button == 'Edit'){{ method_field('PUT') }}@endif

                    <div class="form-group row">
                        <label class="col-md-2" for="varchar">Nama Karyawan</label>
                        <div class="col-md-6">
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="">PILIH</option>
                                @foreach ($user as $value)
                                <option value="{{ $value->id }}" {{ $value->id == $izin_data->user_id ? 'selected' : '' }}>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="keterangan">Keterangan</label>
                        <div class="col-md-6">
                            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan">@if ($button == 'Tambah'){{ old('keterangan') }}@else{{ $izin_data->keterangan }}@endif</textarea>
                            @if ($errors->has('keterangan'))
                            <div class="text-danger">
                                {{ $errors->first('keterangan') }}
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="date">Tgl Mulai</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control datepicker" data-language="en" data-date-format="yyyy-mm-dd" name="tgl_mulai" id="tgl_mulai" placeholder="Tgl Mulai" value="@if ($button == 'Tambah'){{ old('tgl_mulai') }}@else{{ $izin_data->tgl_mulai }}@endif" readonly />
                                @if ($errors->has('tgl_mulai'))
                                <div class="text-danger">
                                    {{ $errors->first('tgl_mulai') }}
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="date">Tgl Berakhir</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control datepicker" data-language="en" data-date-format="yyyy-mm-dd" name="tgl_berakhir" id="tgl_berakhir" placeholder="Tgl Berakhir" value="@if ($button == 'Tambah'){{ old('tgl_berakhir') }}@else{{ $izin_data->tgl_berakhir }}@endif" readonly />
                                @if ($errors->has('tgl_berakhir'))
                                <div class="text-danger">
                                    {{ $errors->first('tgl_berakhir') }}
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="varchar">Status</label>
                        <div class="col-md-6">

                            <select name="status" id="status" class="form-control">
                                <option value="">PILIH</option>
                                <option value="0" {{ $izin_data->status == 0 ? 'selected' : '' }}>Menunggu</option>
                                <option value="1" {{ $izin_data->status == 1 ? 'selected' : '' }}>Diterima</option>
                                <option value="2" {{ $izin_data->status == 2 ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-2">

                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> <?= $button ?></button>
                            <a href="<?= url('') ?>/izin" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                        </div>
                    </div>
                </form>
                <div class="callout callout-info">
                    <p>Pengajuan yang <span class="badge-warning badge">menunggu</span> dan <span class="badge-danger badge">ditolak</span> akan terhapus otomatis bila sudah melewati 15 hari sejak tanggal pengajuan.</p>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@elseif(Auth::user()->level == 1)
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <h5 class="card-header border-bottom mt-0"> {{$button}} Data Izin </h5>
            <div class="card-body">
                <form action="{{$action}}@if($button == 'Edit')/{{ $izin_data->id}}@endif" method="post" style="padding:10px;">
                    {{ csrf_field() }}
                    @if ($button == 'Edit'){{ method_field('PUT') }}@endif

                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="keterangan">Keterangan</label>
                        <div class="col-md-6">
                            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan">@if ($button == 'Tambah'){{ old('keterangan') }}@else{{ $izin_data->keterangan }}@endif</textarea>
                            @if ($errors->has('keterangan'))
                            <div class="text-danger">
                                {{ $errors->first('keterangan') }}
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="date">Tgl Mulai</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control datepicker" data-language="en" data-date-format="yyyy-mm-dd" name="tgl_mulai" id="tgl_mulai" placeholder="Tgl Mulai" value="@if ($button == 'Tambah'){{ old('tgl_mulai') }}@else{{ $izin_data->tgl_mulai }}@endif" readonly />
                                @if ($errors->has('tgl_mulai'))
                                <div class="text-danger">
                                    {{ $errors->first('tgl_mulai') }}
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="date">Tgl Berakhir</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control datepicker" data-language="en" data-date-format="yyyy-mm-dd" name="tgl_berakhir" id="tgl_berakhir" placeholder="Tgl Berakhir" value="@if ($button == 'Tambah'){{ old('tgl_berakhir') }}@else{{ $izin_data->tgl_berakhir }}@endif" readonly />
                                @if ($errors->has('tgl_berakhir'))
                                <div class="text-danger">
                                    {{ $errors->first('tgl_berakhir') }}
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="status" id="status" value="0">
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-2">

                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> <?= $button ?></button>
                            <a href="<?= url('') ?>/izin" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                        </div>
                    </div>
                </form>
                <div class="callout callout-info">
                    <p>Pengajuan yang <span class="badge-warning badge">menunggu</span> dan <span class="badge-danger badge">ditolak</span> akan terhapus otomatis bila sudah melewati 15 hari sejak tanggal pengajuan.</p>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>

@endif

@endsection
