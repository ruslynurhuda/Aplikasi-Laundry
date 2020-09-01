
<?php
    $title = 'Cetak Transaksi';
    $stitle = 'Detail Transaksi';
	require '../function/function.php'; 

    $id = $_GET['id'];
                    
	$orderan = query("SELECT * FROM orderan 
					  INNER JOIN pelanggan 
					  ON orderan.orderan_pelanggan = pelanggan.pelanggan_id 
					  INNER JOIN cuci
					  ON orderan.orderan_kd = cuci.cuci_order
                      WHERE orderan_id = $id
					  ORDER BY orderan_id DESC
					");
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
	    <?php foreach($orderan as $o ) : ?>
		<div class="card">
			<div class="card-header">

                        <div class="card-body" style="  font-family: Verdana, Geneva, Tahoma, sans-serif;">
                            <a class="btn btn-warning btn-sm hidden" href="orderan.php" >Kembali</a>
                            <h4 class="text-center"><b>RUSLY LAUNDRY DRY CLEAN</b></h4>
                            <p class="text-center" style="font-size:12px;">Jalan Srandakan Km 200, Triharjo, Pandak, Bantul</p>
                            <p class="text-center" style="font-size:12px; margin-top:-15px">Telp : 086756827391 | 087619287312</p>
                            <p class="text-center" style="font-size:12px; margin-top:-15px">Email : Kasir@kasir.com</p>
                            <h5 class="text-center"><b>ORDER</b></h5>
                            <P class="text-center" style="font-size:20px; margin-top:-15px;">----------------------------------------------</P>
							<div class="row" style=" margin-top:-15px;">
                                <div class="col-md-5">
                                    <h6><b>ID ORDERAN</b></h6>
                                    <h6><b>TGL ORDER</b></h6>
                                    <h6><b>ID PELANGGAN</b></h6>
                                    <h6><b>PELANGGAN</b></h6>
                                    <h6><b>TELP</b></h6>
                                </div>
                                <div class="col-md-7 text-right">
                                    <h6><?= $o['orderan_kd'] ?></h6>
                                    <h6><?= $o['orderan_masuk'] ?></h6>
                                    <h6><?= $o['pelanggan_kd'] ?></h6>
                                    <h6><?= $o['pelanggan_nama'] ?></h6>
                                    <h6><?= $o['pelanggan_telp'] ?></h6>
                                </div>
                            </div>
                            <P class="text-center" style="font-size:20px; margin-top:-15px;">----------------------------------------------</P>

                            <br>
                            <h5 class="text-center" style="font-size:13px; margin-top:-40px;"><b>Terimakasih telah menggunakan layanan laundry kami</b></h5>
                            <p class="text-center" style="font-size:12px; margin-top:-5px;">Silahkan bawa nota ini sebagai barang bukti saat pembayaran dan pengambilan barang !</p>
                            <br>
                            <br>
                            <P class="text-center" style="font-size:15px; margin-top:-30px;"><b>-----------------------ORDER COPY-----------------------</b></P>
						</div>
				<?php endforeach; ?>
					</div>
				</div>
</div>

</body>
</html>
