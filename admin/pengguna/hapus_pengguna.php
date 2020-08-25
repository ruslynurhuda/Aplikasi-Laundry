<?php 
require '../../function/function.php';
$id = $_GET["id"];
$cari   = query("SELECT * FROM user WHERE id_user = " . $id);

if(hapus_pengguna($id) > 0 ){
	$icon   = 'flaticon-success';
    $title  = 'Berhasil';
    foreach($cari as $c ) :
    $msg    = 'Anda telah menghapus akun '.$c['nama_user'].'!';
    endforeach;
    $type   = 'success';
    header('location: ../pengguna.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
}else{
    $icon   = 'flaticon-error';
    $title  = 'Gagal';
    foreach($cari as $c ) :
    $msg    = 'Anda gagal menghapus akun '. $c['nama_user'].'!';
    endforeach;
    $type   = 'danger';
    header('location: ../pengguna.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
}
 ?>

