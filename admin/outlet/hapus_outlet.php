<?php 
require '../../function/function.php';
$id = $_GET["id"];
$cari   = query("SELECT * FROM outlet WHERE outlet_id = " . $id);

if(hapus_outlet($id) > 0 ){
	$icon   = 'flaticon-success';
    $title  = 'Berhasil';
    foreach($cari as $c ) :
    $msg    = 'Anda telah menghapus outlet '.$c['outlet_nama'].'!';
    endforeach;
    $type   = 'success';
    header('location: ../outlet.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
}else{
    $icon   = 'flaticon-error';
    $title  = 'Gagal';
    foreach($cari as $c ) :
    $msg    = 'Anda gagal menghapus outlet '. $c['outlet_nama'].'!';
    endforeach;
    $type   = 'danger';
    header('location: ../outlet.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
}
 ?>

