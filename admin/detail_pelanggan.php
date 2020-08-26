
<?php
    $Title = 'Data Master';
    $title = 'Data Pelanggan';
    $stitle = 'Detail Pelanggan';
	require 'layout/layout_header.php'; 

	$id = $_GET['id'];
	$orderan = query("SELECT * FROM orderan 
					  INNER JOIN pelanggan 
					  ON orderan.orderan_pelanggan = pelanggan.pelanggan_id 
					  INNER JOIN cuci
					  ON orderan.orderan_kd = cuci.cuci_order
					--   INNER JOIN alur
					--   ON orderan.orderan_kd = alur.alur_order
					  WHERE pelanggan_id = $id
					  ORDER BY orderan_id DESC
                    ");
    $pelanggan = query("SELECT * FROM pelanggan WHERE pelanggan_id = '$id' ");

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
				<?php foreach($pelanggan as $p ) : ?>
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title mx-2"><b>PELANGGAN <?= $p['pelanggan_nama'] ?></b></h4>
                                </a>
							</div>
						</div>
						<div class="card-body">
							<table class="table">
								<tr>
									<th width="180">ID</th>
									<td>: <?= $p['pelanggan_kd'] ?></td>
								</tr>
								<tr>
									<th width="180">Nama </th>
									<td>: <?= $p['pelanggan_nama'] ?></td>
								</tr>
								<tr>
									<th width="180">Jenis Kelamin</th>
									<td>: <?= $p['pelanggan_jk'] ?></td>
								</tr>
                                <tr>
									<th width="180">Alamat</th>
									<td>: <?= $p['pelanggan_alamat'] ?></td>
								</tr>
                                <tr>
									<th width="180">No Telphone</th>
									<td>: <?= $p['pelanggan_telp'] ?></td>
								</tr>
                                <tr>
									<th width="180">Tanggan Gabung</th>
									<td>: <?= $p['pelanggan_join'] ?></td>
								</tr>
							</table>
						</div>
				<?php endforeach; ?>
					</div>
				</div>

				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title"><b>Riwayat Cucian</b></h4>
                                </a>
							</div>
						</div>
						<div class="card-body">
                        <div class="table-responsive">
								<table class="display table table-hover">
									<thead class="thead-light text-center">
										<th>Kode Order</th>
										<th>Waktu</th>
										<th>Total</th>
										<th>Status</th>
									</thead>
									<?php foreach($orderan as $o) : ?>
									<tbody>
										<td><?= $o['orderan_kd'] ?></td>
										<?php
										// jumlah pembayaran
										$cuci_id = $o['cuci_id'];
										$bayar = ambilsatubaris("SELECT SUM(tampung_qt * service_harga) as totalBayar FROM orderan 
																	INNER JOIN pelanggan 
																	ON orderan.orderan_pelanggan = pelanggan.pelanggan_id 
																	INNER JOIN cuci
																	ON orderan.orderan_kd = cuci.cuci_order
																	INNER JOIN tampung
																	ON cuci.cuci_id = tampung.tampung_cuci
																	INNER JOIN service
																	ON tampung.tampung_service = service.service_kd
																	WHERE cuci_id = $cuci_id
																	ORDER BY cuci_id DESC");

										// ppn dan total bayar
										$ppn = ($bayar['totalBayar'] * 5)/100;
										$total = $bayar['totalBayar'] + $ppn;
										?>
										<td ><?= $o['orderan_masuk'] ?></td>
										<td ><?= 'Rp ' .  number_format($total, 0, ".", ",")?></td>
										<td class="text-center ">
                                            <div class="form-button-action justify-content-center">
												<a href="detail_orderan.php?id=<?= $o['cuci_id'] ?>" class="btn btn-link btn-primary">
													<i class="fa fa-search-plus"></i>
												</a>
											</div>
                                        </td>
									</tbody>
									<?php endforeach; ?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php require 'layout/layout_footer.php'; ?>