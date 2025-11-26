<?php
require_once "../config.php";

// Inisialisasi variabel
$nim = $nama = $jk = $alamat = $prodi = "";

// Proses simpan data
if (isset($_POST['simpan'])) {
    $nim     = $_POST['nim'];
    $nama    = $_POST['nama'];
    $jk      = $_POST['jk'];
    $alamat  = $_POST['alamat'];
    $prodi   = $_POST['prodi'];
    $waktu   = date("Y-m-d H:i:s");

    $sql = "INSERT INTO mhs (nim, nama, gender, alamat, prodi, waktu)
            VALUES ('$nim', '$nama', '$jk', '$alamat', '$prodi', '$waktu')";
    $tes = $db->query($sql);

    if ($tes) {
        $notif = "
        <div class='alert alert-success mt-3 text-center shadow'>
            ✔ Data berhasil disimpan!
            <br><a href='./?p=mahasiswa' class='btn btn-success btn-sm mt-2'>Lihat Data</a>
        </div>";
    } else {
        $notif = "<div class='alert alert-danger mt-3 text-center shadow'>❌ Gagal menyimpan data.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Mahasiswa</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: linear-gradient(-45deg, #6a11cb, #2575fc, #43e97b, #38f9d7);
            background-size: 400% 400%;
            animation: bgMove 10s ease infinite;
            min-height: 100vh;
        }

        @keyframes bgMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .navbar {
            background: rgba(0,0,0,0.7) !important;
            backdrop-filter: blur(6px);
        }

        .card-glass {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 25px;
            border: 1px solid rgba(255,255,255,0.3);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .title-glow {
            color: white;
            text-shadow: 0 0 12px rgba(255,255,255,0.9);
            font-weight: 700;
        }

        .btn-save {
            border-radius: 40px;
            padding: 10px 25px;
            font-weight: bold;
            transition: .3s;
        }

        .btn-save:hover {
            transform: scale(1.05);
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 10px;
        }

    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark navbar-expand-lg shadow-sm">
    <div class="container">
        <style>
.blob-btn {
    position: relative;
    padding: 10px 25px;
    background: #4caf50;
    color: white;
    border-radius: 40px;
    text-decoration: none;
    font-weight: bold;
    overflow: hidden;
    transition: 0.3s;
}
.blob-btn:hover {
    transform: scale(1.05);
}
</style>

<a href="javascript:history.back()" class="blob-btn">
    ⬅ Kembali
</a>

        <a class="navbar-brand fw-bold" href="./?p=dashboard">📚 Sistem Akademik</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link text-white" href="./">🏠 Dashboard</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="./?p=mahasiswa">📋 Data Mahasiswa</a></li>
            <li class="nav-item"><a class="nav-link active text-warning fw-bold" href="./?p=tambah_mahasiswa">➕ Tambah Mahasiswa</a></li>
        </ul>
    </div>
</nav>

<!-- CONTENT FULL PAGE -->
<div class="container py-5">

    <h2 class="text-center mb-4 title-glow">➕ Tambah Data Mahasiswa</h2>

    <?= isset($notif) ? $notif : "" ?>

    <div class="card-glass">

        <form method="post">

            <div class="mb-3">
                <label class="form-label text-white">NIM</label>
                <input type="number" name="nim" class="form-control" value="<?= htmlspecialchars($nim) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($nama) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Jenis Kelamin</label>
                <br>
                <label class="text-white me-3">
                    <input type="radio" name="jk" value="L" <?= ($jk=="L")?"checked":"" ?>> Laki-laki
                </label>
                <label class="text-white">
                    <input type="radio" name="jk" value="P" <?= ($jk=="P")?"checked":"" ?>> Perempuan
                </label>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Alamat</label>
                <textarea name="alamat" class="form-control" required><?= htmlspecialchars($alamat) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Program Studi</label>
                <select name="prodi" class="form-select" required>
                    <option value="">-- Pilih Program Studi --</option>
                    <option value="1" <?= ($prodi=="1")?"selected":"" ?>>Informatika</option>
                    <option value="2" <?= ($prodi=="2")?"selected":"" ?>>Arsitektur</option>
                    <option value="3" <?= ($prodi=="3")?"selected":"" ?>>Ilmu Lingkungan</option>
                </select>
            </div>

            <div class="text-end">
                <button type="submit" name="simpan" class="btn btn-light btn-save">
                    💾 Simpan Data
                </button>
            </div>

        </form>

    </div>
</div>

</body>
</html>
