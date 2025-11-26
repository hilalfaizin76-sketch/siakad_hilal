<?php
$db=new mysqli("localhost","root","","db_siakad");
if($db){
    echo"koneksi berhasil!";
}else{
    echo"koneksi gagal";
}
?>