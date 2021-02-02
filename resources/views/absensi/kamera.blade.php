@extends('layouts.app')
@section('title',' Absensi')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="hit text-center hit">
            <div class="callout callout-info">
                <table class="table-sm text-left" width="100%" align="center">
                    <tbody>
                        <tr>
                            <td align="center" colspan="3" class="badge-dark">SISTEM ABSENSI FACEPRINT<br>JENDERAL SOFTWARE</td>
                        </tr>
                        <tr>
                            <td class="bg-info">Waktu Sekarang</td>
                            <td class="bg-info">:</td>
                            <td class="bg-info"> <span id="jam">{{ date(' H:i:s') }}</span></td>
                        </tr>
                        <tr>
                            <td class="bg-secondary">Tanggal</td>
                            <td class="bg-secondary">:</td>
                            <td class="bg-secondary"><span id="date"><b>{{ date('d F Y ') }}</b> </span></td>
                        </tr>
                    </tbody>
                </table>
                Kami akan mengambil foto wajah anda untuk verifikasi ketika melakukan absensi
                <p class="text-center"><b>Posisi wajah harus terlihat jelas</b><br>
                    <b>Posisi Kepala harus tegak</b><br>
                </p>

                <div class="container h-100">
                    <div class="row h-100 justify-content-center align-items-center">
                        <form method="POST" id="form_kirim" action="{{ route('absensi.store') }}" class="col-md-12">
                            @csrf
                            <div class="" id="my_camera"></div>
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <button class="btn btn-primary" value="" onClick="take_snapshot()">masuk</button>
                            <input type="hidden" name="image" class="image-tag">
                            <button type="button" class="btn btn-danger" value="" onClick="take_snapshot()">pulang</button>
                            <input type="hidden" name="image" class="image-tag">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script language="JavaScript">
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
            $("#form_kirim").submit();
        });
    }
</script>
@endsection
