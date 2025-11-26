<?php
require_once "../config.php";

// Ambil ID mahasiswa dari URL
$idx = $_GET['id'];

// Ambil data mahasiswa dari database
$sql = "SELECT * FROM mhs WHERE id='$idx'";
$data = $db->query($sql);
$d = $data->fetch_assoc();

// Jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
  $nim     = $_POST['nim'];
  $nama    = $_POST['nama'];
  $gender  = $_POST['gender'];
  $alamat  = $_POST['alamat'];
  $prodi   = $_POST['prodi'];

  $sql_update = "UPDATE mhs SET 
                    nim='$nim', 
                    nama='$nama', 
                    gender='$gender', 
                    alamat='$alamat', 
                    prodi='$prodi'
                 WHERE id='$idx'";

  if ($db->query($sql_update)) {
    echo "<script>alert('Data mahasiswa berhasil diperbarui');window.location='index.php';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui data');</script>";
  }
}
?>

<main class="app-main">
  <!-- Header -->
  <div class="app-content-header">
    <div class="container-fluid">
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

      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Edit Data Mahasiswa</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Edit Mahasiswa</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="app-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Card -->
          <div class="card shadow-lg border-0">
            <div class="card-header bg-warning text-white">
              <h3 class="card-title mb-0">✏️ Form Edit Mahasiswa</h3>
            </div>

            <div class="card-body bg-light">
              <form method="POST" action="">
                <div class="mb-3">
                  <label class="form-label">NIM</label>
                  <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($d['nim']) ?>" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Nama Lengkap</label>
                  <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($d['nama']) ?>" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Jenis Kelamin</label><br>
                  <div class="form-check form-check-inline">
                    <input type="radio" name="gender" value="L" id="jkL" class="form-check-input" <?= ($d['gender'] == "L") ? "checked" : "" ?>>
                    <label for="jkL" class="form-check-label">Laki-laki</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input type="radio" name="gender" value="P" id="jkP" class="form-check-input" <?= ($d['gender'] == "P") ? "checked" : "" ?>>
                    <label for="jkP" class="form-check-label">Perempuan</label>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Alamat</label>
                  <textarea name="alamat" class="form-control" rows="3" required><?= htmlspecialchars($d['alamat']) ?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label">Program Studi</label>
                  <select name="prodi" class="form-select" required>
                    <option value="">-- Pilih Prodi --</option>
                    <option value="1" <?= ($d['prodi'] == "1") ? "selected" : "" ?>>Informatika</option>
                    <option value="2" <?= ($d['prodi'] == "2") ? "selected" : "" ?>>Arsitektur</option>
                    <option value="3" <?= ($d['prodi'] == "3") ? "selected" : "" ?>>Ilmu Lingkungan</option>
                  </select>
                </div>

                <div class="d-flex justify-content-between mt-4">
                  <a href="index.php" class="btn btn-secondary">⬅️ Batal</a>
                  <button type="submit" name="simpan" class="btn btn-success">💾 Simpan Perubahan</button>
                </div>
              </form>
            </div>
          </div>
          <!-- End Card -->
        </div>
      </div>
    </div>
  </div>
</main>

<style>
  body {
    background: linear-gradient(135deg, #f6d365, #fda085);
    font-family: 'Poppins', sans-serif;
  }

  .card {
    border-radius: 15px;
  }

  .card-header {
    border-radius: 15px 15px 0 0;
  }

  label {
    font-weight: 600;
  }

  .form-control,
  .form-select {
    border-radius: 10px;
  }
</style>
