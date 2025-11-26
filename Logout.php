<?php
session_start();
session_unset();   // Hapus semua session
session_destroy(); // Hancurkan session

header("Location: ../index.php"); // arahkan ke halaman login
exit();
?>
