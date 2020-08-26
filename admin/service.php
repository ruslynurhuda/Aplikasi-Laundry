<?php
	$Title = 'Data Master';
    $title = 'Data Service';
    require 'layout/layout_header.php'; 

    $service = query("SELECT * FROM service");
    
    // Generate kode service
    $bHuruf         = "QWERTYUIOPLKJHGFDSAZXCVBNM";
    $bAngka         = "1234567890";
    $acakHuruf_1    = str_shuffle($bHuruf);
    $acakHuruf_2    = str_shuffle($bHuruf);
    $acakAngka      = str_shuffle($bAngka);
    $kode_service   = substr($acakHuruf_1, 0, 2).substr($acakAngka, 0, 3);

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
											<th scope="col" width="100" >Kode</th>
											<th scope="col" width="250">Nama</th>
											<th scope="col" width="250">Deks</th>
											<th scope="col" width="100" >Harga/satuan</th>
											<th scope="col" width="100" >Total transaksi</th>
											<th scope="col" width="20" >Aksi</th>
										</tr>
									</thead>
									<tbody>
                                        <?php
                                        $no = 1;
                                        if($service) :
                                            foreach($service as $s) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $s['service_kd'] ?></td>
                                                    <td><?= $s['service_nama'] ?></td>
                                                    <td><?= $s['service_deks'] ?></td>
                                                    <td><?= 'Rp ' .  number_format($s['service_harga'], 0, ".", ",") .'/' . $s['service_satuan'] ?></td>
													<?php $kd = $s['service_kd'] ?>
    												<?php $tot = ambilsatubaris("SELECT COUNT(tampung_service) as jumlah_service FROM tampung WHERE tampung_service = '$kd' ") ?>

													<td class="text-center"><?= $tot['jumlah_service'] ?></td>
                                                    <td>
                                                        <div class="form-button-action justify-content-center">
															<a href="#" data-toggle="modal" data-target="#edit<?= $s['service_id'] ?>" class="btn btn-link btn-primary">
																<i class="fa fa-edit"></i>
															</a>
															<a onclick="return confirm('Yakin ingin hapus?')"  href="service/hapus_service.php?id=<?= $s['service_id'] ?>" data-toggle="tooltip" title="" class="btn btn-link btn-danger">
																<i class="fa fa-times"></i>
															</a>
														</div>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                        else : ?>
                                            <tr>
												<td colspan="5" class="text-center">Silahkan tambahkan Service baru</td>
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
					<h5 class="modal-title" id="tambahLabel">Tambah service</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="service/tambah_service.php" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="service_kd" class="col-form-label">Kode service</label>
							<input type="text" class="form-control" id="service_kd" name="service_kd" value = "<?= $kode_service; ?>" placeholder="Masukan Kode service" required="required" readonly="readonly">
						</div>

                        <div class="form-group">
							<label for="service_nama" class="col-form-label">Nama Service</label>
							<input type="text" class="form-control" id="service_nama" name="service_nama" placeholder="Masukan Nama service" required="required">
						</div>

                        <div class="form-group">
							<label for="service_deks" class="col-form-label">Deks</label>
							<input type="text" class="form-control" id="service_deks" name="service_deks" placeholder="Masukan deks service" required="required">
						</div>

                        <div class="form-group">
							<label for="service_satuan" class="col-form-label">Satuan</label>
							<input type="text" class="form-control" id="service_satuan" name="service_satuan" placeholder="Masukan Satuan service" required="required">
						</div>

                        <div class="form-group">
							<label for="service_harga" class="col-form-label">Harga</label>
							<input type="number" class="form-control" id="service_harga" name="service_harga" placeholder="Masukan Satuan service" required="required">
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
	
	<?php foreach($service as $s ) : ?>
	<div class="modal fade" id="edit<?= $s['service_id'] ?>" tabindex="-1" aria-labelledby="edit<?= $s['service_id'] ?>Label" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-white bg-primary">
					<h5 class="modal-title" id="edit<?= $s['service_id'] ?>Label">Tambah Pengguna</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="service/edit_service.php?id=<?= $s['service_id'] ?>" method="POST">
					<div class="modal-body">
						<input type="hidden" name="service_id" value="<?= $s["service_id"]; ?>">
						<div class="form-group">
							<label for="service_kd" class="col-form-label">Kode service</label>
							<input type="text" class="form-control" id="service_kd" name="service_kd" value = "<?= $s['service_kd'] ?>" placeholder="Masukan Kode service" required="required" readonly="readonly">
						</div>

                        <div class="form-group">
							<label for="service_nama" class="col-form-label">Nama Service</label>
							<input type="text" class="form-control" id="service_nama" name="service_nama" placeholder="Masukan Nama service" required="required" value = "<?= $s['service_nama'] ?>">
						</div>

                        <div class="form-group">
							<label for="service_deks" class="col-form-label">Deks</label>
							<input type="text" class="form-control" id="service_deks" name="service_deks" placeholder="Masukan deks service" required="required" value = "<?= $s['service_deks'] ?>">
						</div>

                        <div class="form-group">
							<label for="service_satuan" class="col-form-label">Satuan</label>
							<input type="text" class="form-control" id="service_satuan" name="service_satuan" placeholder="Masukan Satuan service" required="required" value = "<?= $s['service_satuan'] ?>">
						</div>

                        <div class="form-group">
							<label for="service_harga" class="col-form-label">Harga</label>
							<input type="number" class="form-control" id="service_harga" name="service_harga" placeholder="Masukan Satuan service" required="required" value = "<?= $s['service_harga'] ?>">
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" name="edit" id="alert" class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php endforeach; ?>

<?php require 'layout/layout_footer.php'; ?>