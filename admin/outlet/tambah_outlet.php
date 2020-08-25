<?php
    $title = 'Data Outlet';
    require '../../function/function.php';

	if(isset($_POST['tambah'])){

		if(tambah_outlet($_POST) > 0) : 
            $icon   = 'flaticon-success';
            $title  = 'Berhasil';
            $msg    = 'Anda Telah Menambahkan outlet '.$_POST['outlet_nama'].' !';
            $type   = 'success';
            header('location: ../outlet.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
        else :
            $icon   = 'flaticon-error';
            $title  = 'Gagal';
            $msg    = 'Anda Gagal Menambahkan '.$_POST['outlet_nama'].' Baru !';
            $type   = 'danger';
            header('location: ../outlet.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
		endif;
	}

?>