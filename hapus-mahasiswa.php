<?php
require_once "../config.php";

// Ambil id dari URL
$idx = $_GET['id'];

// Query hapus data
$sql = "DELETE FROM mhs WHERE id='$idx'";

// Eksekusi query dan cek hasilnya
if ($db->query($sql)) {
    echo "<script>
            alert('Data mahasiswa berhasil dihapus!');
            window.location.href = './?p=mahasiswa';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus data mahasiswa!');
            window.location.href = './?p=mahasiswa';
          </script>";
}
?>
