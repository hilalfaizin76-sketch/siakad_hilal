<?php
$p = $_GET['p'] ?? '';

switch ($p) {

    case 'mhs':
        require_once "mahasiswa.php";   // halaman utama mahasiswa
        break;

    case 'tambah-mhs':
        require_once "tambah-mahasiswa.php";
        break;

    case 'edit-mhs':
        require_once "edit-mahasiswa.php";
        break;

    case 'detail-mhs':
        require_once "detail-mahasiswa.php";
        break;

    case 'hapus-mhs':
        require_once "hapus-mahasiswa.php";
        break;

    case 'dosen':
        require_once "dosen.php";
        break;

    default:
        require_once "dasboard.php";
        break;
}
?>
