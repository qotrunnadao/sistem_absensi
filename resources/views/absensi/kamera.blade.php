@extends('layouts.app')
@section('title',' Absensi')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fas fa-th mr-1"></i>
                    Sistem Absensi Face Print
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <table class="table-sm table-striped text-left" width="100%" align="center">
                        <tbody>
                            <tr>
                                <td>Nama Karyawan</td>
                                <td>:</td>
                                <td><span class="badge badge-dark">{{ Auth::user()->name }}</span></td>
                            </tr>
                            <tr>
                                <td>Waktu Sekarang</td>
                                <td>:</td>
                                <td> <span id="jam">{{ date(' H:i:s') }}</span></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td><span id="date"><b>{{ date('d F Y ') }}</b> </span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="hit text-center hit">
            <div class="callout callout-info">
                <div class="d-flex justify-content-center hit ">
                    <div class="col-md-6 col-sm-12">
                        <form method="POST" id="form_kirim" action="{{ route('absensi.store') }}" class="col-md-12">
                            @csrf
                            <div class="kamera col-md-12 hit" id="my_camera"></div>
                            <input type="hidden" name="image" class="image-tag">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <button type="submit" class="btn btn-primary" value="1" name="jenis" onClick="take_snapshot()">masuk</button>
                            <button type="submit" class="btn btn-danger" name="jenis" value="2" onClick="take_snapshot()">pulang</button>
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">

                        </form>
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
    // $("#form_kirim").submit();
    });
    }

    $(document).ready(function(){
        getLocation();
    });

        function getLocation() {
        console.log('oke');
        if (navigator.geolocation) {
        navigator.geolocation.watchPosition(showPosition);
        } else {
       // x.innerHTML = "Geolocation is not supported by device.";
        }
        }


        function showPosition(position) {

        var long=position.coords.longitude;
        var lat=position.coords.latitude;
        if(long == '' || long == null){
        //document.getElementById("info").innerHTML="<span class='label label-danger'>Lokasi belum terditeksi,Cek GPS Anda</span>";
        }else{
        //document.getElementById("info").innerHTML="<span class='label label-success'>Lokasi Berangkat Sudah Terdeteksi</span>";

        // $.ajax({
        // type: 'POST',
        // url: 'fungsi hitung jarak',
        // data: { lang1: long,lat1: lat },
        // success: function(response) {
        // $('#jarak').html('<b>Sekarang, jarak lokasi anda dengan kantor sekitar '+response+'</b>');

        // }
        // });

        document.getElementById("latitude").value=position.coords.latitude;
        document.getElementById("longitude").value=position.coords.longitude;
        // document.getElementById('frame').innerHTML ='<iframe src="https://maps.google.com/maps?q='+position.coords.latitude+','+ position.coords.longitude+'&z=15&output=embed" width="100%" height="250px" frameborder="0" style="border:0"></iframe>';
        }


        }
</script>
@endsection
