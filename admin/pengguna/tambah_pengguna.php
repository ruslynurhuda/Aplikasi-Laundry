<?php
    $title = 'Data Pengguna';
    require '../../function/function.php';

	if(isset($_POST['tambah'])){

		if(tambah_pengguna($_POST) > 0) : 
            $icon   = 'flaticon-success';
            $title  = 'Berhasil';
            $msg    = 'Anda Telah Menambahkan '.$_POST['role'].' Baru !';
            $type   = 'success';
            header('location: ../pengguna.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
        else :
            $icon   = 'flaticon-error';
            $title  = 'Gagal';
            $msg    = 'Anda Gagal Menambahkan '.$_POST['role'].' Baru !';
            $type   = 'danger';
            header('location: ../pengguna.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
		endif;
	}

?>