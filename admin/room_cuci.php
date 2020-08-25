<?php
    $title = 'Data Cuci';
    $stitle = 'Detail Cucian';
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

    // count items
    $items = ambilsatubaris("SELECT COUNT(tampung_cuci) as jumlah_items FROM tampung WHERE tampung_cuci = $id");

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
							<table class="mx-3">
								<tr>
                                    <th height="30" width="250">Kode Orderan</th>
                                    <td width="20">:</td>
									<td><b><?= $o['orderan_kd'] ?></b></td>
								</tr>
								<tr>
                                    <th height="30" width="250">Pelanggan</th>
                                    <td width="20">:</td>
									<td><?= $o['pelanggan_nama'] ?></td>
                                </tr>
                                <tr>
                                    <th height="30" width="250">Waktu masuk</th>
                                    <td width="20">:</td>
									<td><?= $o['orderan_masuk'] ?></td>
                                </tr>
                                <tr>
                                    <th height="30" width="250">Total item</th>
                                    <td width="20">:</td>
									<td><?= $items['jumlah_items']; ?></td>
                                </tr>
                                <tr>
                                    <th height="30" width="250">Total harga</th>
                                    <td width="20">:</td>
									<td><?= 'Rp ' .  number_format($bayar['totalBayar'], 0, ".", ",")?></td>
								</tr>
								<tr>
                                    <th height="30" width="250">Ppn (5%)</th>
									<td width="20">:</td>
									<?php $ppn = ($bayar['totalBayar'] * 5)/100 ?>
									<td><?= 'Rp ' .  number_format($ppn, 0, ".", ",")?></td>
								</tr>
								<tr>
                                    <th height="30" width="250">Total Bayar</th>
									<td width="20">:</td>
									<?php $total = $bayar['totalBayar'] + $ppn ?>
									<td><?= 'Rp ' .  number_format($total, 0, ".", ",")?></td>
								</tr>
							</table>
							
							<div class="row mx-2">
								<a class="btn btn-success btn-sm mx-2 mt-4 <?= $o['orderan_status'] == 'menunggu' || $o['orderan_pembayaran'] =='selesai' || $o['orderan_status'] == 'dicuci' ? 'disabled' : '' ?>" href="bayar.php?id=<?= $o['cuci_id'] ?>" >
                               		<i class="fa fa-money-bill-alt">  Bayar</i>
                                </a>
								<a onclick="return confirm('Yakin sudah selesai?')" class="btn btn-success btn-sm mx-2 mt-4 <?= $o['orderan_status'] == 'menunggu' || $o['orderan_status'] == 'selesai' ? 'disabled' : '' ?>" href="cuci/set_selesai.php?idc=<?= $o['cuci_id']; ?>&ido=<?= $o['orderan_id'] ?>&okd=<?= $o['orderan_kd'] ?>&op=<?= $_SESSION['nama_user'] ?>" >
                               		<i class="fa fa-check-circle">  Set selesai</i>
                                </a>
                                </a>
							</div>
						</div>
				<?php endforeach; ?>
					</div>
				</div>

				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title"><b>List Cucian</b></h4>
                                <a class="topbar-toggler more ml-auto " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="icon-options-vertical"></i>
                                </a>
                                <div class="dropdown-menu">
									<a href="#" class="dropdown-item" data-toggle="modal" data-target="#tambah">
										<i class="fa fa-fw fa-plus text-success"></i>&nbsp; &nbsp; Tambah
									</a>
								</div>
							</div>
						</div>
						<div class="card-body">
                        <div class="table-responsive">
								<table class="display table">
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
					</div>
				</div>
			</div>
		</div>
    </div>
    
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-white bg-primary">
					<h5 class="modal-title" id="tambahLabel">Tambah items</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php foreach($orderan as $o) : ?>
				<?php if($o['orderan_status'] == "menunggu") : ?>
				<form action="cuci/cuci_item.php" method="POST">
				<?php elseif($o['orderan_status'] == "dicuci") : ?>
				<form action="cuci/cuci_item1.php" method="POST">
				<?php endif; ?>
				<?php endforeach ?>
					<div class="modal-body">
                            <input type="hidden" class="form-control" id="tampung_kd" name="tampung_kd" value = "<?= $kode_tampung; ?>" placeholder="Masukan Kode orderan" required="required" readonly="readonly">
							<input type="hidden" class="form-control" id="alur_kd" name="alur_kd" value = "<?= $kode_alur; ?>" placeholder="Masukan Kode orderan" required="required" readonly="readonly">
                            
                            <?php foreach($orderan as $o ) : ?>
                                <input type="hidden" class="form-control" id="tampung_cuci" name="tampung_cuci" value = "<?= $o['cuci_kd']; ?>" placeholder="Masukan Kode orderan" required="required" readonly="readonly">
                                <input type="hidden" class="form-control" id="cuci_id" name="cuci_id" value = "<?= $o['cuci_id']; ?>" placeholder="Masukan Kode orderan" required="required" readonly="readonly">
								<input type="hidden" class="form-control" id="orderan_id" name="orderan_id" value = "<?= $o['orderan_id']; ?>" placeholder="Masukan Kode orderan" required="required" readonly="readonly">
								<input type="hidden" class="form-control" id="orderan_kd" name="orderan_kd" value = "<?= $o['orderan_kd']; ?>" placeholder="Masukan Kode orderan" required="required" readonly="readonly">
								<input type="hidden" class="form-control" id="orderan_operator" name="orderan_operator" value = "<?= $_SESSION['nama_user'] ?>" placeholder="Masukan Kode orderan" required="required" readonly="readonly">

                            <?php endforeach; ?>

                        <div class="form-group">
							<label for="service_kd" class="col-form-label">Service</label>
							<select name="service_kd" id="service_kd" class="custom-select" required="required">
								<option value="" selected disabled>Pilih service</option>
								<?php foreach($service as $s ) : ?>
								<option value="<?= $s['service_kd'] ?>"><?= $s['service_nama'] ?></option>
								<?php endforeach; ?>
							</select>
                        </div>
                        
                        <div class="form-group">
							<label for="tampung_qt" class="col-form-label">Qt</label>
							<input type="text" class="form-control" id="tampung_qt" name="tampung_qt" placeholder="Masukan Qt" required="required">
                        </div>
                    
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" name="tambah" id="alert" class="btn btn-primary">Tambah</button>
					</div>
				</div>
			</form>
		</div>
    </div>

<?php require 'layout/layout_footer.php'; ?>