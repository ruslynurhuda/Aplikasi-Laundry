
<?php
    $title = 'Cetak Transaksi';
    $stitle = 'Detail Transaksi';
	require '../function/function.php'; 

    $id = $_GET['id'];
    $idc = $_GET['idc'];
                    
    $transaksi = query("SELECT * FROM pembayaran
                    INNER JOIN orderan
                    ON pembayaran.pembayaran_order = orderan.orderan_kd
                    INNER JOIN pelanggan
                    ON orderan.orderan_pelanggan = pelanggan.pelanggan_id
                    INNER JOIN cuci
					ON orderan.orderan_kd = cuci.cuci_order
                    WHERE pembayaran_id = $id
                    ORDER BY pembayaran_id DESC
                ");

    // query data tampung
    $items = query("SELECT * FROM cuci
                      INNER JOIN tampung
                      ON cuci.cuci_id = tampung.tampung_cuci
                      INNER JOIN service
                      ON tampung.tampung_service = service.service_kd
					  WHERE cuci_id = $idc
					  ORDER BY cuci_id DESC
                    ");

    // count items
    $Citems = ambilsatubaris("SELECT COUNT(tampung_cuci) as jumlah_items FROM tampung WHERE tampung_cuci = $idc");
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
	<div class="col-md-5">
	    <?php foreach($transaksi as $t ) : ?>
		<div class="card">
			<div class="card-header">

                        <div class="card-body" style="  font-family: Verdana, Geneva, Tahoma, sans-serif;">
                            <a class="btn btn-warning btn-sm hidden" href="transaksi.php" >Kembali</a>
                            <h4 class="text-center"><b>RUSLY LAUNDRY DRY CLEAN</b></h4>
                            <p class="text-center" style="font-size:12px;">Jalan Srandakan Km 200, Triharjo, Pandak, Bantul</p>
                            <p class="text-center" style="font-size:12px; margin-top:-15px">Telp : 086756827391 | 087619287312</p>
                            <p class="text-center" style="font-size:12px; margin-top:-15px">Email : Kasir@kasir.com</p>
                            <h5 class="text-center"><b>INVOICE</b></h5>
                            <P class="text-center" style="font-size:20px; margin-top:-15px;">----------------------------------------------</P>
							<div class="row" style=" margin-top:-15px;">
                                <div class="col-md-4">
                                    <h6><b>ID INVOICE</b></h6>
                                    <h6><b>ID ORDERAN</b></h6>
                                    <h6><b>TANGGAL</b></h6>
                                    <h6><b>PELANGGAN</b></h6>
                                    <h6><b>TELP</b></h6>
                                </div>
                                <div class="col-md-8 text-right">
                                    <h6>#<?= $t['pembayaran_kd'] ?></h6>
                                    <h6><?= $t['orderan_kd'] ?></h6>
                                    <h6><?= $t['pembayaran_waktu'] ?></h6>
                                    <h6><?= $t['pelanggan_nama'] ?></h6>
                                    <h6><?= $t['pelanggan_telp'] ?></h6>
                                </div>
                            </div>
                            <P class="text-center" style="font-size:20px; margin-top:-15px;">----------------------------------------------</P>

                            <div class="row text-center" style=" margin-top:-15px;">
                                <div class="col-md-4 ">
                                    <h6 class="font-weight-bold">ITEMS</h6>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="font-weight-bold">PRICE</h6>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="font-weight-bold">TOTAL</h6>
                                </div>
                            </div>

                            <P class="text-center" style="font-size:20px; margin-top:-15px;">----------------------------------------------</P>

                            <?php foreach($items as $i) : ?>
                            <div class="row" style=" margin-top:-15px;">
                                <div class="col-md-4 text-left">
                                    <p><?= $i['service_nama'] ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <p><?= $i['tampung_qt'] ?> x @ <?= number_format($i['service_harga'], 0, ".", ",")?></p>
                                </div>
                                <div class="col-md-4 text-right">
                                    <?php $total = $i['tampung_qt'] * $i['service_harga'] ?>
                                    <p><?= number_format($total, 0, ".", ",")?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>

                            <P class="text-center" style="font-size:20px; margin-top:-30px;">----------------------------------------------</P>
                            
                            <div class="row" style=" margin-top:-25px;">
                                <div class="col-md-4 text-center">
                                    <p><?= $Citems['jumlah_items'] ?> Items</p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Sub Total</b></p>
                                    <p style=" margin-top:-15px;"><b>Ppn (5%)</b></p>
                                    <p style=" margin-top:-15px;"><b>Grand Total</b></p>
                                    <p style=" margin-top:-15px;"><b>Bayar</b></p>
                                    <p style=" margin-top:-15px;"><b>Kembali</b></p>
                                </div>
                                <div class="col-md-4 text-right" >
                                    <p><?= number_format($t['pembayaran_total'], 0, ".", ",")?></p>
                                    <?php $ppn = ($t['pembayaran_total'] *  5)/100 ?>
                                    <p style=" margin-top:-15px;"><?= number_format($ppn, 0, ".", ",")?></p>
                                    <p style=" margin-top:-15px;"><?= number_format($t['pembayaran_final'], 0, ".", ",")?></p>
                                    <p style=" margin-top:-15px;"><?= number_format($t['pembayaran_tunai'], 0, ".", ",")?></p>
                                    <?php $kembali = $t['pembayaran_tunai'] - $t['pembayaran_final'] ?>
                                    <p style=" margin-top:-15px;"><?= number_format($kembali, 0, ".", ",")?></p>

                                </div>
                            </div>
                            <br>
                            <h5 class="text-center" style="font-size:13px;"><b>Terimakasih telah menggunakan layanan laundry kami</b></h5>
                            <p class="text-center" style="font-size:12px; margin-top:-5px;">Hitung dan periksa laundry anda, Pengaduan setelah meninggalkan outlet, tidak kami layani !!</p>
                            <br>
                            <br>
                            <P class="text-center" style="font-size:15px; margin-top:-30px;"><b>---------------------INVOICE COPY---------------------</b></P>
						</div>
				<?php endforeach; ?>
					</div>
				</div>
</div>

</body>
</html>
