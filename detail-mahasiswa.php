<?php
require_once "../config.php";

// Ambil id dari URL
$idx = $_GET['id'];

// Ambil data mahasiswa berdasarkan id
$sql = "SELECT * FROM mhs WHERE id='$idx'";
$data = $db->query($sql);
?>

<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Detail Mahasiswa</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Detail Mahasiswa</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!--end::App Content Header-->

  <!--begin::App Content-->
  <div class="app-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!--begin::Card-->
          <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
              <h3 class="card-title mb-0">📄 Informasi Lengkap Mahasiswa</h3>
            </div>

            <div class="card-body bg-light">
              <?php
              foreach ($data as $d) {
                // Konversi gender
                $jk = ($d['gender'] == "L") ? "Laki-laki" : "Perempuan";

                // Konversi prodi
                switch ($d['prodi']) {
                  case '1': $prodi = "Informatika"; break;
                  case '2': $prodi = "Arsitektur"; break;
                  case '3': $prodi = "Ilmu Lingkungan"; break;
                  default:  $prodi = "Tidak dikenal"; break;
                }
              ?>

              <!-- ===== TABEL DETAIL ===== -->
              <table class="table table-bordered table-striped">
                <tr>
                  <th width="30%">NIM</th>
                  <td><?= htmlspecialchars($d['nim']) ?></td>
                </tr>
                <tr>
                  <th>Nama Lengkap</th>
                  <td><?= htmlspecialchars($d['nama']) ?></td>
                </tr>
                <tr>
                  <th>Jenis Kelamin</th>
                  <td><?= $jk ?></td>
                </tr>
                <tr>
                  <th>Alamat</th>
                  <td><?= htmlspecialchars($d['alamat']) ?></td>
                </tr>
                <tr>
                  <th>Program Studi</th>
                  <td><?= $prodi ?></td>
                </tr>
                <tr>
                  <th>Waktu Input</th>
                  <td><?= htmlspecialchars($d['waktu']) ?></td>
                </tr>
              </table>

              <!-- Tombol Navigasi -->
              <div class="d-flex justify-content-between mt-4">
                <a href="javascript:history.back()" class="btn btn-secondary">
                  ⬅️ Kembali
                </a>
                <div>
                  <a href="edit-mahasiswa.php?id=<?= $d['id'] ?>" class="btn btn-warning">✏️ Edit</a>
                  <a href="hapus-mahasiswa.php?id=<?= $d['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">🗑️ Hapus</a>
                </div>
              </div>

              <?php } // end foreach ?>
            </div>
          </div>
          <!--end::Card-->
        </div>
      </div>
    </div>
  </div>
  <!--end::App Content-->
</main>

<style>
  body {
    background: linear-gradient(135deg, #89f7fe, #66a6ff);
    font-family: 'Poppins', sans-serif;
  }

  .card {
    border-radius: 15px;
  }

  th {
    background-color: #007bff;
    color: white;
    vertical-align: middle;
  }

  td {
    background-color: #ffffff;
  }
</style>
