<?php
session_start();
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
  <style>
    body {
      background-image: url('../assets/bg3.jpg');
      background-size: cover;
    }

  .navbar {
      background-color: transparent;
      background-size: cover;
      padding: 1rem;
    }

   .card-body{
    background-color: skyblue;
   }

   .form-control{
    border-color: blue;
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

<div class="container">
    <div class="row">
        <div class="col-md-4">
         <div class="card mt-2">
            <div class="card-header text-black" style="background-color: #0066ff;">Tambah Album</div>
            <div class="card-body">
                <form action="../config/aksi_album.php" method="POST">
                  <label class="form-label">Nama Album</label>
                  <input type="text" name="NamaAlbum" class="form-control" required>
                  <label class="form-label">Deskripsi</label>
                  <textarea class="form-control" name="Deskripsi" required></textarea>
                  <button type="submit" class="btn btn-primary mt-2" name="tambah">Tambah Data</button>
                </form>
             </div>
           </div>
          </div>
        <div class="col-md-8">
            <div class="card mt-2">
                <div class="card-header text-black" style="background-color: #0066ff;">Data Album</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>  
                                <th>#</th>
                                <th>Nama Album</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $userid = $_SESSION['UserID'];
                            $sql = mysqli_query($koneksi, "SELECT * FROM album WHERE UserID=$userid"); 
                             while($data = mysqli_fetch_array($sql)){
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['NamaAlbum'] ?></td>
                                <td><?php echo $data['Deskripsi'] ?></td>
                                <td><?php echo $data['TanggalDibuat'] ?></td>
                                <td>               
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['AlbumID'] ?>">
       Edit
      </button>

    <div class="modal fade" id="edit<?php echo $data['AlbumID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="border: 2px solid blue;">
          <div class="modal-header" style="background-color: skyblue;">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
            <div class="modal-body">
        <form action="../config/aksi_album.php" method="POST">
            <input type="hidden" name="AlbumID" value="<?php echo $data['AlbumID'] ?>">
              <label class="form-label">Nama Album</label>
                <input type="text" name="NamaAlbum" value="<?php echo $data['NamaAlbum'] ?>" class="form-control" required>
                 <label class="form-label">Deskripsi</label>
                 <textarea class="form-control" name="Deskripsi" required>
                    <?php echo $data['Deskripsi'] ?>
                             </textarea>   
                             
            </div>
          <div class="modal-footer">
        <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
         </form>
          </div>
           </div>
            </div>
             </div>
               
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['AlbumID'] ?>">
       Hapus
      </button>

    <div class="modal fade" id="hapus<?php echo $data['AlbumID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="border: 2px solid red;">
          <div class="modal-header" style="background-color: orangered;">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
            <div class="modal-body">
        <form action="../config/aksi_album.php" method="POST">
            <input type="hidden" name="AlbumID" value="<?php echo $data['AlbumID'] ?>">
            Apakah Yakin <a style="color:red;">MENGHAPUS</a> Data Ini <strong> <?php echo $data['NamaAlbum'] ?> </strong> ?
           
           </div>
          <div class="modal-footer">
        <button type="submit" name="hapus" class="btn btn-danger">Hapus Data</button>
         </form>
          </div>
           </div>
            </div>
             </div>

              </td>
               </tr>
                 <?php } ?>
               </tbody>
              </table>
             </div>
           </div>
         </div>
       </div>
     </div>


<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>