<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <title>Cetak Absensi</title>
</head>

<body onload="window.print()">
    <div class="container ml-5 my-5">
        <div class="row g-0">
            <div class="col col-md-1 float-left ml-5">
                <img src="{{ asset('img/logo.jpg') }}" height="110" width="110"></div>
            <div class="col col-md-10 float-left">
                <p align="center"><b>LAPORAN ABSENSI KARYAWAN <br>
                        CV. JENDERAL SOFTWARE </b><br>
                    Jln. Menteri Supeno, Perum Griya Permata Residence No B9 Kec. Sokaraja <br>
                    Kab. Banyumas Jawa Tengah 53181 jenderal.software@gmail.com | 085742798737</p>
            </div>
        </div>
        <hr color="#000000">


        <table class="table table-bordered" align="center" border="1px" style="width:95% ">
            <thead>
                <tr class="table-secondary text-center">
                    <th width="5%">No</th>
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
    </div>
</body>


</html>
