<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <title>Cetak Absensi</title>
</head>

<body onload="window.print()">
    <div class="col form-group">
        <img class="img-fluid" src="{{ asset('img/logo.jpg') }}" height="100" width="100">
        <p align="center" class="float-right"><b>LAPORAN ABSENSI KARYAWAN <br>
                CV. JENDERAL SOFTWARE </b><br>
            Jalan Menteri Supeno, Perum Griya Permata Residence No B9 <br>
            Kec. Sokaraja Kab. Banyumas Jawa Tengah 53181 <br>
            jenderal.software@gmail.com | 085742798737</p>
    </div>
    <hr color="#000000">


    <table class="static" align="center" rules="all" border="1px" style="width:95% ">
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th>Nama karyawan</th>
                <th>Jenis</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @php ($no = 1)
            @foreach ($cetakabsensi as $value)
            <tr class="text-center">
                <td>{{ $no++ }}</td>
                <td>{{ $value->user->name }}</td>
                <td>{{ $value->jenis == 1 ? 'masuk' : 'pulang' }}</td>
                <td>{{ $value->latitude}}</td>
                <td>{{ $value->longitude}}</td>
                <td>{{ $value->created_at }}</td>
            </tr>
            @endforeach
    </table>
    </div>
</body>

</html>
