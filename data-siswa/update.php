<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'function.php';

$id = $_GET["Id"];
$student = query("SELECT * FROM siswa WHERE id = $id")[0];

if(isset($_POST["submit"])){
  
if(update($_POST) > 0){
    echo "<script>
    alert('Data Berhasil Diubah');
    document.location.href = 'index.php';
        </script>";
}else{
    echo "<script>
    alert('Data Gagal Diubah');
    document.location.href = 'index.php';
        </script>";
};
    
};


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Ubah Data</title>
</head>
<body>
<div class="container-fluid mt-4">
    <h1>Tambah Data Siswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="Id" value="<?= $student["Id"];?>">
        <input type="hidden" name="gambarLama" value="<?= $student["Gambar"];?>">
        <ul>
            <li>
                <label for="nis">NIS : </label>
                <input type="text" name="Nis" id="nis" required value="<?= $student["Nis"];?>">
            </li>
            <li>
                <label for="nama">NAMA : </label>
                <input type="text" name="Nama" id="nama" value="<?= $student["Nama"];?>">
            </li>
            <li>
            <label for="email">EMAIL : </label>
                <input type="text" name="Email" id="email" value="<?= $student["Email"];?>">
            </li>
            <li>
            <label for="jurusan">JURUSAN : </label>
                <input type="text" name="Jurusan" id="jurusan" value="<?= $student["Jurusan"];?>">
            </li>
            <li>
                <label for="gambar">GAMBAR : </label> <br>
                <img src="../img/<?= $student['Gambar']; ?>" width="115px"> <br>
                <input type="file" name="Gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">UBAH DATA</button>
            </li>
        </ul>
    
    </form>
    <a href="index.php">Back to table</a>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

</body>
</html>