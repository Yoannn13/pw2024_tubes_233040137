<?php
    session_start();
    require_once "auth.php"; 
    if(!isset($_SESSION['login'])){
      header("location: ../login.php");
      exit();
    }

// Mengimpor file koneksi.php
require "../inc/koneksi.php";

// Mendapatkan nilai parameter GET 'id'
$id = $_GET['id'];

// Mengambil data team berdasarkan id dan melakukan JOIN dengan tabel kategori untuk mendapatkan nama kategori
$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM team a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'");
$data = mysqli_fetch_array($query);

// Mengambil data kategori
$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

// Fungsi untuk menghasilkan string acak
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomthing = '';
    for ($i = 0; $i < $length; $i++) {
        $randomthing .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomthing;
}

// Memeriksa apakah tombol "Simpan" diklik
if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $kotaAsal = htmlspecialchars($_POST['kotaAsal']);
    $negara = htmlspecialchars($_POST['negara']);
    $stadion = htmlspecialchars($_POST['stadion']);
    $tahunDidirikan = htmlspecialchars($_POST['tahunDidirikan']);
    $pelatih = htmlspecialchars($_POST['pelatih']);

    // Untuk gambar
    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $gambar_baru = '';

    if ($nama == '' || $kategori == '' || $kotaAsal == '' || $negara == '' || $stadion == '' || $tahunDidirikan == '' || $pelatih == '') {
        // Jika ada kolom yang kosong, tampilkan pesan kesalahan
        $pesan = 'Tidak Boleh Ada Yang Kosong';
    } else {
        if ($gambar != '') {
            $ext = pathinfo($gambar, PATHINFO_EXTENSION);
            $gambar_baru = generateRandomString() . '.' . $ext;
            $path = "../css/image/" . $gambar_baru;

            // Menghapus gambar lama
            if ($data['gambar'] != '' && file_exists("../css/image/" . $data['gambar'])) {
                unlink("../css/image/" . $data['gambar']);
            }

            // Mengunggah gambar baru
            move_uploaded_file($gambar_tmp, $path);
        } else {
            $gambar_baru = $data['gambar'];
        }

        // Proses penyimpanan data team
        $queryUpdate = mysqli_query($conn, "UPDATE team SET kategori_id='$kategori', nama='$nama', kotaAsal='$kotaAsal', negara='$negara', stadion='$stadion', tahunDidirikan='$tahunDidirikan', pelatih='$pelatih', gambar='$gambar_baru' WHERE id='$id'");

        if ($queryUpdate) {
            // Jika berhasil diperbarui, tampilkan pesan sukses
            $pesan = 'Data Team Berhasil Diupdate';
        } else {
            // Jika terjadi kesalahan saat memperbarui data, tampilkan pesan error
            $pesan = 'Terjadi kesalahan saat mengupdate data team: ' . mysqli_error($conn);
        }
    }
}

// Memeriksa apakah tombol "Hapus" diklik
if (isset($_POST['hapus'])) {
    // Hapus data team
    $queryHapus = mysqli_query($conn, "DELETE FROM team WHERE id='$id'");

    if ($queryHapus) {
        // Jika berhasil dihapus, hapus juga gambar dari folder
        if ($data['gambar'] != '' && file_exists("../css/image/" . $data['gambar'])) {
            unlink("../css/image/" . $data['gambar']);
        }
        // Redirect ke halaman teams.php
        header("Location: team.php");
        exit();
    } else {
        // Jika terjadi kesalahan saat menghapus data, tampilkan pesan error
        $pesan = 'Terjadi kesalahan saat menghapus data team: ' . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Team Detail</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
    crossorigin="anonymous">

  <style>
    form div {
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item me-4">
                        <a class="nav-link" href="../admin">Home</a>
                    </li>
                    <li class="nav-item me-5">
                        <a class="nav-link" href="kategori.php">Kategori</a>
                    </li>
                    <li class="nav-item me-5">
                        <a class="nav-link" href="team.php">Team</a>
                    </li>
                    <li class="nav-item me-5">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

  <div class="container mt-5">
    <h2>Detail Team</h2>

    <div class="col-12 col-md-6 mb-5">
      <form action="" method="post" enctype="multipart/form-data">
        <div>
          <label for="nama">Nama Team</label>
          <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $data['nama']; ?>">
        </div>
        <div>
          <label for="kategori">Kategori</label>
          <select name="kategori" id="kategori" class="form-control">
            <?php
            while ($dataKategori = mysqli_fetch_array($queryKategori)) {
              $selected = ($dataKategori['id'] == $data['kategori_id']) ? 'selected' : '';
              echo "<option value='{$dataKategori['id']}' $selected>{$dataKategori['nama']}</option>";
            }
            ?>
          </select>
        </div>
        <div>
          <label for="kotaAsal">Kota Asal</label>
          <input type="text" name="kotaAsal" id="kotaAsal" class="form-control" value="<?php echo $data['kotaAsal']; ?>">
        </div>
        <div>
          <label for="negara">Negara</label>
          <input type="text" name="negara" id="negara" class="form-control" value="<?php echo $data['negara']; ?>">
        </div>
        <div>
          <label for="stadion">Stadion</label>
          <input type="text" name="stadion" id="stadion" class="form-control" value="<?php echo $data['stadion']; ?>">
        </div>
        <div>
          <label for="tahunDidirikan">Tahun Didirikan</label>
          <input type="number" name="tahunDidirikan" id="tahunDidirikan" class="form-control" value="<?php echo $data['tahunDidirikan']; ?>">
        </div>
        <div>
          <label for="pelatih">Pelatih</label>
          <input type="text" name="pelatih" id="pelatih" class="form-control" value="<?php echo $data['pelatih']; ?>">
        </div>
        <div>
          <label for="gambar">Gambar</label>
          <input type="file" name="gambar" id="gambar" class="form-control">
          <?php if ($data['gambar']) : ?>
            <img src="../css/image/<?php echo $data['gambar']; ?>" alt="" width="120" class="mt-2">
          <?php endif; ?>
        </div>
        <div>
          <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
          <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
        </div>
      </form>

      <?php 
      // Tampilkan pesan jika ada
      if (isset($pesan)) : ?>
        <div class="alert alert-info mt-3">
          <?php echo $pesan; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz4fnFO9gybBogGzP5gSkp9U5T7raiP2zbgGkBfUwh9gLk49V6Lce0xfnw"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
    integrity="sha384-ku6AItEvd3+K6GAe2e3RhuIG8dBp2sND9e1TNpXW4lIKzH5WoQDz0SMHV6rdmVxG"
    crossorigin="anonymous"></script>
</body>

</html>
