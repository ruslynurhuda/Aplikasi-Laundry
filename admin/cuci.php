<?php
    $title = 'Data Cuci';
    require 'layout/layout_header.php'; 

	$cuci = query("SELECT * FROM orderan 
					  INNER JOIN pelanggan 
					  ON orderan.orderan_pelanggan = pelanggan.pelanggan_id 
					  INNER JOIN cuci
					  ON orderan.orderan_kd = cuci.cuci_order
					--   INNER JOIN alur
					--   ON orderan.orderan_kd = alur.alur_order
					  WHERE cuci_status != 'selesai'
					  ORDER BY cuci_id DESC
                    ");
	
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
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="add-row" class="display table table-hover">
									<thead>
										<tr class="thead-light text-center">
											<th scope="col" width="10" >No</th>
											<th scope="col" width="20" >Kode Order</th>
											<th scope="col" width="120" >Pelanggan</th>
											<th scope="col" width="150">Waktu Masuk</th>
											<th scope="col" width="20">Item</th>
											<th scope="col" width="100" >Total Harga</th>
                                            <th scope="col" width="20" >Status</th>
											<th scope="col" width="10" >Aksi</th>
										</tr>
									</thead>
									<tbody>
                                        <?php
                                        $no = 1;
                                        if($cuci) :
                                            foreach($cuci as $c) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td class="text-success">
														<a href="room_cuci.php?id=<?= $c['cuci_id'] ?>"><h4><?= $c['orderan_kd'] ?></h4></a>
													</td>
                                                    <td><?= $c['pelanggan_nama'] ?></td>
                                                    <td>
                                                        <b><?= $c['orderan_masuk'] ?></b> <br>
													</td>
													<?php 
														// count items
														$cuci_id = $c['cuci_id'];
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
                                                    <td><?= $items['jumlah_items'] ?></td>
													<td><?= 'Rp ' .  number_format($total, 0, ".", ",")?></td>
                                                    <td class="text-center">
                                                        <?php if($c['cuci_status'] == 'siap') : ?>
															<span class="badge badge-secondary my-2">Siap</span> &nbsp;
														<?php elseif($c['cuci_status'] == 'dicuci') : ?>
                                                            <span class="badge badge-secondary my-2">Sedang dicuci</span> &nbsp;
                                                        <?php elseif($c['cuci_status'] == 'selesai') : ?>
															<span class="badge badge-primary my-2">Selesai</span> &nbsp;
														<?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-button-action justify-content-center">
                                                            <a class="btn btn-success btn-sm" href="cuci/set_selesai.php?idc=<?= $c['cuci_id']; ?>&ido=<?= $c['orderan_id'] ?>&okd=<?= $c['orderan_kd'] ?>&op=<?= $_SESSION['nama_user'] ?>" >
                                                                <i class="fa fa-check-circle">  Set selesai</i>
                                                            </a>
														</div>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                        else : ?>
                                            <tr>
												<td colspan="8" class="text-center">Silahkan tambahkan cuci baru</td>
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

<?php require 'layout/layout_footer.php'; ?>