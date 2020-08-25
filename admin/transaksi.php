<?php
	$Title = 'Data Transaksi';
	$title = 'Data Transaksi';
	require 'layout/layout_header.php'; 

	$transaksi = query("SELECT * FROM pembayaran
						INNER JOIN orderan
						ON pembayaran.pembayaran_order = orderan.orderan_kd
						INNER JOIN pelanggan
						ON orderan.orderan_pelanggan = pelanggan.pelanggan_id
						INNER JOIN cuci
						ON orderan.orderan_kd = cuci.cuci_order
						ORDER BY pembayaran_id DESC
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
								<a href="#cetak" class="topbar-toggler more ml-auto text-white collapsed" data-toggle="collapse" aria-expanded="false">
									<i class="flaticon-down-arrow-1"></i>
								</a>
							</div>
						</div>
						<div class="card-body">
							<form action="cetak_transaksi.php" method="GET" class="row collapse" id="cetak">
								<div class="input-group mb-4">
									<div class="col-lg-6">
										<div class="input-group">
											<input value="" type="date" name="tgl_awal" id="tgl_awal" class="form-control">
											<input value="<?= $_SESSION['nama_user'] ?>" type="hidden" name="nama" id="nama" class="form-control">
											<div class="input-group-prepend">
												<span class="input-group-text">s/d</span>
											</div>
											<input value="" type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
											<div class="input-group-prepend">
												<button name="cari" id="cari" class="btn btn-primary">Cetak</button>
											</div>
										</div>
									</div>
								</div>
							</form>
							<div class="table-responsive">
								<table id="add-row" class="display table">
									<thead>
										<tr class="thead-light text-center">
											<th scope="col" width="10" >No</th>
											<th scope="col" width="100" >Kode Transaksi</th>
											<th scope="col" width="250">Pelanggan</th>
											<th scope="col" width="250" >Waktu Transaksi</th>
											<th scope="col" width="100" >Total Harga</th>
											<th scope="col" width="20" >Aksi</th>
											<!-- <th scope="col">Action</th> -->
										</tr>
									</thead>
									<tbody>
                                        <?php
                                        $no = 1;
                                        if($transaksi) :
                                            foreach($transaksi as $t) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td class="text-success">
                                                        <a class="h4" href="detail_transaksi.php?id=<?= $t['pembayaran_id'] ?>&idc=<?= $t['cuci_id'] ?>"><?= $t['pembayaran_kd'] ?></a>
                                                    </td>
                                                    <td><?= $t['pelanggan_nama'] ?></td>
                                                    <td><?= date('l, d F Y G:i:s', strtotime($t['pembayaran_waktu'])) ?></td>
                                                    <td><?= 'Rp ' .  number_format($t['pembayaran_final'], 0, ".", ",")?></td>
                                                    <td>
                                                        <div class="form-button-action justify-content-center">
															<a href="print.php?id=<?= $t['pembayaran_id'] ?>&idc=<?= $t['cuci_id'] ?>" class="btn btn-link btn-primary">
																<i class="fa fa-print"></i>
															</a>
														</div>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                        else : ?>
                                            <tr>
												<td colspan="5" class="text-center">Silahkan tambahkan transaksi baru</td>
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