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
      background-attachment: fixed;
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
   </style>

<style type="text/css">

  .fa-download
  {
    font-size: 23px; 
    color: black;
    position: relative;
    left: 90%;
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

   <div class="container mt-3">
     <div class="row">
      <?php 
     $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN User ON foto.UserID=user.UserID INNER JOIN album ON foto.AlbumID=album.AlbumID");
     while($data = mysqli_fetch_array($query)){
  ?>
   <div class="col-md-3 mt-2">
     <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['FotoID'] ?>">
       
                <div class="card mb-2">
                    <img src="../assets/img/<?php echo $data['LokasiFile'] ?>" class="card-img-top" title="<?php echo $data['JudulFoto'] ?>" style="height: 12rem;">
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
                            echo mysqli_num_rows($like). '';
                          ?>
 
                        &thinsp;
                        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['FotoID'] ?>"><i class="fa-regular fa-comment"></i> </a>
                        <?php 
                         $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE FotoID='$fotoid'");
                        echo mysqli_num_rows($jmlkomen), 'komentar';
                        ?>
                      </div>
                </div>
              </a>

          <!-- Modal -->
      <div class="modal fade" id="komentar<?php echo $data['FotoID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
          <img src="../assets/img/<?php echo $data['LokasiFile']?>" class="card-img-top" title="<?php echo $data['JudulFoto']?>">
          </div>
          <div class="col-md-4">
            <div class="m-2">
              <div class="overflow-auto">
                <div class="sticky-top">
                 <a href="../assets/img/<?php echo $data['LokasiFile'] ?>" download="download">
                 <div class="class"></div>
                  <i class="fa-solid fa-download fa-xl"></i></a></br>
                  <strong><?php echo $data['JudulFoto'] ?></strong><br>
                  <span class="badge bg-secondary"><?php echo $data['NamaLengkap'] ?></span>
                  <span class="badge bg-secondary"><?php echo $data['TanggalUnggah'] ?></span>
                  <span class="badge bg-primary"><?php echo $data['NamaAlbum'] ?></span>
                </div>
                <hr>
                <p align="left">
                  <?php echo $data['DeskripsiFoto']?>
                </p>
                <hr>
                <?php 
                $fotoid = $data['FotoID'];
                 $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.UserID=user.UserID WHERE komentarfoto.FotoID='$fotoid'");
                while($row = mysqli_fetch_array($komentar)){
                ?>
               <p align="left">
                <strong><?php echo $row['NamaLengkap'] ?></strong>
                <?php echo $row['IsiKomentar'] ?>
               </p>
                <?php } ?>
                <hr>
                <div class="sticky-bottom">
                  <form action="../config/proses_komentar.php" method="POST">
                    <div class="input-group">
                      <input type="hidden" name="FotoID" value="<?php echo $data['FotoID']?>">
                      <input type="text" name="IsiKomentar" class="form-control" placeholder="Tambah Komentar...">
                      <div class="input-group-prepend">
                      <button type="submit" name="kirimkomentar" class="btn btn-outline-success"><i class="fa-regular fa-paper-plane" style="color: #000000;"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

		</div>
    <?php } ?>

<?php  ?>

  </div>
</div>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>

