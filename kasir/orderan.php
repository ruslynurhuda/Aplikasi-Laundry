<?php
    $title = 'Data Orderan';
    require 'layout/layout_header.php'; 

	$orderan = query("SELECT * FROM orderan 
					  INNER JOIN pelanggan 
					  ON orderan.orderan_pelanggan = pelanggan.pelanggan_id 
					  INNER JOIN cuci
					  ON orderan.orderan_kd = cuci.cuci_order
					--   INNER JOIN alur
					--   ON orderan.orderan_kd = alur.alur_order
					  ORDER BY orderan_id DESC
					");
					

	$pelanggan = query("SELECT * FROM pelanggan");
    // $orderan = 'SELECT * FROM orderan INNER JOIN pelanggan ON pelanggan.pelanggan_id = orderan.orderan_pelanggan';
    
    // Generate kode orderan
    $bHuruf         = "QWERTYUIOPLKJHGFDSAZXCVBNM";
    $bAngka         = "1234567890";
    $acakHuruf_1    = str_shuffle($bHuruf);
    $acakHuruf_2    = str_shuffle($bHuruf);
    $acakAngka      = str_shuffle($bAngka);
	$kode_orderan     = substr($acakHuruf_1, 0, 2).substr($acakAngka, 0, 6).substr($acakHuruf_2, 0, 4);
	
	// Generate kode cuci
    $acakHuruf1    = str_shuffle($bHuruf);
    $acakHuruf2    = str_shuffle($bHuruf);
    $acakAngka1      = str_shuffle($bAngka);
	$kode_cuci      = substr($acakHuruf1, 0, 3).substr($acakAngka1, 0, 6).substr($acakHuruf2, 0, 3);
	
	// Generate kode alur
	$bHuruf1         = "QWERTYUIOPLKJHGFDSAZXCVBNMqwertyuiopasdfghjklzxcvbnm";
    $acakHuruf3    = str_shuffle($bHuruf1);
	$kode_alur      = substr($acakHuruf3, 0, 15);
	

?>

<!-- content -->
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title"><?=$title;  ?></h4>
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
						<a href="pengguna.php"><?=$title;  ?></a>
					</li>
				</ul>
			</div>
			<div class="row">

				<div class="col-md-12">
					<div class="card">
						<div class="card-header bg-primary rounded">
							<div class="d-flex align-items-center">
								<h4 class="card-title text-white"><?=$title;  ?></h4>
								<a class="topbar-toggler more mx-5 text-white" id="btn-refresh" title="Refresh Data">
									<i class="fa fa-fw fa-sync-alt" id="ic-refresh"></i>
                                </a>
								<a class="topbar-toggler more ml-auto text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
								<table id="add-row" class="display table table-hover">
									<thead>
										<tr class="thead-light text-center">
											<th scope="col" width="10" >No</th>
											<th scope="col" width="20" >Kode</th>
											<th scope="col" width="120" >Pelanggan</th>
											<th scope="col" width="20">Proses</th>
											<th scope="col" width="200">Waktu</th>
											<th scope="col" width="100" >Total Harga</th>
											<th scope="col" width="20" >Status</th>
											<th scope="col" width="10" >Aksi</th>
										</tr>
									</thead>
									<tbody>
                                        <?php
                                        $no = 1;
                                        if($orderan) :
                                            foreach($orderan as $o) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td class="text-success">
														<a href="detail_orderan.php?id=<?= $o['cuci_id'] ?>"><h4><?= $o['orderan_kd'] ?></h4></a>
													</td>
                                                    <td><?= $o['pelanggan_nama'] ?></td>
                                                    <td class="text-center">
                                                        <?php if($o['orderan_status'] == 'menunggu') : ?>
															<span class="badge badge-secondary mb-1">Menunggu</span> &nbsp;
														<?php elseif($o['orderan_status'] == 'dicuci') : ?>
                                                            <span class="badge badge-primary mb-1">Sedang Cuci</span> &nbsp;
                                                        <?php elseif($o['orderan_status'] == 'selesai') : ?>
															<span class="badge badge-success mb-1">Selesai</span> &nbsp;
														<?php endif; ?>
                                                    </td>
                                                    <td>
                                                        Masuk : <b><?= $o['orderan_masuk'] ?></b> <br>
                                                        Selesai : <b><?= $o['orderan_selesai'] ?></b> <br>
                                                        Diambil : <b><?= $o['orderan_diambil'] ?></b> <br>
													</td>
													<?php 
														// count items
														$cuci_id = $o['cuci_id'];
														$items = ambilsatubaris("SELECT COUNT(tampung_cuci) as jumlah_items FROM tampung WHERE tampung_cuci = $cuci_id");

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
																				WHERE cuci_id = $cuci_id
																				ORDER BY cuci_id DESC");

														// ppn dan total bayar
														$ppn = ($bayar['totalBayar'] * 5)/100;
														$total = $bayar['totalBayar'] + $ppn;

													?>
													<td><?= 'Rp ' .  number_format($total, 0, ".", ",")?></td>
                                                    <td >
														<?php if($o['orderan_pembayaran'] == 'belum') : ?>
                                                            <span class="badge badge-warning mb-1 mt-3">Belum dibayar</span> &nbsp;
														<?php elseif($o['orderan_pembayaran'] == 'selesai') : ?>
                                                            <span class="badge badge-success mb-1 mt-3">Sudah dibayar</span> &nbsp;
														<?php endif; ?>

														<?php if($o['orderan_diambil'] == "0000-00-00 00:00:00") : ?>
                                                            <span class="badge badge-warning mb-1 mt-3">Belum diambil</span> &nbsp;
														<?php elseif($o['orderan_pembayaran'] != "0000-00-00 00:00:00") : ?>
                                                            <span class="badge badge-success mb-1 mt-3">Sudah diambil</span> &nbsp;
														<?php endif; ?>
													</td>
													<td>
                                                        <div class="form-button-action justify-content-center">
															<a href="nota_order.php?id=<?= $o['orderan_id'] ?>" class="btn btn-link btn-primary">
																<i class="fa fa-print"></i>
															</a>
														</div>
                                                    </td>
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
					<h5 class="modal-title" id="tambahLabel">Tambah orderan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="orderan/tambah_orderan.php" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="orderan_kd" class="col-form-label">Kode orderan</label>
							<input type="text" class="form-control" id="orderan_kd" name="orderan_kd" value = "<?= $kode_orderan; ?>" placeholder="Masukan Kode orderan" required="required" readonly="readonly">
							<input type="hidden" class="form-control" id="cuci_kd" name="cuci_kd" value = "<?= $kode_cuci; ?>" placeholder="Masukan Kode orderan" required="required" readonly="readonly">
							<input type="hidden" class="form-control" id="alur_kd" name="alur_kd" value = "<?= $kode_alur; ?>" placeholder="Masukan Kode orderan" required="required" readonly="readonly">
							<input type="hidden" class="form-control" id="operator" name="operator" value = "<?= $_SESSION['nama_user'] ?>" placeholder="Masukan Kode orderan" required="required" readonly="readonly">
						</div>

                        <div class="form-group">
							<label for="orderan_pelanggan" class="col-form-label">Pelanggan</label>
							<select name="orderan_pelanggan" id="orderan_pelanggan" class="custom-select" required="required">
								<option value="" selected disabled>Pilih Pelanggan</option>
								<?php foreach($pelanggan as $p ) : ?>
								<option value="<?= $p['pelanggan_id'] ?>"><?= $p['pelanggan_nama'] ?></option>
								<?php endforeach; ?>
							</select>
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