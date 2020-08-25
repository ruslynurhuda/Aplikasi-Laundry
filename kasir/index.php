<?php 
	$title = 'Dashboard';
	require 'layout/layout_header.php'; 

	// count Pelanggan
	$pelanggan = ambilsatubaris("SELECT COUNT(pelanggan_id) as pelanggan FROM pelanggan");

	// count status menunggu
	$menunggu = ambilsatubaris("SELECT COUNT(orderan_status) as menunggu FROM orderan WHERE orderan_status = 'menunggu' ");

	// count status dicuci
	$dicuci = ambilsatubaris("SELECT COUNT(orderan_status) as dicuci FROM orderan WHERE orderan_status = 'dicuci' ");

	// count status selesai
	$selesai = ambilsatubaris("SELECT COUNT(orderan_status) as selesai FROM orderan WHERE orderan_status = 'selesai' ");

	// count Pendapatan hari ini
	$hari_ini = date('Ymd');
	$Pnow = ambilsatubaris("SELECT SUM(pembayaran_final) as final FROM pembayaran WHERE pembayaran_date = $hari_ini ");

	// count Pendapatan hari ini
	$bulan_ini = date('Ym');
	$bulan_start = $bulan_ini . "01";
	$bulan_akhir = $bulan_ini . "31";
	$Pbulan = ambilsatubaris("SELECT SUM(pembayaran_final) as finals FROM pembayaran WHERE pembayaran_date BETWEEN $bulan_start AND $bulan_akhir ");

	// Combine Tanggal
	$date = date('Ymd');
	$combine = range($date, $date - 7);
	$dates = array_combine($combine, $combine);

	// query transaksi
	$transaksi = query("SELECT * FROM pembayaran");

	// Query Orderan
	$hari_ini = date('Ymd');
	$orderan = query("SELECT * FROM orderan 
					  INNER JOIN pelanggan 
					  ON orderan.orderan_pelanggan = pelanggan.pelanggan_id 
					  INNER JOIN cuci
					  ON orderan.orderan_kd = cuci.cuci_order
					  WHERE orderan_date = $hari_ini
					  ORDER BY orderan_id DESC
					");


?>


<div class="main-panel">
	<div class="content">
		<div class="panel-header">
			<div class="page-inner">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div>
						<h2 class="text-grey pb-2 fw-bold mt-2">Dashboard</h2>
					</div>
				</div>
			</div>
		</div>
		
		<div class="page-inner">
			<div class="row">
				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-round">
						<div class="card-body ">
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-primary bubble-shadow-small">
										<i class="flaticon-users"></i>
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<div class="numbers">
										<p class="card-category">Pelanggan</p>
										<h4 class="card-title"><?= $pelanggan['pelanggan'] ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-round">
						<div class="card-body ">
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-primary bubble-shadow-small">
										<i class="flaticon-upward"></i>
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<div class="numbers">
										<p class="card-category">Orderan Menunggu</p>
										<h4 class="card-title"><?= $menunggu['menunggu'] ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-round">
						<div class="card-body ">
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-primary bubble-shadow-small">
										<i class="flaticon-inbox"></i>
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<div class="numbers">
										<p class="card-category">Orderan Dicuci</p>
										<h4 class="card-title"><?= $dicuci['dicuci'] ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-round">
						<div class="card-body ">
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-primary bubble-shadow-small">
										<i class="flaticon-success"></i>
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<div class="numbers">
										<p class="card-category">Orderan Selesai</p>
										<h4 class="card-title"><?= $selesai['selesai'] ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-round">
						<div class="card-body ">
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-success bubble-shadow-small">
										<i class="flaticon-coins"></i>
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<div class="numbers">
										<p class="card-category">Pendapatan hari ini</p>
										<h4 class="card-title"><?= 'Rp ' .  number_format($Pnow['final'], 0, ".", ",")?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-round">
						<div class="card-body ">
							<div class="row align-items-center">
								<div class="col-icon">
									<div class="icon-big text-center icon-success bubble-shadow-small">
										<i class="flaticon-coins"></i>
									</div>
								</div>
								<div class="col col-stats ml-3 ml-sm-0">
									<div class="numbers">
										<p class="card-category">Pendapatan bulan ini</p>
										<h4 class="card-title"><?= 'Rp ' .  number_format($Pbulan['finals'], 0, ".", ",")?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title"><b>Rekap Transaksi 7 hari terakhir</b></h4>
                                </a>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="display table table-hover">
									<tr class="thead-light">
										<th>Tanggal</th>
										<th>Transaksi</th>
										<th>Nominal</th>
									</tr>
									<?php foreach($dates as $date) : ?>
									<tr>
										<?php $strtotime = date('Y-m-d', strtotime($date)) ?>
										<td><?= $strtotime; ?></td>
										
										<!-- count transaksi -->
										<?php $jumlah = ambilsatubaris("SELECT COUNT(pembayaran_id) as pembayaran FROM pembayaran WHERE pembayaran_date = $date"); ?>
										<td><?= $jumlah['pembayaran'] ?></td>

										<!-- jumlah Total transaksi -->
										<?php $total = ambilsatubaris("SELECT SUM(pembayaran_final) as final FROM pembayaran WHERE pembayaran_date = $date"); ?>
										<td><?= 'Rp ' .  number_format($total['final'], 0, ".", ",")?></td>
									</tr>
									<?php endforeach; ?>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title"><b>Orderan Hari ini</b></h4>
                                </a>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="display table table-hover">
									<thead class="thead-light text-center">
										<th>Kode Orderan</th>
										<th>Pelanggan</th>
										<th>Total</th>
										<th>Status</th>
									</thead>
									<?php foreach($orderan as $o) : ?>
									<tbody>
										<td class="text-success">
											<a href="detail_orderan.php?id=<?= $o['cuci_id'] ?>"><h5><?= $o['orderan_kd'] ?></h5></a>
										</td>
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
										<td style="font-size:12px"><?= $o['pelanggan_nama'] ?></td>
										<td style="font-size:12px"><?= 'Rp ' .  number_format($total, 0, ".", ",")?></td>
										<td class="text-center ">
                                             <?php if($o['orderan_status'] == 'menunggu') : ?>
												<span class="badge badge-secondary my-1">Menunggu</span> &nbsp;
											<?php elseif($o['orderan_status'] == 'dicuci') : ?>
                                                <span class="badge badge-primary my-1">Sedang Cuci</span> &nbsp;
                                            <?php elseif($o['orderan_status'] == 'selesai') : ?>
												<span class="badge badge-success my-1">Selesai</span> &nbsp;
											<?php endif; ?>
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