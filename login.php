<?php
session_start();
require "inc/koneksi.php";
require 'inc/functions.php';

// Cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // Ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT id, username, role FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // Cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['id'] = $row['id'];
    }
}

$error = false;

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    // Cek username
    if (mysqli_num_rows($result) === 1) {
        // Cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // Set session
            $_SESSION["login"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $row['role'];
            $_SESSION["id"] = $row['id'];

            // Redirect ke halaman sesuai peran
            if ($row['role'] === 'admin') {
                header("Location: admin/admin.php");
                exit;
            } else if ($row['role'] === 'user') {
                header("Location: index.php");
                exit;
            } else {
                echo "Anda tidak memiliki akses.";
            }
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRcF1f3eYbWgP3B8zX8J/J80V1JOb5I1VFs3ygl9L" crossorigin="anonymous">

  <!-- CSS -->
  <link rel="stylesheet" href="css/login.css">
  <style>
    body, html {
      height: 100%;
    }
    .bg {
      background-color: #f8f9fa;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .form-container {
      background: #fff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <div class="bg">
    <div class="form-container">
      <h2 class="text-center">Login</h2>
      <form action="" method="post">
        <?php if($error) : ?>
          <p style="color: red; font-style: italic;"> Username / Password salah</p>
        <?php endif; ?>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" id="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
      </form>
      <div class="text-center mt-3">
        <p>Belum punya akun? <a href="register.php">Register here</a></p>
        <a href="index.php" class="btn btn-secondary">Back to Home</a>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBaF2B5P5zV1Gts3jOux69kA7YsVxG8+puhDbxJpWSDaP6yM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-qgFUgdv5CO4c3WBK3yDXe8EY3Cz4H1h6TbsmVPw40QOY5hLpJ1Lsp5V6D7/sT0H+" crossorigin="anonymous"></script>
</body>
</html>
