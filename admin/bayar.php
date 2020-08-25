<?php
    $title = 'Data Cuci';
    $stitle = 'Detail Pembayaran';
    require 'layout/layout_header.php'; 

    $id = $_GET['id'];
    // Query data cucian
	$orderan = query("SELECT * FROM orderan 
					  INNER JOIN pelanggan 
					  ON orderan.orderan_pelanggan = pelanggan.pelanggan_id 
					  INNER JOIN cuci
					  ON orderan.orderan_kd = cuci.cuci_order
					--   INNER JOIN alur
					--   ON orderan.orderan_kd = alur.alur_order
					  WHERE cuci_id = $id
					  ORDER BY cuci_id DESC
                    ");

    // Generate kode tampung
	$bHuruf1         = "QWERTYUIOPLKJHGFDSAZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890";
    $acakHuruf3      = str_shuffle($bHuruf1);
    $kode_tampung       = substr($acakHuruf3, 0, 15);
    
    // Generate kode transaksi
    $bHuruf         = "QWERTYUIOPLKJHGFDSAZXCVBNM";
    $bAngka         = "1234567890";
    $date           = date("ymd");
    $acakHuruf_1    = str_shuffle($bHuruf);
    $acakHuruf_2    = str_shuffle($bHuruf);
    $acakAngka      = str_shuffle($bAngka);
    $kode_transaksi = "INV" . $date . substr($acakHuruf_1, 0, 2).substr($acakAngka, 0, 2);
	
	// Generate kode alur
	$bHuruf1         = "QWERTYUIOPLKJHGFDSAZXCVBNMqwertyuiopasdfghjklzxcvbnm";
    $acakHuruf3    = str_shuffle($bHuruf1);
    $kode_alur      = substr($acakHuruf3, 0, 15);

    // query data tampung
    $tampung = query("SELECT * FROM cuci
                      INNER JOIN tampung
                      ON cuci.cuci_id = tampung.tampung_cuci
                      INNER JOIN service
                      ON tampung.tampung_service = service.service_kd
					  WHERE cuci_id = $id
					  ORDER BY cuci_id DESC
                    ");

    // query data service
    $service    = query("SELECT * FROM service");  

    // jumlah pembayaran
    $bayar = ambilsatubaris("SELECT SUM(tampung_qt * service_harga) as totalBayar FROM orderan 
                                INNER JOIN pelanggan 
                                ON orderan.orderan_pelanggan = pelanggan.pelanggan_id 
                                INNER JOIN cuci
                                ON orderan.orderan_kd = cuci.cuci_order
                                -- INNER JOIN alur
                                -- ON orderan.orderan_kd = alur.alur_order
                                INNER JOIN tampung
                                ON cuci.cuci_id = tampung.tampung_cuci
                                INNER JOIN service
                                ON tampung.tampung_service = service.service_kd
                                WHERE cuci_id = $id
                                ORDER BY cuci_id DESC");
    $ppn = ($bayar['totalBayar'] * 5)/100;
    $total = $bayar['totalBayar'] + $ppn;

	?>

<!-- content -->
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title"><?=$stitle;  ?></h4>
				<ul class="breadcrumbs">
					<li class="nav-home">
						<a href="index.php">
							<i class="flaticon-home"></i>
						</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="pengguna.php"><?=$stitle;  ?></a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-6">
				<?php foreach($orderan as $o ) : ?>
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title mx-2"><b>Informasi Cucian</b></h4>
                                </a>
							</div>
						</div>
						<div class="card-body">
							<table>
								<tr>
                                    <th height="30" width="250">Kode Orderan</th>
                                    <td width="20">:</td>
									<td><b><?= $o['orderan_kd'] ?></b></td>
								</tr>
                                <tr>
                                    <th height="30" width="250">Kode Transaksi</th>
                                    <td width="20">:</td>
                                    <td><b><?= $kode_transaksi;?></b></td>
                                </tr>
								<tr>
                                    <th height="30" width="250">Pelanggan</th>
                                    <td width="20">:</td>
									<td><?= $o['pelanggan_nama'] ?></td>
                                </tr>
                                <tr>
                                    <th height="30" width="250">Ppn</th>
                                    <td width="20">:</td>
									<td>5%</td>
                                </tr>
							</table>
							<div class="table-responsive">
								<table class="display table mt-4">
									<thead>
										<tr class="thead-light text-center">
											<th scope="col" >Items</th>
											<th scope="col" >Qt</th>
                                            <th scope="col" >Harga</th>
											<th scope="col" >Total</th>
										</tr>
									</thead>
									<tbody class="text-center">
                                        <?php
                                        $no = 1;
                                        if($tampung) :
                                            foreach($tampung as $t) : ?>
                                                <tr>
                                                    <td><?= $t['service_nama']; ?></td>
                                                    <td><?= $t['tampung_qt'] . " " . $t['service_satuan'] ?></td>
                                                    <td><?= 'Rp ' .  number_format($t['service_harga'], 0, ".", ",")?></td>
                                                    <?php $tampung_total = $t['service_harga'] * $t['tampung_qt']; ?>
                                                    <td><?= 'Rp ' .  number_format($tampung_total, 0, ".", ",")?></td>
                                                </tr>
                                            <?php endforeach;
                                        else : ?>
                                            <tr>
												<td colspan="8" class="text-center">Silahkan tambahkan orderan baru</td>
											</tr>
                                        <?php endif; ?>
                                    </tbody>
								</table>
							</div>
						</div>
				<?php endforeach; ?>
					</div>
				</div>

				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title"><b>Detail Harga</b></h4>
							</div>
						</div>
						<div class="card-body" style=" letter-spacing: 1px; font-family: Verdana, Geneva, Tahoma, sans-serif;">
                        <?php foreach($orderan as $o ) : ?>
                        <form action="bayar/proses_bayar.php" method="POST">
                            <input type="hidden" id="pembayaran_kd" name="pembayaran_kd" value = "<?= $kode_transaksi; ?>" readonly="readonly">
                            <input type="hidden" id="alur_kd" name="alur_kd" value = "<?= $kode_alur; ?>" readonly="readonly">
                            <input type="hidden" id="cuci_id" name="cuci_id" value = "<?= $o['cuci_id'] ?>" readonly="readonly">
                            <input type="hidden" id="pembayaran_operator" name="pembayaran_operator" value = "<?= $_SESSION['nama_user']; ?>" readonly="readonly">
                            <input type="hidden" id="orderan_kd" name="orderan_kd" value = "<?= $o['orderan_kd']; ?>" readonly="readonly">
                            <input type="hidden" id="orderan_id" name="orderan_id" value = "<?= $o['orderan_id']; ?>" readonly="readonly">
                            <input type="hidden" id="pembayaran_total" name="pembayaran_total" value = "<?= $bayar['totalBayar']; ?>" readonly="readonly">
                            <input type="hidden" id="pembayaran_final" name="pembayaran_final" value = "<?= $total; ?>" readonly="readonly">
                            <div class="form-group row" >
                                <label for="totalHarga" class="col-sm-4 col-form-label"><h4><b>Total Service</b></h4></label>
                                <div class="col-sm-8">
                                <h4><input onchange="hitung()" style=" letter-spacing: 1px; font-family: Verdana, Geneva, Tahoma, sans-serif;" type="text" readonly class="form-control-plaintext" id="totalHarga" name="totalHarga" value="<?= 'Rp ' .  number_format($bayar['totalBayar'], 0, ".", ",")?>">
                                </div></h4>
                            </div>
                            <div class="form-group row" >
                                <label for="diskon" class="col-sm-4 col-form-label"><h4><b>Disc (%)</b></h4></label>
                                <div class="col-sm-8">
                                <h4><input style=" letter-spacing: 1px; font-family: Verdana, Geneva, Tahoma, sans-serif;" type="text" readonly class="form-control-plaintext" id="diskon" name="diskon" value="<?= 'Rp ' .  number_format(0, 0, ".", ",")?>">
                                </div></h4>
                            </div>
                            <div class="form-group row" >
                                <label for="ppn" class="col-sm-4 col-form-label"><h4><b>Ppn (5%)</b></h4></label>
                                <div class="col-sm-8">
                                <h4><input style=" letter-spacing: 1px; font-family: Verdana, Geneva, Tahoma, sans-serif;" type="text" readonly class="form-control-plaintext" id="ppn" name="ppn" value="<?= 'Rp ' .  number_format($ppn, 0, ".", ",")?>">
                                </div></h4>
                            </div>
                            <div class="form-group row" >
                                <label for="totalBayar" class="col-sm-4 col-form-label"><h4><b>Total Bayar</b></h4></label>
                                <div class="col-sm-8">
                                <h4><input onchange="hitung()" style=" letter-spacing: 1px; font-family: Verdana, Geneva, Tahoma, sans-serif;" type="text" readonly class="form-control-plaintext" id="totalBayar" name="totalBayar" value="<?= 'Rp ' .  number_format($total, 0, ".", ",")?>">
                                </div></h4>
                            </div>
                            <div class="form-group row">
                                <label for="bayar" class="col-sm-4 col-form-label">Bayar</label>
                                <div class="col-sm-8">
                                <input onchange="hitung()" style=" letter-spacing: 1px; font-family: Verdana, Geneva, Tahoma, sans-serif;" type="number" class="form-control" id="bayar" name="bayar" value="0">
                                </div>
                            </div>
                            <div class="form-group row" >
                                <label for="tunai" class="col-sm-4 col-form-label"><h4><b>Tunai</b></h4></label>
                                <div class="col-sm-8">
                                <h4><input style=" letter-spacing: 1px; font-family: Verdana, Geneva, Tahoma, sans-serif;" type="text" readonly class="form-control-plaintext" id="tunai" name="tunai" value="<?= 'Rp ' .  number_format(0, 0, ".", ",")?>">
                                </div></h4>
                            </div>
                            <div class="form-group row" >
                                <label for="kembali" class="col-sm-4 col-form-label"><h4><b>Kembali</b></h4></label>
                                <div class="col-sm-8">
                                <h4><input style=" letter-spacing: 1px; font-family: Verdana, Geneva, Tahoma, sans-serif;" type="text" readonly class="form-control-plaintext" id="kembali" name="kembali" value="<?= 'Rp ' .  number_format(0, 0, ".", ",")?>">
                                </div></h4>
                            </div>
						    <button onclick="return confirm('Yakin nominal sudah benar dan ingin melakukan proses pembayaran?')" type="submit" name="tambah" id="alert" class="btn btn-primary my-3">Bayar</button>
                            <input type="button" value="Kembali" class="btn btn-secondary my-3" onclick="history.back(-1)" />
                        </form>
                        <?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>

    <script type="text/javascript">

		function hitung() {
        var bayar =  parseInt(document.getElementById('bayar').value) - <?= $total; ?>;
        var tunai = document.getElementById('bayar').value;
        var rp = "Rp "
        var	reverse = bayar.toString().split('').reverse().join(''),
            ribuan 	= reverse.match(/\d{1,3}/g);
            ribuan	= ribuan.join(',').split('').reverse().join('');
        
        var	reverse1 = tunai.toString().split('').reverse().join(''),
            ribuan1 = reverse1.match(/\d{1,3}/g);
            ribuan1	= ribuan1.join(',').split('').reverse().join('');

		document.getElementById('kembali').value = rp + ribuan;
        document.getElementById('tunai').value = rp + ribuan1;
		}
		
		
		</script>

<?php require 'layout/layout_footer.php'; ?>