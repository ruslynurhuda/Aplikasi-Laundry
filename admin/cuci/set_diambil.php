<?php
    $title = 'Data Selesai';
    require '../../function/function.php';

        if(diambil()) : 
            $icon   = 'flaticon-success';
            $title  = 'Berhasil';
            $msg    = 'Cucian telah diambil !';
            $type   = 'success';
            header('location: ../orderan.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
        else :
            $icon   = 'flaticon-error';
            $title  = 'Gagal';
            $msg    = 'Gagal set diambil !';
            $type   = 'danger';
            header('location: ../orderan.php?id=icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
		endif;

?>