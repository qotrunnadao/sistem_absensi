@extends('layouts.app')
@section('title','Profil User')
@section('content')
<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
    <div class="card bg-light">
        <div class="card-header text-muted border-bottom-0">
            Profil User
        </div>
        <div class="card-body pt-0">
            <div class="row">
                <div class="col-7">
                    <h2 class="lead"><b>{{ $data_user->name }}</b></h2>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>{{ $data_user->email }}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> {{ $data_user->level }}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>{{ $data_user->created_at }}</li>
                    </ul>
                </div>
                <div class="col-5 text-center">
                    <img src="{{ asset('storage/userfoto/<?= $data_user->foto; ?>') }}" alt="" class="img-circle img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
