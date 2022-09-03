<?php
session_start();
if (isset($_SESSION['fullname'])) {
  header("Location:home.php");
}
include "koneksi.php";

if (isset($_POST['register'])) {

$fullname = $_POST['fullname'];
$phonenumber = $_POST['phonenumber'];
$password = $_POST['password'];

$query1x = mysqli_query($conn, "SELECT * FROM users WHERE phonenumber='".$phonenumber."'");
$fetch1x = mysqli_fetch_array($query1x);
$row1x = mysqli_num_rows($query1x);

if ($row1x == 1) {
    $notif = "Phone Number already registered.";
} elseif (empty($fullname)) {
    $notif = "Field can't be empty!";
  }
  elseif (empty($phonenumber)) {
    $notif = "Field can't be empty!";
  }
  elseif (empty($password)) {
    $notif = "Field can't be empty!";
  }else{
    $hashpw = password_hash($password, PASSWORD_DEFAULT);
    $queryreg = mysqli_query($conn, "INSERT INTO users (fullname, phonenumber, password) VALUES ('$fullname', '$phonenumber', '$hashpw')");
    if ($queryreg) {
        $notifreg = true;
    }
  }
}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Goreen</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 mt-2">
          <div class="card shadow-lg rounded ">
            <div class="card-body">
                <div class="position-static text-center mt-3">
                    <img class="img-fluid" src="loginpict.svg" alt="loginpict">
                </div>
                <div class="position-absolute goreenlogo">
                    <img class="img-fluid" src="goreenlogo.svg" alt="goreenlogo">
                </div>
                <div class="position-static welcome">
                    <h1 class="welcm">Register here!</h1>
                    <p class="subtitle">Get best apps for your transportation need here.</p>
                    <?php
                    if (isset($notif)) {
                    ?>
                    <small class="notif"><?=$notif?></small>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($notifreg)) {
                    ?>
                    <small class="notiflgn">Registration successful. <a href="login.php" style="text-decoration: none;"> <strong>Login</strong></a></small>
                    <?php
                    }
                    ?>
                </div>
              <form method="post" class="">
                <input class="form-control mt-2" type="text" name="fullname" placeholder="Full Name" autocomplete="off" value="<?php echo isset($fullname) ? $fullname : '' ?>"/>
                <input class="form-control mt-2" type="text" name="phonenumber" placeholder="Phone Number" autocomplete="off" value="<?php echo isset($phonenumber) ? $phonenumber : '' ?>"/>
                <input class="form-control mt-2" type="password" name="password" placeholder="Password" />
                <div class="d-grip gap-2 mb-3">
                    <button class="login btn btn-success button-hijau col-10 shadow-lg" name="register" type="submit">Register</button>
                    <a href="login.php" class="login2 btn btn-outline-success button-hijau-focus col-10 shadow-lg" type="button">Already have an account</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
