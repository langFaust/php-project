<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}


require 'function.php';

$jumlahDataHalaman = 5;

$jumlahData = count(query("SELECT * FROM siswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataHalaman);
$halamanAktif = (isset($_GET["halaman"]) ? $_GET["halaman"] : 1);
$awalData = ($jumlahDataHalaman * $halamanAktif) - $jumlahDataHalaman;



$siswa = query("SELECT * FROM siswa ORDER BY Nama ASC LIMIT $awalData, $jumlahDataHalaman");

if(isset($_POST["search"])) {
    $siswa = search($_POST["keyword"]);
    
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
    <title>Data Siswa</title>
</head>

<body>
    <div class="container">
        <h1> Daftar Siswa</h1>
        <a href="insert.php">Tambah data Mahasiswa</a> <br> <br>

        <form action="" method="post">
            <input type="text" name="keyword" size="30" autofocus placeholder="Masukkan keyword..." autocomplete="off">
            <button type="submit" name="search">Search!</button>
        </form>


        <div class="pagination">
        <?php  if( $halamanAktif > 1 ):  ?>
            <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">Previous</a>
        <?php endif; ?>    



            <?php for($i = 1; $i <= $jumlahHalaman; $i++):  ?>

            <?php if($i == $halamanAktif ): ?>
            <a class="page-link d-inline" style="font-weight: bold; color: red;"
                href="?halaman=<?=  $i ?>"><?=  $i ?></a>
            <?php else: ?>
            <a class="page-link" href="?halaman=<?=  $i ?>"><?=  $i ?></a>
            <?php endif; ?>
            <?php  endfor; ?>
            <?php  if( $halamanAktif < $jumlahHalaman ):  ?>
            <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">Next</a>
         <?php endif; ?>
        </div>
        <br>

        <table border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Nis</th>
                <th>Jurusan</th>
                <th>Email</th>
            </tr>
            <tr>
                <?php $i=1; ?>
                <?php  foreach($siswa as $row): ?>
                <td><?php echo $i + $awalData;?></td>
                <td>
                    <a href="update.php?Id=<?= $row["Id"];?>">edit</a> |
                    <a href="delete.php?Id=<?= $row["Id"];?>"
                        onclick="return confirm('apakah anda yakin ingin menghapus?');">hapus</a>
                </td>
                <td><img src="../img/<?= $row["Gambar"]; ?>" width="50px"></td>
                <td><?php echo $row["Nama"]; ?></td>
                <td><?php echo $row["Nis"]; ?></td>
                <td><?php echo $row["Jurusan"]; ?></td>
                <td><?php echo $row["Email"]; ?></td>
            </tr>
            <?php $i++;?>
            <?php endforeach; ?>
        </table>
        <a href="register.php" class="btn btn-primary mt-1">SIGN UP</a>
        <a href="logout.php" class="btn btn-primary mt-1">LOGOUT</a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
