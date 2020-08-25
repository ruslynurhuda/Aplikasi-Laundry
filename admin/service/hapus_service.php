<?php 
require '../../function/function.php';
$id = $_GET["id"];
$cari   = query("SELECT * FROM service WHERE service_id = " . $id);

if(hapus_service($id) > 0 ){
	$icon   = 'flaticon-success';
    $title  = 'Berhasil';
    foreach($cari as $c ) :
    $msg    = 'Anda telah menghapus service '.$c['service_nama'].'!';
    endforeach;
    $type   = 'success';
    header('location: ../service.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
}else{
    $icon   = 'flaticon-error';
    $title  = 'Gagal';
    foreach($cari as $c ) :
    $msg    = 'Anda gagal menghapus service '. $c['service_nama'].'!';
    endforeach;
    $type   = 'danger';
    header('location: ../service.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
}
 ?>

