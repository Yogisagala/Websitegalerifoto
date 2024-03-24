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
	  background-attachment: fixed;
    }

  .navbar {
      background-color: transparent;
      padding: 1rem;
    }
		
	.card {
      background: transparent;
      background-size: cover;
	  border-radius: 15px;
	  border: 2px solid rgba(255, 255, 255, .5);
	  backdrop-filter: blur(20px);
	  box-shadow: 0 0 30px rgba(0, 0, 0, .8);
    }

	.form-control {
	  background-color: transparent;
	  border-radius: 10px;
	  border-color: black;
	  
    }

    .wrapper .btn {
		background: #162938;
		width: 85%;
        height: 40px;
		border-radius: 10px;
        transform: translate(24px, 5px);
	}

	</style>
</head>
<body>
<nav class="navbar navbar-expand-lg body-tertiary">
  <div class="container">
  <a class="navbar-brand" href="index.php" style = "font-family: ui-serif;">
      <img src="assets/logo.png" width="40" height="40">
      GALERI FOTO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto">
        
      </div>
      <a href="login.php" class="btn btn-outline-success m-1">Login</a>
      <a href="register.php" class="btn btn-outline-primary m-1">Daftar</a>
    </div>
  </div>
</nav>

<div class="container py-5">
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
						<div class="text-center">
							<h5>Daftar Akun Baru</h5>
						</div>
						<form action="config/aksi_register.php" method="POST">
					<label class="form-label">Username:</label>
					        <input type="text" name="Username" class="form-control" required>
					<label class="form-label">Password:</label>
							<input type="password" name="Password" class="form-control" required>
					<label class="form-label">Email:</label>
							<input type="email" name="Email" class="form-control" required>
					<label class="form-label">Nama Lengkap:</label>
							<input type="text" name="NamaLengkap" class="form-control" required>
					<label class="form-label">Alamat:</label>
							<input type="text" name="Alamat" class="form-control" required>
							<div class="d-grid mt-2">
								<div class="wrapper">
                           <button class="btn btn-outline-light" type="submit" name="kirim">DAFTAR</button>
							 
							  </div>
							</div>
						</form>
						<hr>
						<p>Sudah Punya Akun? <a href="login.php">Login Disini!</a></p>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>