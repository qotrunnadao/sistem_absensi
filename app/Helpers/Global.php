<?php

function active_menu($segmen, $m)
{
	if ($m == Request::segment($segmen)) {
		echo 'active';
	}
}

function menu_open($segmen, $m)
{
	if ($m == Request::segment($segmen)) {
		echo 'menu-open';
	}
}

function swal_delete($table, $button)
{
	$delete =
		"<script>
			\$(document).ready(function () {
				$('" . $table . "').on('contextmenu', '" . $button . "', function(e){ 
					alertify.error('Gunakan tombol kiri !');
					return false; 
				});
				\$('" . $table . "').on('click', '" . $button . "', function(e){
					e.preventDefault();
					const remove = \$(this).attr('href');
					Swal.fire({
						title: 'Apakah anda yakin?',
						text: 'Menghapus data ini',
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Ya, Hapus!'
						}).then((result) => {
							if (result.value) {
								document.location.href = remove;
							}
							})
							});
							});
							</script>";
	return $delete;
}

function rupiah($angka)
{
	$hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
	return $hasil_rupiah;
}

function custom_select($subject, $id, $inputSlug = null)
{
	$clsname = 'App\\' . $subject;
	$cls = new $clsname();
	$result = $cls->where('id', $id)->where('active', 1)->first();
	return $result;
}


function notify($type, $title, $notify)
{
	session()->flash('notify', array('type' => $type, 'title' => $title, 'msg' => $notify));
}

function dateDec($tgl)
{
	$exp = explode("/", $tgl);
	return $exp[2] . "-" . $exp[1] . "-" . $exp[0];
}

function daterangeDec($tanggal)
{
	$tgls = explode(' - ', $tanggal);

	$tgl[0] = dateDec($tgls[0]);
	$tgl[1] = dateDec($tgls[1]);

	return $tgl;
}

function generateDateRange($begin, $end, $format, $tambahan = '')
{
	$end = date('Y-m-d', strtotime('+1 days', strtotime($end)));
	if ($begin == $end) {
		$range[] = $begin;
		return $range;
	}

	$period = new \DatePeriod(
		new \DateTime($begin),
		new \DateInterval('P1D'),
		new \DateTime($end)
	);

	foreach ($period as $date) {
		$range[] = $date->format($format) . $tambahan;
	}

	return $range;
}

function selisih_tanggal($awal, $akhir)
{
	$tgl1 = new \DateTime($awal);
	$tgl2 = new \DateTime($akhir);
	$d = $tgl2->diff($tgl1)->days + 1;

	return $d;
}

function hitung_umur($birthday)
{

	// Convert Ke Date Time
	$biday = new DateTime($birthday);
	$today = new DateTime();

	$diff = $today->diff($biday);

	// Display
	return $diff;
}

function tgl_indo($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);

	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
