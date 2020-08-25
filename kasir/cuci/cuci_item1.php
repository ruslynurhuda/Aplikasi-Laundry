<?php
    $title = 'Data Item';
    require '../../function/function.php';

	if(isset($_POST['tambah'])){
        if(tambah_item1($_POST) > 0) : 
            $id     = $_POST['cuci_id'];
            $icon   = 'flaticon-success';
            $title  = 'Berhasil';
            $msg    = 'Anda Telah Menambahkan item !';
            $type   = 'success';
            header('location: ../room_cuci.php?id='.$id.'&icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
        else :
            $id     = $_POST['cuci_id'];
            $icon   = 'flaticon-error';
            $title  = 'Gagal';
            $msg    = 'Anda Gagal Menambahkan item !';
            $type   = 'danger';
            header('location: ../room_cuci.php?id='.$id.'&icon='.$icon.'&title='.$title.'&msg='.$msg.'&type='.$type.'');
		endif;
	}

?>