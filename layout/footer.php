<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travel Website Footer</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
      margin: 0;
    }
    .wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .content {
      flex: 1;
    }
    .footer {
      background-color: #f8f9fa;
      padding: 40px 0;
    }
    .footer .nav-link {
      color: #000;
      margin-bottom: 10px;
    }
    .footer .nav-link:hover {
      color: #007bff;
    }
    .footer .social-icons a {
      color: #000;
      margin-right: 10px;
      font-size: 24px;
    }
    .footer .social-icons a:hover {
      color: #007bff;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="content">
      <!-- Your main content here -->
    </div>
    <footer class="footer">
      <div class="container">
        <div class="row">
          <!-- About Us Section -->
          <div class="col-md-4">
            <h5>About Us</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
          <!-- Quick Links Section -->
          <div class="col-md-4">
            <h5>Quick Links</h5>
            <ul class="nav flex-column">
              <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="#">About</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Reviews</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            </ul>
          </div>
          <!-- Contact Section -->
          <div class="col-md-4">
            <h5>Contact</h5>
            <ul class="nav flex-column">
              <li class="nav-item"><a class="nav-link" href="mailto:info@example.com">info@example.com</a></li>
              <li class="nav-item"><a class="nav-link" href="tel:+1234567890">+1 234 567 890</a></li>
              <li class="nav-item"><a class="nav-link" href="#">123 Street, City, Country</a></li>
            </ul>
            <!-- Social Media Icons -->
            <div class="social-icons">
              <a href="#"><i class="bi bi-facebook"></i></a>
              <a href="#"><i class="bi bi-twitter"></i></a>
              <a href="#"><i class="bi bi-instagram"></i></a>
              <a href="#"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-12 text-center">
            <p class="mb-0">&copy; 2024 Your Website Name. All Rights Reserved.</p>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css" rel="stylesheet">
</body>
</html>