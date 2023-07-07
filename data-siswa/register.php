<?php 


require 'function.php';

if(isset($_POST["register"])){
        
    if(registrasi($_POST) > 0){
        echo "<script>
            alert('User Baru Berhasil Ditambahkan');
            window.location.href = 'login.php';
            </script>";

            exit;
    }else{
        echo mysqli_error($db);
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
    <title>Faust | Login</title>
</head>

<body>

    <div class="container-fluid">
    <h1> Halaman Registrasi </h1>
    <hr>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="Username" class="form-label">Username : </label>
                    <input type="username" class="form-control" name="Username" id="Username" aria-describedby="userHelp">
                </div>
                <div class="mb-3">
                    <label for="Password" class="form-label">Password : </label>
                    <input type="password" class="form-control" name="Password" id="Password">
                </div>
                <div class="mb-3">
                    <label for="Passwords" class="form-label">Confirm Password : </label>
                    <input type="password" class="form-control" name="Passwords" id="Passwords">
                </div>
                <button type="submit" class="btn btn-primary" name="register">Submit</button>
            </form>
        </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>