<?php
    $title = 'Data Service';
    require '../../function/function.php';

	if(isset($_POST['tambah'])){

		if(tambah_service($_POST) > 0) : 
            $icon   = 'flaticon-success';
            $title  = 'Berhasil';
            $msg    = 'Anda Telah Menambahkan service '.$_POST['service_nama'].' !';
            $type   = 'success';
            header('location: ../service.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
        else :
            $icon   = 'flaticon-error';
            $title  = 'Gagal';
            $msg    = 'Anda Gagal Menambahkan '.$_POST['service_nama'].' Baru !';
            $type   = 'danger';
            header('location: ../service.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
		endif;
	}

?>