<?php

session_start();
require 'function/function.php';

$username = $_POST['username'];
$password = md5($_POST['password']);
$query = "SELECT * FROM user where username='$username' AND password = '$password'";
$row = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($row);
$cek = mysqli_num_rows($row);


if($cek > 0){
    if($data['role'] == 'Admin'){
        $_SESSION['role'] = 'Admin';
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama_user'] = $data['nama_user'];
        $_SESSION['user_id'] = $data['id_user'];
        $_SESSION['outlet_id'] = $data['outlet_id'];
        $_SESSION['welcome'] = 'Selamat datang';

        header('location:admin');
    }else if($data['role'] == 'Kasir'){
        $_SESSION['role'] = 'Kasir';
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama_user'] = $data['nama_user'];
        $_SESSION['user_id'] = $data['id_user'];
        $_SESSION['outlet_id'] = $data['outlet_id'];
        header('location:kasir');
    }else if($data['role'] == 'Owner'){
        $_SESSION['role'] = 'Owner';
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama_user'] = $data['nama_user'];
        $_SESSION['user_id'] = $data['id_user'];
        $_SESSION['outlet_id'] = $data['outlet_id'];
        header('location:owner');
    }
}else{
    $msg = 'Username Atau Password Salah';
    header('location:index.php?msg='.$msg);
}

?>