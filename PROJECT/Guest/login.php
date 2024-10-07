<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_submit"]))
{
    $email = $_POST["txt_email"];
    $password = $_POST["txt_password"];
    
    $sel = "select * from tbl_admin where admin_email='".$email."' and admin_password='".$password."'";
    $res = $con->query($sel);
    
    $usel = "select * from tbl_user where user_email='".$email."' and user_password='".$password."'";
    $ures = $con->query($usel);
    
    $msel = "select * from tbl_rest where rest_email='".$email."' and rest_password='".$password."'";
    $mres = $con->query($msel);
    
    if($row = $res->fetch_assoc())
    {
        $_SESSION["aid"] = $row["admin_id"];
        $_SESSION["aname"] = $row["admin_name"];
        header("location:../Admin/AdminHome.php");
    }
    else if($row = $ures->fetch_assoc())
    {
        $_SESSION["uid"] = $row["user_id"];
        $_SESSION["uname"] = $row["user_name"];
        header("location:../User/UserHome.php");
    }
    else if($row = $mres->fetch_assoc())
    {
        $_SESSION["rid"] = $row["rest_id"];
        $_SESSION["rname"] = $row["rest_name"];
        header("location:../Restaurant/Homepage.php");
    }
    else
    {
        ?>
        <script>
        alert("Invalid Email or Password");
        </script>
        <?php
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Login 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Assets/Templates/Login/css/style.css">
  </head>
  <body class="img js-fullheight" style="background-image: url(../Assets/Templates/Login/images/bg.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Login #10</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Have an account?</h3>
                        <form action="" method="post" class="signin-form">
                            <div class="form-group">
                                <input type="text" name="txt_email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input id="password-field" type="password" name="txt_password" class="form-control" placeholder="Password" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btn_submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Remember Me
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#" style="color: #fff">Forgot Password</a>
                                </div>
                            </div>
                        </form>
                        <p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p>
                        <div class="social d-flex text-center">
                            <a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Facebook</a>
                            <a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Twitter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../Assets/Templates/Login/js/jquery.min.js"></script>
    <script src="../Assets/Templates/Login/js/popper.js"></script>
    <script src="../Assets/Templates/Login/js/bootstrap.min.js"></script>
    <script src="../Assets/Templates/Login/js/main.js"></script>
  </body>
</html>
