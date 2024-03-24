<?php
session_start();
include 'koneksi.php';

$fotoid = $_POST['FotoID'];
$userid = $_SESSION['UserID'];
$isikomentar = $_POST['IsiKomentar'];
$tanggalkomentar = date('Y-m-d');

$query = mysqli_query($koneksi,"INSERT INTO komentarfoto VALUES('','$fotoid','$userid','$isikomentar','$tanggalkomentar')");

echo "<script>
location.href='../admin/index.php';
</script>";

?>