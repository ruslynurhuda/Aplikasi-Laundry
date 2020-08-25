<?php
    $title = 'Data Service';
    require '../../function/function.php';
    $cari   = query("SELECT * FROM service WHERE service_id = " . $_GET['id']);

	if(isset($_POST['edit'])){

		if(edit_service($_POST) > 0) : 
            $icon   = 'flaticon-success';
            $title  = 'Berhasil';
            foreach($cari as $c) :
            $msg    = 'Anda Berhasil Mengedit service '. $c['service_nama'] .' !';
            endforeach;
            $type   = 'success';
            header('location: ../service.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
        else :
            $icon   = 'flaticon-error';
            $title  = 'Gagal';
            foreach($cari as $c) :
            $msg    = 'Anda Gagal gagal service '. $c['service_nama'] .' !';
            endforeach;
            $type   = 'danger';
            header('location: ../service.php?icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
		endif;
	}

?>