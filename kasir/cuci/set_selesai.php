<?php
    $title = 'Data Selesai';
    require '../../function/function.php';

        if(selesai()) : 
            $icon   = 'flaticon-success';
            $title  = 'Berhasil';
            $msg    = 'Cucian telah selesai !';
            $type   = 'success';
            header('location: ../cuci.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
        else :
            $icon   = 'flaticon-error';
            $title  = 'Gagal';
            $msg    = 'Gagal set selesai !';
            $type   = 'danger';
            header('location: ../cuci.php?id=icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
		endif;

?>