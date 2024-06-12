<?php
    session_start();
    require_once "auth.php"; 
    if(!isset($_SESSION['login'])){
        header("location: ../login.php");
        exit();
    }
    
require "../inc/koneksi.php";
require "../inc/functions.php";

// Mendapatkan data tim dengan informasi kategori
$query = "SELECT team.*, kategori.nama AS nama_kategori FROM team JOIN kategori ON team.kategori_id = kategori.id ORDER BY team.kategori_id DESC";
$teams = mysqli_query($conn, $query);

// Mendapatkan jumlah tim
$jumlahTeams = mysqli_num_rows($teams);

// Mendapatkan data kategori
$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

// Fungsi untuk menghasilkan string acak
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


// Jika tombol "Simpan" ditekan
if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $kotaAsal = htmlspecialchars($_POST['kotaAsal']);
    $negara = htmlspecialchars($_POST['negara']);
    $stadion = htmlspecialchars($_POST['stadion']);
    $tahunDidirikan = htmlspecialchars($_POST['tahunDidirikan']);
    $pelatih = htmlspecialchars($_POST['pelatih']);

    // Validasi input
    if (empty($kategori)) {
        $pesan = 'Silakan pilih kategori';
    } elseif (empty($nama) || empty($kotaAsal) || empty($negara) || empty($stadion) || empty($tahunDidirikan) || empty($pelatih)) {
        $pesan = 'Tidak Boleh Ada Yang Kosong';
    } else {
        // Jika gambar diunggah
        if ($_FILES["gambar"]["error"] === 0) {
            $target_dir = "../css/image/";
            $nama_file = basename($_FILES["gambar"]["name"]);
            $target_file = $target_dir . $nama_file;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $image_size = $_FILES["gambar"]["size"];
            $random_name = generateRandomString(15);
            $new_name = $random_name . "." . $imageFileType;

            // Validasi tipe dan ukuran gambar
            if ($image_size > 4000000) {
                $pesan = 'File tidak boleh lebih dari 4mb';
            } elseif (!in_array($imageFileType, ['jpg', 'png', 'gif'])) {
                $pesan = 'File wajib bertipe jpg, png, atau gif';
            } elseif (!move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_dir . $new_name)) {
                $pesan = 'Gagal mengupload gambar';
            }
        }

        // Jika tidak ada pesan kesalahan
        if (!isset($pesan)) {
            // Insert data tim ke database
            $queryTambah = mysqli_query($conn, "INSERT INTO team (nama, kategori_id, kotaAsal, negara, stadion, tahunDidirikan, pelatih, gambar) VALUES ('$nama', '$kategori', '$kotaAsal', '$negara', '$stadion', '$tahunDidirikan', '$pelatih', '$new_name')");

            // Periksa apakah query berhasil
            if ($queryTambah) {
                $pesan = 'Team berhasil disimpan';
                header("refresh:2; url=team.php");
            } else {
                $pesan = 'Error: ' . mysqli_error($conn);
            }
        }
    }
}

// Mendapatkan data tim dengan informasi kategori
$query = "SELECT team.*, kategori.nama AS nama_kategori FROM team JOIN kategori ON team.kategori_id = kategori.id";

// Filter data jika terdapat parameter pencarian
if(isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query .= " WHERE team.nama LIKE '%$search%' OR team.kotaAsal LIKE '%$search%' OR team.negara LIKE '%$search%' OR team.stadion LIKE '%$search%' OR team.tahunDidirikan LIKE '%$search%' OR team.pelatih LIKE '%$search%'";
}

$query .= " ORDER BY team.kategori_id DESC";

$teams = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teams</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        .no-decoration {
            text-decoration: none;
        }

        form div {
            margin-bottom: 10px;
        }

        @media print {
            .no-print {
                display: none !important;
            }
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
                        <a class="nav-link" href="admin.php">Home</a>
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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="no-decoration text-muted">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Team
                </li>
            </ol>
        </nav>

        <!-- Bagian Tambah Team -->
        <div class="my-5 col-12 col-md-6 no-print">
            <h3>Tambah Team</h3>

            <form id="form-tambah-team" action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama Team</label>
                    <input type="text" id="nama" name="nama" class="form-control" autofocus autocomplete="off">
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">Pilih Satu</option>
                        <?php
                        while ($data = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="kotaAsal">Kota Asal</label>
                    <input type="text" id="kotaAsal" name="kotaAsal" class="form-control" autocomplete="off">
                </div>
                <div>
                    <label for="negara">Negara</label>
                    <input type="text" id="negara" name="negara" class="form-control" autocomplete="off">
                </div>
                <div>
                    <label for="stadion">Stadion</label>
                    <input type="text" id="stadion" name="stadion" class="form-control" autocomplete="off">
                </div>
                <div>
                    <label for="tahunDidirikan">Tahun Didirikan</label>
                    <input type="number" id="tahunDidirikan" name="tahunDidirikan" class="form-control" autocomplete="off">
                </div>
                <div>
                    <label for="pelatih">Pelatih</label>
                    <input type="text" id="pelatih" name="pelatih" class="form-control" autocomplete="off">
                </div>
                <div>
                    <label for="gambar">Gambar</label>
                    <input type="file" id ="gambar" name="gambar" class="form-control">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                </div>
            </form>
            <?php if (isset($pesan)) : ?>
                <div class="alert alert-warning mt-3" role="alert">
                    <?php echo $pesan; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Bagian Pencarian -->
<div class="mb-3">
    <form action="" method="get" class="form-inline">
        <div class="form-group">
            <input type="text" name="search" class="form-control mr-2" placeholder="Cari...">
        </div>
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
</div>

        <!-- Bagian List Teams -->
<!-- Bagian List Teams -->
<div class="mt-3 mb-5">
    <h2>List Teams</h2>

    <div class="table-responsive mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Kota Asal</th>
                    <th>Negara</th>
                    <th>Stadion</th>
                    <th>Tahun Didirikan</th>
                    <th>Pelatih</th>
                    <th>Gambar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($jumlahTeams == 0) : ?>
                    <tr>
                        <td colspan="10" class="text-center">Data Teams tidak tersedia</td>
                    </tr>
                <?php else : ?>
                    <?php
                    $nomor = 1;
                    while ($team = mysqli_fetch_assoc($teams)) :
                    ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $team['nama']; ?></td>
                            <td><?php echo $team['nama_kategori']; ?></td>
                            <td><?php echo $team['kotaAsal']; ?></td>
                            <td><?php echo $team['negara']; ?></td>
                            <td><?php echo $team['stadion']; ?></td>
                            <td><?php echo $team['tahunDidirikan']; ?></td>
                            <td><?php echo $team['pelatih']; ?></td>
                            <td><img src="../css/image/<?php echo $team['gambar']; ?>" alt="" width="120"></td>
                            <td><a href="team-detail.php?id=<?php echo $team['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a></td>
                        </tr>
                    <?php
                        $nomor++;
                    endwhile;
                    ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>


