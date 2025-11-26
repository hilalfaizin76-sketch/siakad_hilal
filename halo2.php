<?php
date_default_timezone_set("Asia/Jakarta");

$hari_array = [
    'sunday'    => 'Minggu',
    'monday'    => 'Senin',
    'tuesday'   => 'Selasa',
    'wednesday' => 'Rabu',
    'thursday'  => 'Kamis',
    'friday'    => 'Jumat',
    'saturday'  => 'Sabtu'
];

$hari_inggris = date("l"); // menghasilkan Sunday, Monday, dst
$hari_inggris = strtolower($hari_inggris); // ubah jadi huruf kecil

$hari_indonesia = $hari_array[$hari_inggris];

echo "Hari ini: " . $hari_indonesia . "<br>";
echo "Jam sekarang: " . date("H:i:s");
?>
