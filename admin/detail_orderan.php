
<?php
    $title = 'Data Orderan';
    $stitle = 'Detail Orderan';
	require 'layout/layout_header.php'; 

	$id = $_GET['id'];
	$orderan = query("SELECT * FROM orderan 
					  INNER JOIN pelanggan 
					  ON orderan.orderan_pelanggan = pelanggan.pelanggan_id 
					  INNER JOIN cuci
					  ON orderan.orderan_kd = cuci.cuci_order
					--   INNER JOIN alur
					--   ON orderan.orderan_kd = alur.alur_order
					  WHERE orderan_id = $id
					  ORDER BY orderan_id DESC
					");

	$alur	= query("SELECT * FROM alur
					 INNER JOIN orderan
					 ON alur.alur_order = orderan.orderan_kd
					 WHERE orderan_id = $id");
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
								<h4 class="card-title mx-2"><b>Orderan <?= $o['orderan_kd'];  ?></b></h4>
                                </a>
							</div>
						</div>
						<div class="card-body">
							<table class="table">
								<tr>
									<th width="150">Pelanggan</th>
									<td>: <?= $o['pelanggan_nama'] ?></td>
								</tr>
								<tr>
									<th width="150">Waktu Order</th>
									<td>: <?= $o['orderan_masuk'] ?></td>
								</tr>
								<tr>
									<th width="150">Status Cucian</th>
									<?php if($o['orderan_status'] == "menunggu") : ?>
									<td>: Menunggu - Cucian masih dalam antrian</td>
									<?php elseif($o['orderan_status'] == "dicuci") : ?>
									<td>: Sedang dicuci - Cucian sedang berada di ruang cuci</td>
									<?php elseif($o['orderan_status'] == "selesai") : ?>
									<td>: Selesai - Cucian sudah selesai</td>
									<?php elseif($o['orderan_status'] == "selesai" && $o['orderan_diambil'] != "0000-00-00 00:00:00") : ?>
									<td>: Selesai dan diambil - Cucian sudah selesai dan diambil oleh pelanggan</td>
									<?php endif; ?>
								</tr>
								<?php if($o['orderan_status'] == "menunggu") : ?>
								<tr>
									<th width="150">Status Pembayaran</th>
									<td>: -</td>
								</tr>
								<tr>
									<th width="150">Status Pengambilan</th>
									<td>: -</td>
								</tr>
								<?php else: ?>
								<tr>
									<th width="150">Status Pembayaran</th>
									<?php if($o['orderan_pembayaran'] == "belum") : ?>
									<td>: Belum dibayar</td>
									<?php elseif($o['orderan_pembayaran'] == "selesai") : ?>
									<td>: Sudah dibayar</td>
									<?php endif; ?>
								</tr>
								<tr>
									<th width="150">Status Pengambilan</th>
									<?php if($o['orderan_diambil'] == "0000-00-00 00:00:00") : ?>
									<td>: Belum diambil</td>
									<?php elseif($o['orderan_diambil'] != "0000-00-00 00:00:00") : ?>
									<td>: Sudah diambil</td>
									<?php endif; ?>
								</tr>
								<?php endif; ?>
							</table>
							
							<div class="row justify-content-center">
								<a class="btn btn-success mx-3 my-2 <?= $o['orderan_pembayaran'] == 'selesai' ||$o['orderan_status'] != 'selesai' || $o['orderan_status'] == 'menunggu' ? 'disabled' : '' ?>" href="bayar.php?id=<?= $o['cuci_id'] ?>" >
                               		<i class="fa fa-money-bill-alt">  Bayar</i>
                                </a>
								<a onclick="return confirm('Yakin set diambil?')" class="btn btn-success mx-3 my-2 <?= $o['orderan_pembayaran'] == 'belum' || $o['orderan_status'] != 'selesai' || $o['orderan_diambil'] != '0000-00-00 00:00:00'  ? 'disabled' : '' ?>" href="cuci/set_diambil.php?ido=<?= $o['orderan_id'] ?>&okd=<?= $o['orderan_kd'] ?>&op=<?= $_SESSION['nama_user'] ?>" >
                               		<i class="fa fa-check-circle">  Set diambil</i>
                                </a>
								<a class="btn btn-success mx-3 my-2 <?= $o['orderan_status'] == 'selesai' ? 'disabled' : '' ?>" href="room_cuci.php?id=<?= $o['orderan_id'] ?>" disabled >
                               		<i class="fa fa-tshirt">  Ruang cuci</i>
                                </a>
							</div>
							<div class="row justify-content-center">
								<a onclick="return confirm('Yakin ingin membatalkan orderan?')" class="btn btn-warning mx-3 my-2 <?= $o['orderan_status'] == 'dicuci' || $o['orderan_status'] == 'selesai' ? 'disabled' : '' ?>" href="orderan/batal_orderan.php?ido=<?= $o['orderan_id'] ?>&idc=<?= $o['cuci_id'] ?>" >
                               		<i class="fa fa-trash">  Batal order</i>
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
								<h4 class="card-title"><b>Timeline Cucian</b></h4>
                                </a>
							</div>
						</div>
						<div class="card-body">
							<ol class="activity-feed mx-5 mb-5">
								<?php foreach($alur as $a ) : ?>
								<li class="feed-item feed-item-secondary ">
									<time class="date" datetime="9-25"><?= date('l, d F Y G:i:s', strtotime($a['alur_waktu'])) ?> - <?= $a['alur_operator'] ?></time>
									<span class="text"><?= $a['alur_caption'] ?></span>
								</li>
								<?php endforeach; ?>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php require 'layout/layout_footer.php'; ?>