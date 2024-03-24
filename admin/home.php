<?php
session_start();
$userid = $_SESSION['UserID'];
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda Belum Login!');
    location.href='../index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Website Galeri Foto</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <style>
   body {
      background-image: url('../assets/bg3.jpg');
      background-size: cover;
    }

  .navbar {
      background-color: transparent;
      padding: 1rem;
    }

    .card {
      background-color: transparent;
      box-shadow: 0 0 30px rgba(0, 0, 0, .6);
      border-color: white; 
      backdrop-filter: blur(50px);
    }

    .container .btn {
      backdrop-filter: blur(50px);
    }
   </style>

</head>
<body>
<nav class="navbar navbar-expand-lg body-tertiary">
  <div class="container">
  <a class="navbar-brand" href="index.php" style = "font-family: ui-serif;">
      <img src="../assets/logo.png" width="40" height="40">
      GALERI FOTO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto">
        &thinsp;&thinsp;&thinsp;&thinsp;
        <a href="home.php" class="nav-link"><b>Home</b></a>
        <a href="album.php" class="nav-link"><b>Album</b></a>
        <a href="foto.php" class="nav-link"><b>Foto</b></a>
      </div>

      <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">Keluar</a>
    </div>
  </div>
</nav>

<div class="container md-3 mt-2">
    Album:
    <?php 
      $album = mysqli_query($koneksi, "SELECT * FROM album WHERE UserID");
      while($row = mysqli_fetch_array($album)){ ?>
      <a href="home.php?AlbumID=<?php echo $row['AlbumID'] ?>" class="btn btn-outline-primary">
      <?php echo $row['NamaAlbum'] ?></a>

    <?php }?>

  <div class="row">     
    <?php 
    if (isset($_GET['AlbumID'])) {
      $albumid = $_GET['AlbumID'];
      $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE UserID AND AlbumID='$albumid'");
      while($data = mysqli_fetch_array($query)){ ?>
        <div class="col-md-3 mt-2">
                <div class="card">
                    <img style="height: 12rem ;" src="../assets/img/<?php echo $data['LokasiFile'] ?>" class="card-img-top" title="<?php echo $data['JudulFoto'] ?>">
                      <div class="card-footer text-center">
                        
                          <?php 
                            $fotoid = $data['FotoID'];
                            $ceksuka = mysqli_query($koneksi,"SELECT * FROM likefoto WHERE FotoID='$fotoid' AND UserID='$userid'");
                            if (mysqli_num_rows($ceksuka) == 1) { ?>
                            <a href="../config/proses_like.php?FotoID=<?php echo $data['FotoID']?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                            <?php }else{ ?>
                            <a href="../config/proses_like.php?FotoID=<?php echo $data['FotoID']?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                            <?php }
                            $like = mysqli_query($koneksi,"SELECT * FROM likefoto WHERE FotoID='$fotoid'");
                            echo mysqli_num_rows($like). ' suka';
                          ?>
                          
                      </div>
                </div>
            </div>
      
     <?php } }else{ 

     $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE UserID");
     while($data = mysqli_fetch_array($query)){
  ?>
   <div class="col-md-3 mt-2">
                <div class="card">
                    <img style="height: 12rem;" src="../assets/img/<?php echo $data['LokasiFile'] ?>" class="card-img-top" title="<?php echo $data['JudulFoto'] ?>">
                      <div class="card-footer text-center">
                        
                          <?php 
                            $fotoid = $data['FotoID'];
                            $ceksuka = mysqli_query($koneksi,"SELECT * FROM likefoto WHERE FotoID='$fotoid' AND UserID='$userid'");
                            if (mysqli_num_rows($ceksuka) == 1) { ?>
                            <a href="../config/proses_like.php?FotoID=<?php echo $data['FotoID']?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                            <?php }else{ ?>
                            <a href="../config/proses_like.php?FotoID=<?php echo $data['FotoID']?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                            <?php }
                            $like = mysqli_query($koneksi,"SELECT * FROM likefoto WHERE FotoID='$fotoid'");
                            echo mysqli_num_rows($like). ' suka';
                          ?>
                        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['FotoID'] ?>"><i class="fa-regular fa-comment"></i> </a>
                        <?php 
                         $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE FotoID='$fotoid'");
                        echo mysqli_num_rows($jmlkomen), 'komentar';
                        ?>
                      </div>
                </div>
            </div>
  <?php } } ?>
  </div>
    </div>



<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>