<?php
	$Title = 'Data Master';
	$title = 'Data Outlet';
    require 'layout/layout_header.php'; 

    $outlet = query("SELECT * FROM outlet");
    
    // Generate kode outlet
    $bHuruf         = "QWERTYUIOPLKJHGFDSAZXCVBNM";
    $bAngka         = "1234567890";
    $acakHuruf_1    = str_shuffle($bHuruf);
    $acakHuruf_2    = str_shuffle($bHuruf);
    $acakAngka      = str_shuffle($bAngka);
    $kode_outlet    = substr($acakHuruf_1, 0, 2).substr($acakAngka, 0, 7).substr($acakHuruf_2, 0, 3);

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
											<th scope="col" width="250" >Alamat</th>
											<th scope="col" width="100" >No. Telp</th>
											<th scope="col" width="20" >Aksi</th>
											<!-- <th scope="col">Action</th> -->
										</tr>
									</thead>
									<tbody>
                                        <?php
                                        $no = 1;
                                        if($outlet) :
                                            foreach($outlet as $o) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $o['outlet_kd'] ?></td>
                                                    <td><?= $o['outlet_nama'] ?></td>
                                                    <td><?= $o['outlet_alamat'] ?></td>
                                                    <td><?= $o['outlet_telp'] ?></td>
                                                    <td>
                                                        <div class="form-button-action justify-content-center">
															<a href="#" data-toggle="modal" data-target="#edit<?= $o['outlet_id'] ?>" class="btn btn-link btn-primary">
																<i class="fa fa-edit"></i>
															</a>
															<a onclick="return confirm('Yakin ingin hapus?')"  href="outlet/hapus_outlet.php?id=<?= $o['outlet_id'] ?>" data-toggle="tooltip" title="" class="btn btn-link btn-danger">
																<i class="fa fa-times"></i>
															</a>
														</div>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                        else : ?>
                                            <tr>
												<td colspan="5" class="text-center">Silahkan tambahkan Outlet baru</td>
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
					<h5 class="modal-title" id="tambahLabel">Tambah Outlet</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="outlet/tambah_outlet.php" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="outlet_kd" class="col-form-label">Kode Outlet</label>
							<input type="text" class="form-control" id="outlet_kd" name="outlet_kd" value = "<?= $kode_outlet; ?>" placeholder="Masukan Kode Outlet" required="required" readonly="readonly">
						</div>

                        <div class="form-group">
							<label for="outlet_nama" class="col-form-label">Nama</label>
							<input type="text" class="form-control" id="outlet_nama" name="outlet_nama" placeholder="Masukan Nama Outlet" required="required">
						</div>

                        <div class="form-group">
							<label for="outlet_alamat" class="col-form-label">Alamat</label>
							<input type="text" class="form-control" id="outlet_alamat" name="outlet_alamat" placeholder="Masukan Alamat Outlet" required="required">
						</div>

                        <div class="form-group">
							<label for="outlet_telp" class="col-form-label">No. Telp</label>
							<input type="text" class="form-control" id="outlet_telp" name="outlet_telp" placeholder="Masukan Nomor Telphon Outlet" required="required">
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
	
	<?php foreach($outlet as $o ) : ?>
	<div class="modal fade" id="edit<?= $o['outlet_id'] ?>" tabindex="-1" aria-labelledby="edit<?= $o['outlet_id'] ?>Label" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-white bg-primary">
					<h5 class="modal-title" id="edit<?= $o['outlet_id'] ?>Label">Edit Outlet</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="outlet/edit_outlet.php?id=<?= $o['outlet_id'] ?>" method="POST">
					<div class="modal-body">
						<input type="hidden" name="outlet_id" value="<?= $o["outlet_id"]; ?>">
						<div class="form-group">
							<label for="outlet_kd" class="col-form-label">Kode Outlet</label>
							<input type="text" class="form-control" id="outlet_kd" name="outlet_kd" value = "<?= $o['outlet_kd'] ?>" placeholder="Masukan Kode Outlet" required="required" readonly="readonly">
						</div>

                        <div class="form-group">
							<label for="outlet_nama" class="col-form-label">Nama</label>
							<input type="text" class="form-control" id="outlet_nama" name="outlet_nama" placeholder="Masukan Nama Outlet" required="required" value = "<?= $o['outlet_nama'] ?>">
						</div>

                        <div class="form-group">
							<label for="outlet_alamat" class="col-form-label">Alamat</label>
							<input type="text" class="form-control" id="outlet_alamat" name="outlet_alamat" placeholder="Masukan Alamat Outlet" required="required" value = "<?= $o['outlet_alamat'] ?>">
						</div>

                        <div class="form-group">
							<label for="outlet_telp" class="col-form-label">No. Telp</label>
							<input type="text" class="form-control" id="outlet_telp" name="outlet_telp" placeholder="Masukan Nomor Telphon Outlet" required="required" value = "<?= $o['outlet_telp'] ?>">
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