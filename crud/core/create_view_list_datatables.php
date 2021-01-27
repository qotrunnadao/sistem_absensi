<?php
$column_non_pk = array();
foreach ($non_pk as $row) {
    $column_non_pk[] .= "\n\t\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\t\"data\": \"" . $row['column_name'] . "\"\n\t\t\t\t\t\t\t\t\t}";
}
$col_non_pk = implode(',', $column_non_pk);
$string = "
@extends('layouts.app')
@section('title','Data ".ucwords($m)."')
@section('content')
<div class=\"row\"> 
    <div class=\"col-md-12\">
        <div class=\"card\">
            <h5 class=\"card-header bg-transparent border-bottom mt-0\"> Data " . str_replace('_', ' ', ucwords($m)) . " </h5>
            <div class=\"card-body\">
                <a href=\"$nama_class/create\" class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i> Tambah Data</a>
                <div class=\"table-responsive mt-3\">
                    <table class=\"table table-bordered dt-responsive nowrap\" style=\"border-collapse: collapse; border-spacing: 0; width: 100%;\" id=\"table-$m\">
                        <thead>
                            <tr>
                                <th class=\"text-center\" width=\"5%\">No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t\t\t\t\t\t\t<th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t\t\t\t\t\t\t<th class=\"text-center\" width=\"15%\">Aksi</th>
                            </tr>
                        </thead>";
$column_non_pk = array();
foreach ($non_pk as $row) {
    $column_non_pk[] .= "\n\t\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\t\"data\": \"" . $row['column_name'] . "\"\n\t\t\t\t\t\t\t\t\t}";
}
$col_non_pk = implode(',', $column_non_pk);
$string .= "    
                    </table>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
<script>
        var table = $(\"#table-$m\").DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: \"{{ route('$nama_class.data') }}\",
            columns: [
                {
                    \"data\": \"DT_RowIndex\"
                },
                " . $col_non_pk . ",
                {
                    \"data\" : \"action\",
                    \"orderable\": false,
                    \"className\" : \"text-center\"
                },

            ],
        });

    </script>
@endsection
";

$hasil_view_list = createFile($string, "../resources/views/" . $nama_class . "/" . $v_list_file);
