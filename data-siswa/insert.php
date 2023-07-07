<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}


require 'function.php';

$db = mysqli_connect("localhost", "root", "", "php-dasar");

if(isset($_POST["submit"])){
  
if(tambah($_POST) > 0){
    echo "<script>
    alert('Data Berhasil Ditambahkan');
    document.location.href = 'index.php';
        </script>";
}else{
    echo "<script>
    alert('Data Gagal Ditambahkan');
    document.location.href = 'index.php';
        </script>";
}
    
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Tambah Data</title>
</head>
<body>
<div class="container-fluid mt-4">
    <h1>Tambah Data Siswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nis">NIS : </label>
                <input type="text" name="Nis" id="nis" required>
            </li>
            <li>
                <label for="nama">NAMA : </label>
                <input type="text" name="Nama" id="nama" required>
            </li>
            <li>
            <label for="email">EMAIL : </label>
                <input type="text" name="Email" id="email" required>
            </li>
            <li>
            <label for="jurusan">JURUSAN : </label>
                <input type="text" name="Jurusan" id="jurusan" required>
            </li>
            <li>
            <label for="gambar">GAMBAR : </label>
                <input type="file" name="Gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">INSERT DATA</button>
            </li>
        </ul>
    
    </form>
    
    
    <a href="index.php">Kembali ke Table</a>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>
</html>