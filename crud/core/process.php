<?php

$hasil = array();

if (isset($_POST['generate'])) {
    // get form data
    $table_name = safe($_POST['table_name']);
    $jenis_tabel = safe($_POST['jenis_tabel']);
    $export_excel = safe($_POST['export_excel']);
    $export_word = safe($_POST['export_word']);
    $export_pdf = safe($_POST['export_pdf']);
    $controller = safe($_POST['controller']);
    $model = safe($_POST['model']);
    $form = safe($_POST['form']);
    $list = safe($_POST['list']);
    $show = safe($_POST['show']);

    if ($table_name <> '') {
        // set data
        $table_name = $table_name;
        $c = $controller <> '' ? ucfirst($controller) : ucfirst($table_name) . 'Controller';
        $m = $model <> '' ? ucfirst($model) : ucfirst($table_name);
        $v_list = $list <> '' ? $list : $table_name . "_index.blade";
        $v_show = $show <> '' ? $show : $table_name . "_show.blade";
        $v_form = $form <> '' ? $form : $table_name . "_create.blade";
        // $v_doc = $table_name . "_doc";
        // $v_pdf = $table_name . "_pdf";

        // url
        $c_url = strtolower($c);
        $nama_class = strtolower($m);
        // filename
        $c_file = $c . '.php';
        $m_file = $m . '.php';
        $v_list_file = $v_list . '.php';
        $v_show_file = $v_show . '.php';
        $v_form_file = $v_form . '.php';
        $v_doc_file = $v_doc . '.php';
        $v_pdf_file = $v_pdf . '.php';

        // show setting
        $get_setting = readJSON('core/settingjson.cfg');
        $target = $get_setting->target;
        $targetViews = $get_setting->$targetViews;
        if (!file_exists("../resources/views/" . $nama_class)) {
            mkdir("../resources/views/" . $nama_class, 0777, true);
            $file = '../routes/web.php';
            $person = "
//route untuk tabel $nama_class
use App\Http\Controllers\ $c;
Route::get('$nama_class', [$c::class, 'index']);
Route::get('$nama_class/data', [$c::class, 'data_json'])->name('$nama_class.data');
Route::get('$nama_class/create', [$c::class, 'create']);
Route::post('$nama_class/store', [$c::class, 'store']);
Route::get('$nama_class/edit/{id}', [$c::class, 'edit']);
Route::put('$nama_class/update/{id}', [$c::class, 'update']);
Route::get('$nama_class/delete/{id}', [$c::class, 'delete']);
Route::get('$nama_class/cari', [$c::class, 'cari']);
Route::get('$nama_class/show/{id}', [$c::class, 'show']);";
file_put_contents($file, $person, FILE_APPEND | LOCK_EX);
        }

        $pk = $hc->primary_field($table_name);
        $non_pk = $hc->not_primary_field($table_name);
        $all = $hc->all_field($table_name);

        // generate
        include 'core/create_controller.php';
        include 'core/create_model.php';
        if ($jenis_tabel == 'reguler_table') {
            include 'core/create_view_list.php';
            include 'core/create_config_pagination.php';
        } else if ($jenis_tabel == 'datatables') {
            include 'core/create_view_list_datatables.php';
            // include 'core/create_libraries_datatables.php';
        } else if ($jenis_tabel == 'clientside') {
            include 'core/create_view_list_clientside.php';
        }
        include 'core/create_view_form.php';
        include 'core/create_view_show.php';
     


        $hasil[] = $hasil_controller;
        $hasil[] = $hasil_model;
        $hasil[] = $hasil_view_list;
        $hasil[] = $hasil_view_form;
        $hasil[] = $hasil_view_show;
        // $hasil[] = $hasil_view_doc;
        // $hasil[] = $hasil_view_pdf;
        //$hasil[] = $hasil_config_pagination;
        // $hasil[] = $hasil_exportexcel;
        // $hasil[] = $hasil_pdf;
    } else {
        $hasil[] = 'No table selected.';
    }
}

// if (isset($_POST['generateall'])) {

//     $jenis_tabel = safe($_POST['jenis_tabel']);
//     $export_excel = safe($_POST['export_excel']);
//     $export_word = safe($_POST['export_word']);
//     $export_pdf = safe($_POST['export_pdf']);

//     $table_list = $hc->table_list();
//     foreach ($table_list as $row) {

//         $table_name = $row['table_name'];
//         $c = ucfirst($table_name);
//         $m = ucfirst($table_name) . '_model';
//         $v_list = $table_name . "_list";
//         $v_show = $table_name . "_show";
//         $v_form = $table_name . "_form";
//         $v_doc = $table_name . "_doc";
//         $v_pdf = $table_name . "_pdf";

//         // url
//         $c_url = strtolower($c);

//         // filename
//         $c_file = $c . '.php';
//         $m_file = $m . '.php';
//         $v_list_file = $v_list . '.php';
//         $v_show_file = $v_show . '.php';
//         $v_form_file = $v_form . '.php';
//         $v_doc_file = $v_doc . '.php';
//         $v_pdf_file = $v_pdf . '.php';

//         // show setting
//         $get_setting = readJSON('core/settingjson.cfg');
//         $target = $get_setting->target;
//         if (!file_exists($target . "views/" . $c_url)) {
//             mkdir($target . "views/" . $c_url, 0777, true);
//         }

//         $pk = $hc->primary_field($table_name);
//         $non_pk = $hc->not_primary_field($table_name);
//         $all = $hc->all_field($table_name);

//         // generate
//         //include 'core/create_config_pagination.php';
//         include 'core/create_controller.php';
//         include 'core/create_model.php';
//         if ($jenis_tabel == 'reguler_table') {
//             include 'core/create_view_list.php';
//         } else if ($jenis_tabel == 'datatables') {
//             include 'core/create_view_list_datatables.php';
//             include 'core/create_libraries_datatables.php';
//         } else if ($jenis_tabel == 'clientside') {
//             include 'core/create_view_list_clientside.php';
//         }
//         include 'core/create_view_form.php';
//         include 'core/create_view_show.php';

//         $export_excel == 1 ? include 'core/create_exportexcel_helper.php' : '';
//         $export_word == 1 ? include 'core/create_view_list_doc.php' : '';
//         $export_pdf == 1 ? include 'core/create_pdf_library.php' : '';
//         $export_pdf == 1 ? include 'core/create_view_list_pdf.php' : '';

//         $hasil[] = $hasil_controller;
//         $hasil[] = $hasil_model;
//         $hasil[] = $hasil_view_list;
//         $hasil[] = $hasil_view_form;
//         $hasil[] = $hasil_view_show;
//         $hasil[] = $hasil_view_doc;
//     }

//     //$hasil[] = $hasil_config_pagination;
//     $hasil[] = $hasil_exportexcel;
//     $hasil[] = $hasil_pdf;
// }
