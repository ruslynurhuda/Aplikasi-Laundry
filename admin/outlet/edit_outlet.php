<?php
    $title = 'Data Outlet';
    require '../../function/function.php';
    $cari   = query("SELECT * FROM outlet WHERE outlet_id = " . $_GET['id']);

	if(isset($_POST['edit'])){

		if(edit_outlet($_POST) > 0) : 
            $icon   = 'flaticon-success';
            $title  = 'Berhasil';
            foreach($cari as $c) :
            $msg    = 'Anda Berhasil Mengedit outlet '. $c['outlet_nama'] .' !';
            endforeach;
            $type   = 'success';
            header('location: ../outlet.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
        else :
            $icon   = 'flaticon-error';
            $title  = 'Gagal';
            foreach($cari as $c) :
            $msg    = 'Anda Gagal gagal outlet '. $c['outlet_nama'] .' !';
            endforeach;
            $type   = 'danger';
            header('location: ../outlet.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
		endif;
	}

?>