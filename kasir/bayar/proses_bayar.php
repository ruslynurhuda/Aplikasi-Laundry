<?php
    $title = 'Data Pembayaran';
    require '../../function/function.php';

	if(isset($_POST['tambah'])){

		if(bayar($_POST) > 0) : 
            $icon   = 'flaticon-success';
            $title  = 'Berhasil';
            $msg    = 'Pembayaran orderan '.$_POST['orderan_kd'].' telah dilakukan !';
            $type   = 'success';
            header('location: ../transaksi.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
        else :
            $icon   = 'flaticon-error';
            $title  = 'Gagal';
            $msg    = 'Pembayaran orderan '.$_POST['orderan_kd'].' gagal dilakukan !';
            $type   = 'danger';
            header('location: ../transaksi.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
		endif;
	}

?>