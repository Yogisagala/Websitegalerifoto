<?php
session_start();
include 'koneksi.php';
$fotoid = $_GET ['FotoID'];
$userid = $_SESSION['UserID'];

$ceksuka = mysqli_query($koneksi,"SELECT * FROM dislikefoto WHERE FotoID='$fotoid' AND UserID='$userid'");

if (mysqli_num_rows($ceksuka) == 1) {
    while($row = mysqli_fetch_array($ceksuka)){
        $dislikeid = $row['DislikeID'];
        $query = mysqli_query($koneksi, "DELETE FROM dislikefoto WHERE DislikeID='$dislikeid'");
       echo "<script>
       location.href='../admin/index.php';
       </script>";
    }
}else{
    $tanggaldislike = date('Y-m-d');
    $query = mysqli_query ($koneksi,"INSERT INTO dislikefoto VALUES('','$fotoid','$userid','$tanggaldislike')");
    
    echo "<script>
    location.href='../admin/index.php';
    </script>";
}

?>