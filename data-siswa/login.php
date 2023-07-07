<?php
session_start();
require 'function.php';

if(isset($_COOKIE['id']) && (isset($_COOKIE['key']))){
   $id = $_COOKIE['id'];
   $key = $_COOKIE['key'];

   $result = mysqli_query($db, "SELECT Username FROM Users WHERE Id = '$id'");
   $row = mysqli_fetch_assoc($result);

   if ($key === hash('sha256', $row['Username'])) {
    $_SESSION['login'] = true;
   }

}

if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    
    $username = $_POST["Username"];
    $password = $_POST["Password"];

    $result = mysqli_query($db, "SELECT * FROM users WHERE Username = '$username'");

    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["Password"])){
            $_SESSION["login"] = true;

            if(isset($_POST["remember"])){
                setcookie('id', $row['Id'], time()+60);
                setcookie('key', hash('sha256', $row['Username']));
                time()+60;
            }

            header("location: index.php");
            exit;
        }
    }

    $error = true;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faust | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h5>Halaman Login</h5>

        <?php if (isset($error)): ?>
            <p style="color: red; font-style: italic;">username / password salah</p>
         <?php endif ?>   
        <form action="" method="post" style="width: 500px;">
            <div class="mb-3">
                <label for="username" class="form-label">Username :</label>
                <input type="text" class="form-control" name="Username" id="username" aria-describedby="textHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password :</label>
                <input type="password" class="form-control" name="Password" id="password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me <meta http-equiv="X-UA-Compatible" content="ie=edge"></label>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Submit</button>
        </form>
        <a href="register.php">Sign Up</a>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>