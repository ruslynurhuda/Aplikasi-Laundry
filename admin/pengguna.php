<?php
	$Title = 'Data Master';
    $title = 'Data Pengguna';
    require 'layout/layout_header.php'; 

    // Queri data pengguna
	$pengguna = query("SELECT * FROM user INNER JOIN outlet ON outlet.outlet_id = user.outlet_id");
	$outlet = query("SELECT * FROM outlet");

?>


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
											<th scope="col" width="250" >Nama</th>
											<th scope="col" >Outlet</th>
											<th scope="col" width="150" >Role</th>
											<th scope="col" width="20" >Aksi</th>
											<!-- <th scope="col">Action</th> -->
										</tr>
									</thead>
									<tbody>
                                        <?php
                                        $no = 1;
                                        if($pengguna) :
                                            foreach($pengguna as $p) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $p['nama_user'] ?></td>
                                                    <td><?= $p['outlet_nama'] ?></td>
                                                    <td class="text-center">
                                                        <?php if($p['role'] == 'Admin') : ?>
															<span class="badge badge-success mb-1"><?= $p['role'] ?></span> &nbsp;
														<?php elseif($p['role'] == 'Kasir') : ?>
                                                            <span class="badge badge-secondary mb-1"><?= $p['role'] ?></span> &nbsp;
                                                        <?php elseif($p['role'] == 'Owner') : ?>
															<span class="badge badge-primary mb-1"><?= $p['role'] ?></span> &nbsp;
														<?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-button-action justify-content-center">
															<a href="#" data-toggle="modal" data-target="#edit<?= $p['id_user'] ?>" class="btn btn-link btn-primary">
																<i class="fa fa-edit"></i>
															</a>
															<a onclick="return confirm('Yakin ingin hapus?')"  href="pengguna/hapus_pengguna.php?id=<?= $p['id_user'] ?>" data-toggle="tooltip" title="" class="btn btn-link btn-danger">
																<i class="fa fa-times"></i>
															</a>
														</div>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                        else : ?>
                                            <tr>
												<td colspan="5" class="text-center">Silahkan tambahkan pengguna baru</td>
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
					<h5 class="modal-title" id="tambahLabel">Tambah Pengguna</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="pengguna/tambah_pengguna.php" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="username" class="col-form-label">Username</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username" required="required">
						</div>

						<div class="form-group">
							<label for="password" class="col-form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Masukan password" required="required">
						</div>

						<div class="form-group">
							<label for="nama_user" class="col-form-label">Nama</label>
							<input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Masukan nama" required="required">
						</div>

						<div class="form-group">
							<label for="role" class="col-form-label">Role</label>
							<select name="role" id="role" class="custom-select" required="required">
								<option value="" selected disabled>Pilih Role</option>
								<option value="Kasir">Kasir</option>
								<option value="Owner">Owner</option>
							</select>
						</div>

						<div class="form-group">
							<label for="outlet_id" class="col-form-label">Outlet</label>
							<select name="outlet_id" id="outlet_id" class="custom-select" required="required">
								<option value="" selected disabled>Pilih Outlet</option>
								<?php foreach($outlet as $o ) : ?>
									<option value="<?= $o['outlet_id'] ?>"><?= $o['outlet_nama'] ?></option>
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
	
	<?php foreach($pengguna as $p ) : ?>
	<div class="modal fade" id="edit<?= $p['id_user'] ?>" tabindex="-1" aria-labelledby="edit<?= $p['id_user'] ?>Label" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-white bg-primary">
					<h5 class="modal-title" id="edit<?= $p['id_user'] ?>Label">Tambah Pengguna</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="pengguna/edit_pengguna.php?id=<?= $p['id_user'] ?>" method="POST">
					<div class="modal-body">
						<input type="hidden" name="id_user" value="<?= $p["id_user"]; ?>">
						<div class="form-group">
							<label for="username" class="col-form-label">Username</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username" required="required" value="<?= $p['username'] ?>">
						</div>

						<div class="form-group">
							<label for="password" class="col-form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Masukan password" >
						</div>

						<div class="form-group">
							<label for="nama_user" class="col-form-label">Nama</label>
							<input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Masukan nama" required="required" value="<?= $p['nama_user'] ?>">
						</div>

						<div class="form-group">
							<label for="role" class="col-form-label">Role</label>
							<select name="role" id="role" class="custom-select" required="required">
								<option value="" selected disabled>Pilih Role</option>
								<option <?= $p['role'] == 'Kasir' ? 'selected' : ''; ?> value="Kasir">Kasir</option>
								<option <?= $p['role'] == 'Owner' ? 'selected' : ''; ?> value="Owner">Owner</option>
							</select>
						</div>

						<div class="form-group">
							<label for="outlet_id" class="col-form-label">Outlet</label>
							<select name="outlet_id" id="outlet_id" class="custom-select" required="required">
								<option value="" selected disabled>Pilih Outlet</option>
								<?php foreach($outlet as $o ) : ?>
									<option <?= $p['outlet_id'] == $o['outlet_id']  ? 'selected' : ''; ?> value="<?= $o['outlet_id'] ?>"><?= $o['outlet_nama'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" name="edit" id="alert" class="btn btn-primary">Tambah</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php endforeach; ?>

<?php require 'layout/layout_footer.php'; ?>