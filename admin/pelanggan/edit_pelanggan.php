<?php
    $title = 'Data Pelanggan';
    require '../../function/function.php';
    $cari   = query("SELECT * FROM pelanggan WHERE pelanggan_id = " . $_GET['id']);

	if(isset($_POST['edit'])){

		if(edit_pelanggan($_POST) > 0) : 
            $icon   = 'flaticon-success';
            $title  = 'Berhasil';
            foreach($cari as $c) :
            $msg    = 'Anda Berhasil Mengedit pelanggan '. $c['pelanggan_nama'] .' !';
            endforeach;
            $type   = 'success';
            header('location: ../pelanggan.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
        else :
            $icon   = 'flaticon-error';
            $title  = 'Gagal';
            foreach($cari as $c) :
            $msg    = 'Anda Gagal gagal pelanggan '. $c['pelanggan_nama'] .' !';
            endforeach;
            $type   = 'danger';
            header('location: ../pelanggan.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
		endif;
	}

?>