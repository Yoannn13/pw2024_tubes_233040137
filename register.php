<?php 
    require 'inc/koneksi.php';
    require 'inc/functions.php';

    if (isset($_POST["register"])) {
        if(register($_POST) > 0) {
            echo "<script>
                    alert('User baru berhasil ditambahkan');
                    window.location.href = 'login.php';
                </script>";
        } else {
            echo "<script>
                    alert('Registrasi gagal, coba lagi.');
                </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
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
      <h2 class="text-center">Register</h2>
      <form action="" method="post">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" id="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <div class="mb-3">
          <label for="password1" class="form-label">Confirm Password</label>
          <input type="password" name="password1" class="form-control" id="password1" required>
        </div>
        <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
      </form>
      <div class="text-center mt-3">
        <p>Sudah punya akun? <a href="login.php">Login here</a></p>
        <a href="index.php" class="btn btn-secondary">Back to Home</a>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBaF2B5P5zV1Gts3jOux69kA7YsVxG8+puhDbxJpWSDaP6yM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-qgFUgdv5CO4c3WBK3yDXe8EY3Cz4H1h6TbsmVPw40QOY5hLpJ1Lsp5V6D7/sT0H+" crossorigin="anonymous"></script>
</body>
</html>
