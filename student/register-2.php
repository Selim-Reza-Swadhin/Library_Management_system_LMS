<!--form fields empty when submit button-->


<?php
require_once '../db_conn.php';
?>

<?php
if (isset($_POST['student_register'])){
    //print_r($_POST);
    //var_dump($_POST);

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $roll = $_POST['roll'];
    $reg_no = $_POST['reg_no'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    $input_errors = array();
    if (empty($fname)){
        //echo 'test';
        $input_errors['fname'] = "First name field is required !";
    }
    if (empty($lname)){
        $input_errors['lname'] = "Last name field is required !";
    }
    if (empty($roll)){
        $input_errors['roll'] = "Roll field is required !";
    }
    if (empty($reg_no)){
        $input_errors['reg_no'] = "Reg field is required !";
    }
    if (empty($email)){
        $input_errors['email'] = "Email field is required !";
    }
    if (empty($username)){
        $input_errors['username'] = "Username field is required !";
    }
    if (empty($password)){
        $input_errors['password'] = "Password field is required !";
    }
    if (empty($phone)){
        $input_errors['phone'] = "Phone field is required !";
    }
    //var_dump($input_errors);
    //echo count($input_errors);

    if (count($input_errors) == 0){
        $check_email = "SELECT * FROM students WHERE email= '$email'";
        $email_exist = mysqli_query($conn, $check_email);
        var_dump($email_exist);

      /*  $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO students(fname, lname, roll, reg_no, email, username, password, phone, status) VALUES ('$fname', '$lname', '$roll', '$reg_no', '$email', '$username', '$password_hash', '$phone', '0')";
        $result = mysqli_query($conn, $query);
        if ($result){
            $success = "Registration successfully.";
        }else{
            $error = "Registration not success.";
        }*/
    }




}
?>

<!doctype html>
<html lang="en" class="fixed accounts sign-in">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Library Management system LMS</title>
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
            <h1 class="text-center text-success">REGISTRATION LMS</h1>

<!--Registration success message-->
            <?php
            if (isset($success)){?>
            <div class="alert alert-success" role="alert">
                <?= $success;?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           <?php } ?>

<!-- Registration error message-->
            <?php
            if (isset($error)){?>
            <div class="alert alert-danger" role="alert">
                <?= $error;?>
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
                      <?//= $_SERVER['PHP_SELF']; ?>
                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="fname" placeholder="First Name">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                            /*if (isset($input_errors)){//wrong
                                echo $input_errors;
                            }*/
                            if (isset($input_errors['fname'])){
                                echo '<span class="input_error">'.$input_errors['fname'].'</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="lname" placeholder="Last Name">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                            if (isset($input_errors['lname'])){
                                echo '<span class="input_error">'.$input_errors['lname'].'</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="roll" placeholder="Roll" pattern="[0-9]{6}">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                            if (isset($input_errors['roll'])){
                                echo '<span class="input_error">'.$input_errors['roll'].'</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="reg_no" placeholder="Reg NO." pattern="[0-9]{6}">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                            if (isset($input_errors['reg_no'])){
                                echo '<span class="input_error">'.$input_errors['reg_no'].'</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <?php
                            if (isset($input_errors['email'])){
                                echo '<span class="input_error">'.$input_errors['email'].'</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="username" placeholder="Username">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                            if (isset($input_errors['username'])){
                                echo '<span class="input_error">'.$input_errors['username'].'</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <i class="fa fa-key"></i>
                            </span>
                            <?php
                            if (isset($input_errors['password'])){
                                echo '<span class="input_error">'.$input_errors['password'].'</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" name="phone" placeholder="Phone 01[3|4|5|6|7|8|9][0-9]{8}" pattern="01[3|4|5|6|7|8|9][0-9]{8}">
                                <i class="fa fa-mobile-phone fa-2x"></i>
                            </span>
                            <?php
                            if (isset($input_errors['phone'])){
                                echo '<span class="input_error">'.$input_errors['phone'].'</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary btn-block" type="submit" name="student_register" value="Register">
                        </div>
                        <div class="form-group text-center">
                            Have an account?, <a href="sign-in.php">Sign In</a>
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
