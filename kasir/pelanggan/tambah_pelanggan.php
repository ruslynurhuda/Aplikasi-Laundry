<?php
    $title = 'Data Pelanggan';
    require '../../function/function.php';

	if(isset($_POST['tambah'])){

		if(tambah_pelanggan($_POST) > 0) : 
            $icon   = 'flaticon-success';
            $title  = 'Berhasil';
            $msg    = 'Anda Telah Menambahkan pelanggan '.$_POST['pelanggan_nama'].' !';
            $type   = 'success';
            header('location: ../pelanggan.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
        else :
            $icon   = 'flaticon-error';
            $title  = 'Gagal';
            $msg    = 'Anda Gagal Menambahkan '.$_POST['pelanggan_nama'].' Baru !';
            $type   = 'danger';
            header('location: ../pelanggan.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
		endif;
	}

?>