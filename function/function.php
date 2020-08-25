<?php
date_default_timezone_set('Asia/Jakarta');
// Koneksi ke database
$conn = mysqli_connect('localhost','root','','laundry_app');


function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function ambilsatubaris($query){
	global $conn;
    $db = mysqli_query($conn,$query);
    return mysqli_fetch_assoc($db);
}


// control data pengguna

function tambah_pengguna($data) {
	global $conn;

	$username		= htmlspecialchars($data["username"]);
	$password		= htmlspecialchars(md5($data["password"]));
	$nama_user		= htmlspecialchars($data["nama_user"]);
	$role			= htmlspecialchars($data["role"]);
	$outlet_id		= htmlspecialchars($data["outlet_id"]);

	$query			= "INSERT INTO user 
						VALUES
						('', '$nama_user', '$username', '$password', '$outlet_id', '$role')
					";
	
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function edit_pengguna($data) {
	global $conn;

	$id_user		= $data['id_user'];
	$username		= htmlspecialchars($data["username"]);
	$password		= htmlspecialchars(md5($data["password"]));
	$nama_user		= htmlspecialchars($data["nama_user"]);
	$role			= htmlspecialchars($data["role"]);
	$outlet_id		= htmlspecialchars($data["outlet_id"]);

	if(!$data["password"]) :
	$query			= "UPDATE user SET 
						nama_user	= '$nama_user',
						username	= '$username',
						outlet_id	= '$outlet_id',
						role		= '$role'
					   WHERE 
					    id_user		= '$id_user'

					";
	else : 
	$query			= "UPDATE user SET 
						nama_user	= '$nama_user',
						username	= '$username',
						password	= '$password',
						outlet_id	= '$outlet_id',
						role		= '$role'
					   WHERE 
						id_user		= '$id_user'
					";
	endif;
	
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapus_pengguna($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM user WHERE id_user = $id");
	return mysqli_affected_rows($conn);
}

// control data outlet

function tambah_outlet($data) {
	global $conn;

	$outlet_kd		= htmlspecialchars($data["outlet_kd"]);
	$outlet_nama	= htmlspecialchars($data["outlet_nama"]);
	$outlet_alamat	= htmlspecialchars($data["outlet_alamat"]);
	$outlet_telp	= htmlspecialchars($data["outlet_telp"]);

	$query			= "INSERT INTO outlet 
						VALUES
						('', '$outlet_kd', '$outlet_nama', '$outlet_alamat', '$outlet_telp')
					";
	
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function edit_outlet($data) {
	global $conn;

	$outlet_id		= $data['outlet_id'];
	$outlet_kd		= htmlspecialchars($data["outlet_kd"]);
	$outlet_nama	= htmlspecialchars($data["outlet_nama"]);
	$outlet_alamat	= htmlspecialchars($data["outlet_alamat"]);
	$outlet_telp	= htmlspecialchars($data["outlet_telp"]);

	$query			= "UPDATE outlet SET 
						outlet_kd			= '$outlet_kd',
						outlet_nama			= '$outlet_nama',
						outlet_alamat		= '$outlet_alamat',
						outlet_telp			= '$outlet_telp'
					   WHERE 
					    outlet_id			= '$outlet_id'

					";
	
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapus_outlet($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM outlet WHERE outlet_id = $id");
	return mysqli_affected_rows($conn);
}


// Control data service

function tambah_service($data) {
	global $conn;

	$service_kd		= htmlspecialchars($data["service_kd"]);
	$service_nama	= htmlspecialchars($data["service_nama"]);
	$service_deks	= htmlspecialchars($data["service_deks"]);
	$service_satuan	= htmlspecialchars($data["service_satuan"]);
	$service_harga	= htmlspecialchars($data["service_harga"]);

	$query			= "INSERT INTO service 
						VALUES
						('', '$service_kd', '$service_nama', '$service_deks', '$service_satuan', '$service_harga')
					";
	
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function edit_service($data) {
	global $conn;

	$service_id		= $data['service_id'];
	$service_kd		= htmlspecialchars($data["service_kd"]);
	$service_nama	= htmlspecialchars($data["service_nama"]);
	$service_deks	= htmlspecialchars($data["service_deks"]);
	$service_satuan	= htmlspecialchars($data["service_satuan"]);
	$service_harga	= htmlspecialchars($data["service_harga"]);

	$query			= "UPDATE service SET 
						service_kd			= '$service_kd',
						service_nama		= '$service_nama',
						service_deks		= '$service_deks',
						service_satuan		= '$service_satuan',
						service_harga		= '$service_harga'
					   WHERE 
					    service_id			= '$service_id'

					";
	
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapus_service($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM service WHERE service_id = $id");
	return mysqli_affected_rows($conn);
}

// Control data Pelanggan

function tambah_pelanggan($data) {
	global $conn;

	$pelanggan_kd			= htmlspecialchars($data["pelanggan_kd"]);
	$pelanggan_nama			= htmlspecialchars($data["pelanggan_nama"]);
	$pelanggan_alamat		= htmlspecialchars($data["pelanggan_alamat"]);
	$pelanggan_jk			= htmlspecialchars($data["pelanggan_jk"]);
	$pelanggan_telp			= htmlspecialchars($data["pelanggan_telp"]);

	$query			= "INSERT INTO pelanggan 
						VALUES
						('', '$pelanggan_kd', '$pelanggan_nama', '$pelanggan_alamat', '$pelanggan_jk', '$pelanggan_telp')
					";
	
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function edit_pelanggan($data) {
	global $conn;

	$pelanggan_id		= $data['pelanggan_id'];
	$pelanggan_kd		= htmlspecialchars($data["pelanggan_kd"]);
	$pelanggan_nama		= htmlspecialchars($data["pelanggan_nama"]);
	$pelanggan_alamat	= htmlspecialchars($data["pelanggan_alamat"]);
	$pelanggan_jk		= htmlspecialchars($data["pelanggan_jk"]);
	$pelanggan_telp		= htmlspecialchars($data["pelanggan_telp"]);

	$query			= "UPDATE pelanggan SET 
						pelanggan_kd			= '$pelanggan_kd',
						pelanggan_nama			= '$pelanggan_nama',
						pelanggan_alamat		= '$pelanggan_alamat',
						pelanggan_jk			= '$pelanggan_jk',
						pelanggan_telp			= '$pelanggan_telp'
					   WHERE 
					    pelanggan_id			= '$pelanggan_id'

					";
	
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapus_pelanggan($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM pelanggan WHERE pelanggan_id = $id");
	return mysqli_affected_rows($conn);
}


// Control Orderan

function tambah_orderan($data) {
	global $conn;
	ini_set('date.timezone', 'Asia/Jakarta');

	// orderan
	$orderan_kd			= htmlspecialchars($data["orderan_kd"]);
	$orderan_pelanggan	= htmlspecialchars($data["orderan_pelanggan"]);
	$orderan_masuk		= date("y-m-d G:i:s");
	$orderan_pembayaran	= "belum";
	$orderan_operator	= htmlspecialchars($data["operator"]);
	$orderan_status		= "menunggu";
	$hari_ini			= date("ymd");
	
	// cuci
	$cuci_kd		= htmlspecialchars($data["cuci_kd"]);
	$cuci_order		= htmlspecialchars($data["orderan_kd"]);
	$cuci_totalHarga= 0;
	$cuci_operator	= htmlspecialchars($data["operator"]);
	$cuci_status	= "siap";

	// alur
	$alur_kd		= htmlspecialchars($data["alur_kd"]);

	$query1			= "INSERT INTO orderan 
						VALUES
						('', '$orderan_kd', '$orderan_pelanggan', '$hari_ini', '$orderan_masuk', '', '', '$orderan_pembayaran', '$orderan_operator', '$orderan_status')
					";
	
	$db = mysqli_query($conn, $query1);

	if($db > 0){
		$query2			= "INSERT INTO cuci 
						VALUES
						('', '$cuci_kd', '$cuci_order', '$cuci_operator', '$cuci_status')
					";
	
		mysqli_query($conn, $query2);

		$query3			= "INSERT INTO alur
							VALUES
							('', '$alur_kd', '$orderan_kd', '$orderan_masuk', '$orderan_operator', 'registrasi_cucian', 'Cucian telah diregistrasi')
						";
		mysqli_query($conn, $query3);
	}

	return mysqli_affected_rows($conn);
}

function batal_orderan(){
	global $conn;
	$ido = $_GET['ido'];
	$idc = $_GET['idc'];

	mysqli_query($conn, "DELETE FROM orderan WHERE orderan_id = $ido");
	mysqli_query($conn, "DELETE FROM cuci WHERE cuci_id = $idc");
	
	return mysqli_affected_rows($conn);
}


// Control Cucian

function tambah_item($data) {
	global $conn;
	ini_set('date.timezone', 'Asia/Jakarta');

	$tampung_kd		= htmlspecialchars($data["tampung_kd"]);
	$service_kd		= htmlspecialchars($data["service_kd"]);
	$orderan_kd		= htmlspecialchars($data["orderan_kd"]);
	$tampung_qt		= htmlspecialchars($data["tampung_qt"]);
	$orderan_operator	= htmlspecialchars($data["orderan_operator"]);
	$orderan_masuk	= date("y-m-d G:i:s");
	$orderan_id		= htmlspecialchars($data['orderan_id']);
	$cuci_id		= htmlspecialchars($data["cuci_id"]);
	$alur_kd		= htmlspecialchars($data['alur_kd']);

	$query			= "INSERT INTO tampung 
						VALUES
						('', '$tampung_kd', '$cuci_id', '$service_kd', '$tampung_qt')
					";
	
	$insert = mysqli_query($conn, $query);

	if($insert > 0) :
		$qorderan			= "UPDATE orderan SET 
								orderan_status			= 'dicuci'
					   		   WHERE 
					    		orderan_id				= '$orderan_id'

					";
	
		mysqli_query($conn, $qorderan);

		$qcuci				= "UPDATE cuci SET 
								cuci_status			= 'dicuci'
					           WHERE 
					    		cuci_id				= '$cuci_id'

					";
	
		mysqli_query($conn, $qcuci);

		$query3			= "INSERT INTO alur
							VALUES
							('', '$alur_kd', '$orderan_kd', '$orderan_masuk', '$orderan_operator', 'mulai_cuci', 'Cucian masuk ruang cuci')
						";
		mysqli_query($conn, $query3);
	endif;
	

	return mysqli_affected_rows($conn);
}

function tambah_item1($data) {
	global $conn;

	$tampung_kd		= htmlspecialchars($data["tampung_kd"]);
	$service_kd		= htmlspecialchars($data["service_kd"]);
	$cuci_id		= htmlspecialchars($data["cuci_id"]);
	$tampung_qt		= htmlspecialchars($data["tampung_qt"]);

	$query			= "INSERT INTO tampung 
						VALUES
						('', '$tampung_kd', '$cuci_id', '$service_kd', '$tampung_qt')
					";
	
	$insert = mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function selesai() {
	global $conn;
	ini_set('date.timezone', 'Asia/Jakarta');

	// Generate kode alur
	$bHuruf1         = "QWERTYUIOPLKJHGFDSAZXCVBNMqwertyuiopasdfghjklzxcvbnm";
	$acakHuruf3    	 = str_shuffle($bHuruf1);
	$alur_kd         = substr($acakHuruf3, 0, 15);

	// id dan date
	$idc = $_GET['idc'];
	$ido = $_GET['ido'];
	$okd = $_GET['okd'];
	$op  = $_GET['op'];
	$orderan_masuk	= date("y-m-d G:i:s");

	$query1			= "UPDATE orderan SET 
						orderan_selesai		= '$orderan_masuk',
						orderan_status		= 'selesai'
						WHERE orderan_id 	= '$ido'
					";
	
	$insert1 = mysqli_query($conn, $query1);

	$query2			= "UPDATE cuci SET 
						cuci_status		= 'selesai'
						WHERE cuci_id 	= '$ido'
					";
	
	$insert2 = mysqli_query($conn, $query2);

	$query3			= "INSERT INTO alur
							VALUES
							('', '$alur_kd', '$okd', '$orderan_masuk', '$op', 'cucian_selesai', 'Cucian telah selesai')
						";
	mysqli_query($conn, $query3);

	return mysqli_affected_rows($conn);
}

function diambil() {
	global $conn;
	ini_set('date.timezone', 'Asia/Jakarta');

	// Generate kode alur
	$bHuruf1         = "QWERTYUIOPLKJHGFDSAZXCVBNMqwertyuiopasdfghjklzxcvbnm";
	$acakHuruf3    	 = str_shuffle($bHuruf1);
	$alur_kd         = substr($acakHuruf3, 0, 15);

	// id dan date
	$ido 				= $_GET['ido'];
	$okd 				= $_GET['okd'];
	$op  				= $_GET['op'];
	$orderan_diambil	= date("y-m-d G:i:s");

	$query1			= "UPDATE orderan SET 
						orderan_diambil		= '$orderan_diambil'
						WHERE orderan_id 	= '$ido'
					";
	
	mysqli_query($conn, $query1);

	$alur				= "INSERT INTO alur
							VALUES
							('', '$alur_kd', '$okd', '$orderan_diambil', '$op', 'cucian_diambil', 'Cucian telah diambil Pelanggan')
						";
	mysqli_query($conn, $alur);

	return mysqli_affected_rows($conn);
}

function bayar($data) {
	global $conn;
	ini_set('date.timezone', 'Asia/Jakarta');

	$pembayaran_kd				= htmlspecialchars($data["pembayaran_kd"]);
	$pembayaran_operator		= htmlspecialchars($data["pembayaran_operator"]);
	$alur_kd					= htmlspecialchars($data["alur_kd"]);
	$orderan_kd					= htmlspecialchars($data["orderan_kd"]);
	$orderan_id					= htmlspecialchars($data["orderan_id"]);
	$date						= date("y-m-d G:i:s");
	$date1						= date("y-m-d");
	$pembayaran_total			= htmlspecialchars($data["pembayaran_total"]);
	$pembayaran_final			= htmlspecialchars($data["pembayaran_final"]);
	$bayar						= htmlspecialchars($data["bayar"]);



	$query			= "INSERT INTO pembayaran 
						VALUES
						('', '$pembayaran_kd', '$orderan_kd', '$date1', '$date', '$pembayaran_total', '$pembayaran_final', '$bayar', '$pembayaran_operator')
					";
	
	$insert = mysqli_query($conn, $query);

	if($insert > 0) :
		$qorderan			= "UPDATE orderan SET 
								orderan_pembayaran			= 'selesai'
					   		   WHERE 
					    		orderan_id				= '$orderan_id'

					";
	
		mysqli_query($conn, $qorderan);

		$query3			= "INSERT INTO alur
							VALUES
							('', '$alur_kd', '$orderan_kd', '$date', '$pembayaran_operator', 'pembayaran_selesai', 'Pembayaran telah dilakuan')
						";
		mysqli_query($conn, $query3);
	endif;

	return mysqli_affected_rows($conn);
}



?>