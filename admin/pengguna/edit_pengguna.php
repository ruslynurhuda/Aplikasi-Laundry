<?php
    $title = 'Data Pengguna';
    require '../../function/function.php';
    $cari   = query("SELECT * FROM user WHERE id_user = " . $_GET['id']);

	if(isset($_POST['edit'])){

		if(edit_pengguna($_POST) > 0) : 
            $icon   = 'flaticon-success';
            $title  = 'Berhasil';
            foreach($cari as $c) :
            $msg    = 'Anda Berhasil Mengedit '. $c['nama_user'] .' !';
            endforeach;
            $type   = 'success';
            header('location: ../pengguna.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
        else :
            $icon   = 'flaticon-error';
            $title  = 'Gagal';
            foreach($cari as $c) :
            $msg    = 'Anda Gagal gagal '. $c['nama_user'] .' !';
            endforeach;
            $type   = 'danger';
            header('location: ../pengguna.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
		endif;
	}

?>