<?php
session_start();
if (isset($_SESSION['fullname'])) {
  header("Location:home.php");
}
include "koneksi.php";

if (isset($_POST['login'])) {

$phonenumber = $_POST['phonenumber'];
$password = $_POST['password'];

$query1x = mysqli_query($conn, "SELECT * FROM users WHERE phonenumber='".$phonenumber."'");
$rowname1x = mysqli_fetch_array($query1x);
$row1x = mysqli_num_rows($query1x);

if ($row1x == 1) {
  // $querypass = mysqli_query($conn, "SELECT * FROM users WHERE phonenumber='".$phonenumber."' AND password='".$password."'");
  $verifypw = password_verify($password, $rowname1x['password']);
  // $rowpass = mysqli_num_rows($querypass);
  if ($verifypw==1) {
    $notiflgn = "Login Successfully...";
    $_SESSION['fullname'] = $rowname1x['fullname'];
    header("refresh:1;home.php");
  } else {
    $notif = "Incorrect Password!";
  }
} elseif (empty($phonenumber)) {
  $notif = "Field can't be empty!";
} else {
  $notif = "Phone Number not yet registered.";
}
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Goreen</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 mt-4">
          <div class="card shadow-lg rounded ">
            <div class="card-body">
                <div class="position-static text-center mt-3">
                    <img class="img-fluid" src="loginpict.svg" alt="loginpict">
                </div>
                <div class="position-absolute goreenlogo">
                    <img class="img-fluid" src="goreenlogo.svg" alt="goreenlogo">
                </div>
                <div class="position-static welcome">
                    <h1 class="welcm">Hey, Welcome!</h1>
                    <p class="subtitle">Discover your transportation need with this super apps.</p>
                    <?php
                    if (isset($notif)) {
                    ?>
                    <small class="notif"><?=$notif?></small>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($notiflgn)) {
                    ?>
                    <small class="notiflgn"><?=$notiflgn?></small>
                    <?php
                    }
                    ?>
                </div>
              <form method="post" class="">
                <input class="form-control mt-2" type="text" name="phonenumber" placeholder="Phone Number" autocomplete="off" value="<?php echo isset($phonenumber) ? $phonenumber : '' ?>"/>
                <input class="form-control mt-3" type="password" name="password" placeholder="Password" />
                <div class="d-grip gap-2 mb-3">
                    <button class="login btn btn-success button-hijau col-10 shadow-lg" name="login" type="submit">Log In</button>
                    <a href="register.php" class="login2 btn btn-outline-success button-hijau-focus col-10 shadow-lg" type="button">Sign Up with Phone number</a>
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
