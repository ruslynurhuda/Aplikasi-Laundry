<?php

session_start();
session_destroy();
$msg = "Anda Berhasil Keluar";
header('location:../index.php?msg='.$msg);
?>