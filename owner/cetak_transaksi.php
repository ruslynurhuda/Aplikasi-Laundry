
<?php
    $title = 'Cetak Transaksi Masuk';
    $stitle = 'Detail Transaksi';

	require '../function/function.php'; 

    $a = $_GET['tgl_awal'];
    $awal = date('Ymd', strtotime($a));
    $b = $_GET['tgl_akhir'];
    $akhir = date('Ymd', strtotime($b));
    $no = 1;
    $nama = $_GET['nama'];
                    
    $transaksi = query("SELECT * FROM pembayaran
                    INNER JOIN orderan
                    ON pembayaran.pembayaran_order = orderan.orderan_kd
                    INNER JOIN pelanggan
                    ON orderan.orderan_pelanggan = pelanggan.pelanggan_id
                    INNER JOIN cuci
					ON orderan.orderan_kd = cuci.cuci_order
                    WHERE pembayaran_date BETWEEN $awal AND $akhir
                    ORDER BY pembayaran_id DESC
                ");
    
     // count jumalah
     $cj = ambilsatubaris("SELECT SUM(pembayaran_final) as jumlah FROM pembayaran WHERE pembayaran_date BETWEEN $awal AND $akhir");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?= $title; ?></title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" type="image/png" sizes="16x16" href="../assets/img/icon/icon.png">

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
    </script>
    <style>
        @media print{
            .hidden {
                display : none !important;
            }
        }
    </style>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>
<body onload="window.print()" onfocus="window.close()">

<div class="row">
    <div class="col-md-10 text-dark mx-5">
            <a class="btn btn-warning btn-sm hidden" href="transaksi.php" >Kembali</a>
            <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif; letter-spacing: 2px;"><b>RUSLY LAUNDRY & DRY CLEAN</b></h1>
            <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Jalan Srandakan Km 200, Triharjo, Pandak, Bantul<br> Telp : 086756827391 | 087619287312</h5>
            <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Email : cetaklaporantransaksi@laundry.com</h5>
        </div>
    </div>
    <hr>
    <div class="col-md text-center text-dark">
        <h2 style="font-family: Verdana, Geneva, Tahoma, sans-serif; letter-spacing: 2px;"><b>LAPORAN TRANSAKSI MASUK</b></h2>
        <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif; letter-spacing: 2px;"><b>PERIODE <?= $awal; ?> - <?= $akhir ?></b></h5>
    </div>
    <hr>
    <div class="row mx-5">
        <div class="table-responsive">
            <table  class="display table">
                <thead>
                    <tr class="thead-light" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
                        <th scope="col" >No</th>
                        <th scope="col" >Kode Transaksi</th>
                        <th scope="col" >Transaksi Masuk</th>
                        <th scope="col" >Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($transaksi as $t) : ?>
                    <tr>
                        <td style="font-family: Verdana, Geneva, Tahoma, sans-serif;"><?= $no++; ?></td>
                        <td style="font-family: Verdana, Geneva, Tahoma, sans-serif;"><?= $t['pembayaran_kd']; ?></td>
                        <td style="font-family: Verdana, Geneva, Tahoma, sans-serif;"><?= $t['pembayaran_waktu']; ?></td>
                        <td style="font-family: Verdana, Geneva, Tahoma, sans-serif;"><?= 'Rp ' .  number_format($t['pembayaran_final'], 0, ".", ",")?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; letter-spacing: 1px;" colspan="3" align="right"><b>Jumlah : </b></td>
                        <td style="font-family: Verdana, Geneva, Tahoma, sans-serif; letter-spacing: 1px;;" class="text-left" colspan="3" align="center"><b><?= 'Rp ' .  number_format($cj['jumlah'], 0, ".", ",") ?></b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mx-5 text-center mt-3">
        <div class="col-md-6">
            <h5> </h5><br>
            <h5 class="text-dark" style="font-family: Verdana, Geneva, Tahoma, sans-serif; letter-spacing: 2px;">Cetak</h5>
            <br>
            <br>
            <br>
            <h5 class="text-dark" class="text-uppercase" style="font-family: Verdana, Geneva, Tahoma, sans-serif; letter-spacing: 2px;"><b>( <?= $nama ?> )</b></h5>
        </div>

        <div class="col-md-6">
            <h5 class="text-dark" style="font-family: Verdana, Geneva, Tahoma, sans-serif; letter-spacing: 2px;">Bantul, <?= date('d F Y') ?></h5>
            <h5 class="text-dark" style="font-family: Verdana, Geneva, Tahoma, sans-serif; letter-spacing: 2px;">Manager</h5>
            <br>
            <br>
            <br>
            <h5 class="text-uppercase text-dark" style="font-family: Verdana, Geneva, Tahoma, sans-serif; letter-spacing: 2px;"><b>Rusly Nur Huda</b></h5>
        </div>
    </div>

    <script>window.print();</script>

</body>
</html>
