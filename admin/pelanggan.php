<?php
	$Title = 'Data Master';
    $title = 'Data Pelanggan';
    require 'layout/layout_header.php'; 

	$pelanggan = query("SELECT * FROM pelanggan");
	$orderan   = query("SELECT * FROM orderan");
    
    // Generate kode pelanggan
    $bAngka         = "1234567890";
    $acakAngka      = str_shuffle($bAngka);
    $kode_pelanggan    = "000".substr($acakAngka, 0, 7);

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
											<th scope="col" width="100" >Total Cuci</th>
											<th scope="col" width="20" >Aksi</th>
											<!-- <th scope="col">Action</th> -->
										</tr>
									</thead>
									<tbody>
                                        <?php
                                        $no = 1;
                                        if($pelanggan) :
                                            foreach($pelanggan as $p) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td class="text-success">
														<a href="detail_pelanggan.php?id=<?= $p['pelanggan_id'] ?>"><h4><?= $p['pelanggan_kd'] ?></h4></a>
													</td>
                                                    <td><?= $p['pelanggan_nama'] ?></td>

													<?php $idp = $p['pelanggan_id'] ?>
													<?php $cuci = ambilsatubaris("SELECT COUNT(orderan_pelanggan) as jumlah_cuci FROM orderan WHERE orderan_pelanggan = '$idp' ") ?>
                                                    <td class="text-center"><?= $cuci['jumlah_cuci'] ?> x</td>
                                                    <td class="text-center">
                                                        <div class="form-button-action justify-content-center">
															<a href="#" data-toggle="modal" data-target="#edit<?= $p['pelanggan_id'] ?>" class="btn btn-link btn-primary">
																<i class="fa fa-edit"></i>
															</a>
															<a onclick="return confirm('Yakin ingin hapus?')"  href="pelanggan/hapus_pelanggan.php?id=<?= $p['pelanggan_id'] ?>" data-toggle="tooltip" title="" class="btn btn-link btn-danger">
																<i class="fa fa-times"></i>
															</a>
														</div>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                        else : ?>
                                            <tr>
												<td colspan="5" class="text-center">Silahkan tambahkan pelanggan baru</td>
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
					<h5 class="modal-title" id="tambahLabel">Tambah pelanggan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="pelanggan/tambah_pelanggan.php" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="pelanggan_kd" class="col-form-label">Kode pelanggan</label>
							<input type="text" class="form-control" id="pelanggan_kd" name="pelanggan_kd" value = "<?= $kode_pelanggan; ?>" placeholder="Masukan Kode pelanggan" required="required" readonly="readonly">
						</div>

                        <div class="form-group">
							<label for="pelanggan_nama" class="col-form-label">Nama</label>
							<input type="text" class="form-control" id="pelanggan_nama" name="pelanggan_nama" placeholder="Masukan Nama pelanggan" required="required">
						</div>

                        <div class="form-group">
							<label for="pelanggan_alamat" class="col-form-label">Alamat</label>
							<input type="text" class="form-control" id="pelanggan_alamat" name="pelanggan_alamat" placeholder="Masukan Alamat pelanggan" required="required">
						</div>

                        <div class="form-group">
							<label for="pelanggan_jk" class="col-form-label">Jenis Kelamin</label>
							<select name="pelanggan_jk" id="pelanggan_jk" class="custom-select" required="required">
								<option value="" selected disabled>Pilih Jenis Kelamin</option>
								<option value="Laki - Laki">Laki - Laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
						</div>

                        <div class="form-group">
							<label for="pelanggan_telp" class="col-form-label">No. Telp</label>
							<input type="text" class="form-control" id="pelanggan_telp" name="pelanggan_telp" placeholder="Masukan Nomor Telphon pelanggan" required="required">
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
	
	<?php foreach($pelanggan as $p ) : ?>
	<div class="modal fade" id="edit<?= $p['pelanggan_id'] ?>" tabindex="-1" aria-labelledby="edit<?= $p['pelanggan_id'] ?>Label" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-white bg-primary">
					<h5 class="modal-title" id="edit<?= $p['pelanggan_id'] ?>Label">Tambah Pengguna</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="pelanggan/edit_pelanggan.php?id=<?= $p['pelanggan_id'] ?>" method="POST">
					<div class="modal-body">
						<input type="hidden" name="pelanggan_id" value="<?= $p["pelanggan_id"]; ?>">
						<div class="form-group">
							<label for="pelanggan_kd" class="col-form-label">Kode pelanggan</label>
							<input type="text" class="form-control" id="pelanggan_kd" name="pelanggan_kd" value = "<?= $p['pelanggan_kd'] ?>" placeholder="Masukan Kode pelanggan" required="required" readonly="readonly">
						</div>

                        <div class="form-group">
							<label for="pelanggan_nama" class="col-form-label">Nama</label>
							<input type="text" class="form-control" id="pelanggan_nama" name="pelanggan_nama" placeholder="Masukan Nama pelanggan" required="required" value = "<?= $p['pelanggan_nama'] ?>">
						</div>

                        <div class="form-group">
							<label for="pelanggan_alamat" class="col-form-label">Alamat</label>
							<input type="text" class="form-control" id="pelanggan_alamat" name="pelanggan_alamat" placeholder="Masukan Alamat pelanggan" required="required" value = "<?= $p['pelanggan_alamat'] ?>">
						</div>

                        <div class="form-group">
							<label for="pelanggan_jk" class="col-form-label">Jenis Kelamin</label>
							<select name="pelanggan_jk" id="pelanggan_jk" class="custom-select" required="required">
								<option value="" selected disabled>Pilih Jenis Kelamin</option>
								<option <?= $p['pelanggan_jk'] == 'Laki - Laki' ? 'selected' : ''; ?> value="Laki - Laki">Laki - Laki</option>
								<option <?= $p['pelanggan_jk'] == 'Perempuan' ? 'selected' : ''; ?> value="Perempuan">Perempuan</option>
							</select>
						</div>

                        <div class="form-group">
							<label for="pelanggan_telp" class="col-form-label">No. Telp</label>
							<input type="text" class="form-control" id="pelanggan_telp" name="pelanggan_telp" placeholder="Masukan Nomor Telphon pelanggan" required="required" value = "<?= $p['pelanggan_telp'] ?>">
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