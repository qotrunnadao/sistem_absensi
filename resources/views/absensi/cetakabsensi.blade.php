<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" <style>
    table.static {
    position: relative;
    border: 1px solid #259dab;
    }
    </style>

    <title>Cetak Absensi</title>
</head>

<body>
    <div class="form-group">
        <p align="center"><b>LAPORAN ABSENSI KARYAWAN</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width:95% ">
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th>Foto</th>
                    <th>Nama karyawan</th>
                    <th>Jenis</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Waktu</th>
                    <th class="text-center" width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php ($no = 1)
                @foreach ($cetakabsensi as $value)
                <tr class="text-center">
                    <td>{{ $no++ }}</td>
                    <td>{{ $value->foto }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->jenis == 0 ? 'masuk' : 'pulang' }}</td>
                    <td>{{ $value->latitude}}</td>
                    <td>{{ $value->longitude}}</td>
                    <td>{{ $value->created_at }}</td>
                </tr>
                @endforeach
        </table>
    </div>

</body>

</html>
