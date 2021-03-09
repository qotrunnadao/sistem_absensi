@extends('layouts.app')
@section('title','Data User')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <h5 class="card-header border-bottom mt-0"> Foto Master </h5>
            <div class="card-body">
                <div class="hit text-center hit">

                    <div class="d-flex justify-content-center hit ">
                        <div class="col-md-6 col-sm-12">
                            <form method="POST" id="form_kirim" class="col-md-12" action="{{ route('user.simpanfoto') }}">
                                @csrf
                                <div class=" kamera col-md-12" id="my_camera">
                                </div>
                                <div class=" col-md-12" id="results">
                                </div>
                                <button type="submit" class="btn btn-primary" onClick="take_snapshot()">Daftarkan Wajah</button>
                                <a href="<?= url('') ?>/user" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Kembali</a>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    Webcam.set({
    width: 490,
    height: 390,
    image_format: 'jpeg',
    jpeg_quality: 90
    });

    Webcam.attach('#my_camera');

    function take_snapshot() {
    Webcam.snap(function(data_uri) {
    $(".image-tag").val(data_uri);
    //$("#form_kirim").submit();
    //console.log(data_uri);
    document.getElementById('results').innerHTML ='<img height="100px" src="'+data_uri+'"/>';
    });
    }
</script>
@endsection
