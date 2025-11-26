<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../config.php";

$keyword = $_POST['keyword'] ?? '';
$category = $_POST['category'] ?? '';
$duplikatPesan = "";

// ==========================
// Query Pencarian
// ==========================
if (isset($_POST['cari'])) {

    if ($category == "prodi") {
        $prodi = ($keyword == "INF") ? 1 : $keyword;
        $sql = "SELECT * FROM mhs WHERE prodi LIKE '%$prodi%'";

    } else {
        $sql = "SELECT * FROM mhs WHERE $category LIKE '%$keyword%'";
    }

} else {
    $sql = "SELECT * FROM mhs";
}

$data = $db->query($sql);

// ==========================
// Cek Duplikasi
// ==========================
$cekNIM = $db->query("
  SELECT RIGHT(nim, 3) AS nim_akhir, COUNT(*) AS jumlah 
  FROM mhs 
  GROUP BY nim 
  HAVING jumlah > 1
");

$cekNama = $db->query("
  SELECT nama, COUNT(*) AS jumlah 
  FROM mhs 
  GROUP BY nama 
  HAVING jumlah > 1
");

// Tampilkan duplikat
if ($cekNIM->num_rows > 0) {
    $duplikatPesan .= "<div class='alert alert-danger'><strong>⚠️ Duplikasi NIM ditemukan:</strong><br>";
    while ($row = $cekNIM->fetch_assoc()) {
        $duplikatPesan .= "- 3 digit terakhir <b>{$row['nim_akhir']}</b> muncul <b>{$row['jumlah']}</b> kali<br>";
    }
    $duplikatPesan .= "</div>";
}

if ($cekNama->num_rows > 0) {
    $duplikatPesan .= "<div class='alert alert-warning'><strong>⚠️ Duplikasi Nama ditemukan:</strong><br>";
    while ($row = $cekNama->fetch_assoc()) {
        $duplikatPesan .= "- Nama <b>{$row['nama']}</b> muncul <b>{$row['jumlah']}</b> kali<br>";
    }
    $duplikatPesan .= "</div>";
}
?>

<main class="app-main">

  <div class="app-content-header">
    <div class="container-fluid">
      <h3>Dashboard Mahasiswa</h3>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-header">

          <?= $duplikatPesan ?>

          <a href="./?p=tambah-mhs"class="btn btn-success btn-sm">+ Tambah Mahasiswa</a>

          <form method="post" class="mt-3 d-flex" style="gap:10px;">
            <input type="text" name="keyword" value="<?= $keyword ?>" placeholder="Masukkan kata kunci">
            
            <select name="category">
              <option value="nim" <?= ($category=="nim")?"selected":"" ?>>NIM</option>
              <option value="nama" <?= ($category=="nama")?"selected":"" ?>>Nama</option>
              <option value="gender" <?= ($category=="gender")?"selected":"" ?>>Jenis Kelamin</option>
              <option value="prodi" <?= ($category=="prodi")?"selected":"" ?>>Prodi</option>
            </select>

            <button type="submit" name="cari" class="btn btn-primary btn-sm">Search</button>
          </form>

        </div>

        <div class="card-body">

          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Gender</th>
                <th>Alamat</th>
                <th>Prodi</th>
                <th>Waktu</th>
                <th>Opsi</th>
              </tr>
            </thead>

            <tbody>
              <?php 
              $no = 1;
              foreach ($data as $d) {

                if ($d['prodi'] == 1) $p = "Informatika";
                elseif ($d['prodi'] == 2) $p = "Arsitektur";
                elseif ($d['prodi'] == 3) $p = "Ilmu Lingkungan";
                else $p = "Tidak Diketahui";

                echo "
                <tr>
                  <td>$no</td>
                  <td>{$d['nim']}</td>
                  <td>{$d['nama']}</td>
                  <td>{$d['gender']}</td>
                  <td>{$d['alamat']}</td>
                  <td>{$p}</td>
                  <td>{$d['waktu']}</td>
                  <td>
                    <a href='.?p=edit-mhs&id={$d['id']}' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='.?p=hapus-mhs&id={$d['id']}' class='btn btn-danger btn-sm'>Delete</a>
                    <a href='.?p=detail-mhs&id={$d['id']}' class='btn btn-success btn-sm'>Detail</a>
                  </td>
                </tr>";
                $no++;
              }
              ?>
            </tbody>

          </table>

        </div>
      </div>

    </div>
  </div>

</main>
