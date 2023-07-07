<?php 
$db = mysqli_connect("localhost", "root", "", "php-dasar");

function query($query){
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)):
        $rows[] = $row;
    endwhile;
    return $rows;
}

function tambah($data){
    global $db;
    $nama = htmlspecialchars($data["Nama"]);
    $nis = htmlspecialchars($data["Nis"]);
    $email = htmlspecialchars($data["Email"]); 
    $jurusan = htmlspecialchars($data["Jurusan"]);

    $gambar = upload();
    if(!$gambar){
        return false;
    }
    
    $query = "INSERT INTO siswa VALUES
                ('', '$nama', '$nis', '$email', '$jurusan', '$gambar')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
    

}

function upload(){
    $fileName = $_FILES['Gambar']['name'];
    $fileSize = $_FILES['Gambar']['size'];
    $error = $_FILES['Gambar']['error'];
    $tmpName = $_FILES['Gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('Pilih Gambar Terlebih Dahulu');
                </script>";
                return false;
    }

    $ekstentsiImages = ['jpg', 'jpeg', 'png'];
    $ekstentsiImage = explode('.', $fileName);
    $ekstentsiImage = strtolower(end($ekstentsiImage));

    if (!in_array($ekstentsiImage, $ekstentsiImages)) {
        echo "<script>
                alert('Yang anda upload bukan gambar');
                </script>";
                return false;
        return false;
    }

    if($fileSize > 1000000){
        echo "<script>
                alert('Ukuran gambar terlalu besar');
                </script>";
                return false;
    }

    $newFile = uniqid();
    $newFile .= '.';
    $newFile .= $ekstentsiImage;
    move_uploaded_file($tmpName, '../img/' . $fileName);
    return $fileName;
}

function delete($id){
    global $db;
    mysqli_query($db, "DELETE FROM siswa WHERE id = $id");
    return mysqli_affected_rows($db);
}

function update($data){
    global $db;
    $id = $data["Id"];
    $nama = htmlspecialchars($data["Nama"]);
    $nis = htmlspecialchars($data["Nis"]);
    $email = htmlspecialchars($data["Email"]); 
    $jurusan = htmlspecialchars($data["Jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if($_FILES['Gambar']['error'] === 4){
        $gambar = $gambarLama;
    }else{
        $gambar = upload();
    }

    $query = "UPDATE siswa SET
                Nis = '$nis', 
                Nama = '$nama',
                Email = '$email',
                Jurusan = '$jurusan',
                Gambar = '$gambar'
                WHERE Id = $id";


    mysqli_query($db, $query);
    return mysqli_affected_rows($db);

}

function search($keyword){
    $query = "SELECT * FROM siswa WHERE Nama LIKE '%$keyword%' OR 
                                        Nis LIKE '%$keyword%' OR 
                                        Jurusan LIKE '%$keyword%'";
    return query($query);
} 

function registrasi($data){
    global $db;
    $username = strtolower(stripslashes($data["Username"]));
    $password = mysqli_real_escape_string($db, $data["Password"]);
    $passwords = mysqli_real_escape_string($db, $data["Passwords"]);

    $result = mysqli_query($db, "SELECT Username FROM users WHERE Username = '$username'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('Username Sudah Terdaftar');
            </script>";
            return false;
    }

    if( $password !== $passwords){
        echo "<script>
                alert('Konfirmasi password tidak sesuai');
            </script>";
            return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($db, "INSERT INTO users VALUES('', '$username', '$password')");
    return mysqli_affected_rows($db);
}

?>