<?php
require_once '../db_conn.php';
session_start();
if (isset($_SESSION['students_login'])){
    header('Location: index.php');
    exit();
}

if (isset($_POST['sublogin'])){
    //var_dump($_POST);
    $username_email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM students WHERE email='$username_email' OR username='$username_email'";//password is password_verify($password, $row['password'])
    $result = mysqli_query($conn, $query);
    //var_dump($result);
    //$row = mysqli_fetch_assoc($result);
    //var_dump($row);
    if (mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
            //password check
        if (password_verify($password, $row['password'])){
            //echo 'yes';
            //status check
            if ($row['status'] == 1){
                //echo 'yes';
                $_SESSION['students_login'] = $username_email;
                //$_SESSION['students_login'] = $row['email'];
                $_SESSION['students_username'] = $row['username'];
                $_SESSION['students_fname'] = $row['fname'];
                $_SESSION['students_image'] = $row['image'];
                $_SESSION['students_iid'] = $row['id'];
                //header('Location: index.php?dashboard=success');
                header('Refresh: 10;url=index.php');
                echo 'You will be redirected in 10 seconds...';
                exit();




            }else{
                $error = "$username_email Your status not active";
            }
        }else{
            $error = "$password Password invalid!";
        }
    }else{
        $error = "$username_email not found!";
    }
}
?>

<!doctype html>
<html lang="en" class="fixed accounts sign-in">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Library Management system-LMS</title>
    <link rel="apple-touch-icon" sizes="120x120" href="../assets/favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/stylesheets/css/style.css">
</head>

<body class="bg-info">
<div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LOGO-->
        <div class="logo">
<!--            <img alt="logo" src="../assets/images/logo-dark.png" />-->
            <h1 class="text-center">LOGIN LMS</h1>

            <!-- Login error message-->
            <?php
            if (isset($error)) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
        </div>
        <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">
                    <? //= $_SERVER['PHP_SELF']; ?>
                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="email" placeholder="Username Or Email" value="<?= isset($username_email) ? $username_email : ''; ?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <i class="fa fa-key"></i>
                            </span>
                        </div>


                        <div class="form-group">
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="remember-me" value="option1" checked>
                                <label class="check" for="remember-me">Remember me</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary btn-block" type="submit" name="sublogin" value="Sign in">
                        </div>
                        <div class="form-group text-center">
                            <a href="pages_forgot-password.html">Forgot password?</a>
                            <hr/>
                             <span>Don't have an account?</span>
                            <a href="register.php" class="btn btn-block mt-sm">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
<!--BASIC scripts-->
<!-- ========================================================= -->
<script src="../assets/vendor/jquery/jquery-1.12.3.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/vendor/nano-scroller/nano-scroller.js"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<script src="../assets/javascripts/template-script.min.js"></script>
<script src="../assets/javascripts/template-init.min.js"></script>
<!-- SECTION script and examples-->
<!-- ========================================================= -->
</body>

</html>

