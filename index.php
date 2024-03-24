<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Website Galeri Foto</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <style>
  
  body {
      background-image: url('assets/bg3.jpg');
      background-size: cover;
    }

  .navbar {
      background-color: transparent;
      padding: 1rem;
    }

  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg body-tertiary">
  <div class="container">
  <a class="navbar-brand" href="index.php" style = "font-family: ui-serif; color:black;">
      <img src="assets/logo.png" width="40" height="40">
      GALERI FOTO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto"> 
      </div>
      
      <span class="navbar-text" style="font-weight: bold; font-family: times;">
        Silahkan login terlebih dahulu !!
      </span>

      <a href="login.php" class="btn btn-outline-success m-1">Login</a>
      <a href="register.php" class="btn btn-outline-primary m-1">Daftar</a>
    </div>
  </div>
</nav>

<div class="wrapper">
<footer class="d-flex justify-content-center fixed-bottom" style="font-weight: bold;">
	<p> Project UKK </p>
</footer>

<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>