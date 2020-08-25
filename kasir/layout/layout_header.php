<?php 
session_start();

if($_SESSION){
    if($_SESSION['role'] == 'Kasir'){
		
    }else{
        header('location:../index.php');
    }
}else{
    header('location:../index.php');
}

require '../function/function.php';

$nama = $_SESSION['nama_user'];
$role = $_SESSION['role'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?= $title; ?></title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" type="image/png" sizes="16x16" href="../assets/img/icon/icon.png">

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>
<body>
	<div class="wrapper sidebar_minimize">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="index.html" class="logo">
                    <img src="../assets/img/icon/icon.png" style="width: 50px; padding-bottom: 5px;" alt="navbar brand" class="navbar-brand">
                    <h3 alt="navbar brand" class="navbar-brand mt-1 mb-1 mx-3" style="color:white; letter-spacing: 1px; font-family: Verdana, Geneva, Tahoma, sans-serif;">Laundry</h3>
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				
				<!-- <div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
                                    <img src="../assets/img/profile/default.png" alt="..." class="avatar-img rounded-circle">
                                </div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="../assets/img/profile/default.png" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?= $nama; ?></h4>
												<p class="text-muted"><?= $role; ?></p>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Profil</a>
										<a class="dropdown-item" href="#">Pengaturan</a>
										<a class="dropdown-item" href="logout.php" onclick="return confirm('Yakin ingin keluar? ');" >Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div> -->
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="../assets/img/profile/default.png" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" aria-expanded="true">
								<span>
									<?=$nama;?>
									<span class="user-level"><?= $role; ?></span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<!-- <div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div> -->
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($title=='Dashboard'){echo 'active';} ?>">
							<a href="index.php">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>

						<li class="nav-item <?php if($title=='Data Orderan'){echo 'active';} ?>">
							<a href="orderan.php">
								<i class="fas fa-credit-card"></i>
								<p>Data Order</p>
							</a>
						</li>

						<li class="nav-item <?php if($title=='Data Cuci'){echo 'active';} ?>">
							<a href="Cuci.php">
								<i class="fas fa-recycle"></i>
								<p>Data Cuci</p>
							</a>
						</li>

						<li class="nav-item <?php if($title=='Data Transaksi'){echo 'active';} ?>">
							<a href="transaksi.php">
								<i class="fas fa-calculator"></i>
								<p>Data Transaksi</p>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="logout.php" onclick="return confirm('Yakin ingin keluar? ');">
								<i class="fas fa-sign-out-alt"></i>
								<p>Logout</p>
							</a>
						</li>

					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->