<?php
    $title = 'Data Batal Orderan';
    require '../../function/function.php';

		if(batal_orderan()) : 
            $icon   = 'flaticon-success';
            $title  = 'Berhasil';
            $msg    = 'Orderan berhasil dibatalkan !';
            $type   = 'success';
            header('location: ../orderan.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
        else :
            $icon   = 'flaticon-error';
            $title  = 'Gagal';
            $msg    = 'Orderan gagal dibatalkan';
            $type   = 'danger';
            header('location: ../orderan.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
		endif;

?>