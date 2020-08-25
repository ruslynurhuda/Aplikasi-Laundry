<?php 
require '../../function/function.php';
$id = $_GET["id"];
$cari   = query("SELECT * FROM pelanggan WHERE pelanggan_id = " . $id);

if(hapus_pelanggan($id) > 0 ){
	$icon   = 'flaticon-success';
    $title  = 'Berhasil';
    foreach($cari as $c ) :
    $msg    = 'Anda telah menghapus pelanggan '.$c['pelanggan_nama'].'!';
    endforeach;
    $type   = 'success';
    header('location: ../pelanggan.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
}else{
    $icon   = 'flaticon-error';
    $title  = 'Gagal';
    foreach($cari as $c ) :
    $msg    = 'Anda gagal menghapus pelanggan '. $c['pelanggan_nama'].'!';
    endforeach;
    $type   = 'danger';
    header('location: ../pelanggan.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
}
 ?>

