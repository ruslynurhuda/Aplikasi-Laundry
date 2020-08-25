<?php
    $title = 'Data Orderan';
    require '../../function/function.php';

	if(isset($_POST['tambah'])){

		if(tambah_orderan($_POST) > 0) : 
            $icon   = 'flaticon-success';
            $title  = 'Berhasil';
            $msg    = 'Anda Telah Menambahkan orderan '.$_POST['orderan_kd'].' !';
            $type   = 'success';
            header('location: ../orderan.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
        else :
            $icon   = 'flaticon-error';
            $title  = 'Gagal';
            $msg    = 'Anda Gagal Menambahkan orderan' .$_POST['orderan_kd'].' Baru !';
            $type   = 'danger';
            header('location: ../orderan.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
		endif;
	}

?>