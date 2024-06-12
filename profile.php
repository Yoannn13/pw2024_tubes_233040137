<?php
session_start(); // Pastikan sesi dimulai

require 'inc/koneksi.php';

// Pastikan username ada dalam sesi
if(isset($_SESSION["username"])) {
    $username = $_SESSION["username"];

    // Ambil data pengguna dari database
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        // Penanganan jika pengguna tidak ditemukan
        echo "Pengguna tidak ditemukan.";
        exit;
    }
} else {
    // Penanganan jika username tidak ada dalam sesi
    echo "Anda belum login.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .profile-container {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .profile-container h1 {
            text-align: center;
        }
        .profile-container p {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="profile-container">
    <h1>Profil Pengguna</h1>
    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
    <p><strong>Anda sudah berhasil login!!!</strong></p>
    <a href="index.php" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    <!-- Anda bisa menambahkan informasi lain dari array $user di sini -->
</div>

</body>
</html>
