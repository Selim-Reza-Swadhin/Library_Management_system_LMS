<?php
require_once '../db_conn.php';
session_start();
if (isset($_SESSION['students_login'])){
    header('Location: index.php');
    exit();
}
?>

<?php
if (isset($_POST['student_register'])) {
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
    $photo = "lib_image/avatar.jpg";

    $input_errors = array();
    if (empty($fname)) {
        //echo 'test';
        $input_errors['fname'] = "First name field is required !";
    }
    if (empty($lname)) {
        $input_errors['lname'] = "Last name field is required !";
    }
    if (empty($roll)) {
        $input_errors['roll'] = "Roll field is required !";
    }
    if (empty($reg_no)) {
        $input_errors['reg_no'] = "Reg field is required !";
    }
    if (empty($email)) {
        $input_errors['email'] = "Email field is required !";
    }
    if (empty($username)) {
        $input_errors['username'] = "Username field is required !";
    }
    if (empty($password)) {
        $input_errors['password'] = "Password field is required !";
    }
    if (empty($phone)) {
        $input_errors['phone'] = "Phone field is required !";
    }
    //var_dump($input_errors);
    //echo count($input_errors);

    if (count($input_errors) == 0) {
        $chk_email = "SELECT * FROM students WHERE email= '$email'";
        $email_exist = mysqli_query($conn, $chk_email);
        //var_dump($email_exist);
        $email_check_row = mysqli_num_rows($email_exist);
        //echo $email_check_row;
        if ($email_check_row == 0) {
            //echo 'yes';
            $username_check = "SELECT * FROM students WHERE username= '$username'";
            $uname_exist = mysqli_query($conn, $username_check);
            $uname_check_row = mysqli_num_rows($uname_exist);
            if ($uname_check_row == 0) {
                //echo 'yes';
                $uname_count = strlen($username);
                if ($uname_count >= 6) {
                    //echo 'yes';
                    $pass_count = strlen($password);
                    if ($pass_count >= 6) {
                        //echo 'yes';
                        $phone_check = "SELECT * FROM students WHERE phone= '$phone'";
                        $phone_exist = mysqli_query($conn, $phone_check);
                        $phone_check_row = mysqli_num_rows($phone_exist);
                        if ($phone_check_row == 0) {
                            //echo 'yes';
                            $phone_count = strlen($phone);
                            if ($phone_count == 11) {
                                //echo 'yes';
                                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                                //$query = "INSERT INTO students(fname, lname, roll, reg_no, email, username, password, phone, status) VALUES ('$fname', '$lname', '$roll', '$reg_no', '$email', '$username', '$password_hash', '$phone', '0')";
                                $query = "INSERT INTO students(fname, lname, roll, reg_no, email, username, password, phone, image, status) VALUES ('$fname', '$lname', '$roll', '$reg_no', '$email', '$username', '$password_hash', '$phone', '$photo', '0')";
                                $result = mysqli_query($conn, $query);
                                if ($result) {
                                    //$success = "Registration successfully.";
                                    header('Location: sign-in.php?registration=success');
                                    //header('Location: index.php?dashboard=success');
                                    //exit();
                                } else {
                                    $error = "Registration not success.";
                                }
                            } else {
                                $phone_length = "This $phone is $phone_count characters. Need 11 characters.";
                            }
                        } else {
                            $phone_al_exist = "This $phone already exists.";
                        }
                    } else {
                        $password_length = "This $password is $pass_count characters. Need 6 characters or upper.";
                    }
                } else {
                    $username_length = "This $username is $uname_count characters. Need 6 characters or upper.";
                }
            } else {
                $username_al_exist = "This $username already exists.";
            }

        } else {
            $email_al_exist = "This $email already exists.";
        }

    }


}
?>

<!doctype html>
<html lang="en" class="fixed accounts sign-in">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
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
            if (isset($success)) {
                ?>
                <div class="alert alert-success" role="alert">
                    <?= $success; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            <!-- Registration error message-->
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

            <!-- Registration email already exist message-->
            <?php
            if (isset($email_al_exist)) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= $email_al_exist; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            <!-- Registration username already exist message-->
            <?php
            if (isset($username_al_exist)) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= $username_al_exist; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            <!-- Registration username length message-->
            <?php
            if (isset($username_length)) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= $username_length; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            <!-- Registration password length message-->
            <?php
            if (isset($password_length)) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= $password_length; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            <!-- Registration phone already exist message-->
            <?php
            if (isset($phone_al_exist)) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= $phone_al_exist; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            <!-- Registration phone length message-->
            <?php
            if (isset($phone_length)) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= $phone_length; ?>
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
                                <input type="text" class="form-control" name="fname" placeholder="First Name"
                                       value="<?= isset($fname) ? $fname : ''; ?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                            /*if (isset($input_errors)){//wrong
                                echo $input_errors;
                            }*/
                            if (isset($input_errors['fname'])) {
                                echo '<span class="input_error">' . $input_errors['fname'] . '</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="lname" placeholder="Last Name"
                                       value="<?= isset($lname) ? $lname : ''; ?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                            if (isset($input_errors['lname'])) {
                                echo '<span class="input_error">' . $input_errors['lname'] . '</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="roll" placeholder="Roll [0-9]{6}"
                                       pattern="[0-9]{6}" value="<?= isset($roll) ? $roll : ''; ?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                            if (isset($input_errors['roll'])) {
                                echo '<span class="input_error">' . $input_errors['roll'] . '</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="reg_no" placeholder="Reg NO. [0-9]{6}"
                                       pattern="[0-9]{6}" value="<?= isset($reg_no) ? $reg_no : ''; ?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                            if (isset($input_errors['reg_no'])) {
                                echo '<span class="input_error">' . $input_errors['reg_no'] . '</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="email" class="form-control" name="email" placeholder="Email"
                                       value="<?= isset($email) ? $email : ''; ?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <?php
                            if (isset($input_errors['email'])) {
                                echo '<span class="input_error">' . $input_errors['email'] . '</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="username" placeholder="Username"
                                       value="<?= isset($username) ? $username : ''; ?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                            if (isset($input_errors['username'])) {
                                echo '<span class="input_error">' . $input_errors['username'] . '</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                       value="<?= isset($password) ? $password : ''; ?>">
                                <i class="fa fa-key"></i>
                            </span>
                            <?php
                            if (isset($input_errors['password'])) {
                                echo '<span class="input_error">' . $input_errors['password'] . '</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="number" class="form-control" name="phone"
                                       placeholder="Phone 01[3|4|5|6|7|8|9][0-9]{8}" pattern="01[3|4|5|6|7|8|9][0-9]{8}"
                                       value="<?= isset($phone) ? $phone : ''; ?>">
                                <i class="fa fa-mobile-phone fa-2x"></i>
                            </span>
                            <?php
                            if (isset($input_errors['phone'])) {
                                echo '<span class="input_error">' . $input_errors['phone'] . '</span>';
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary btn-block" type="submit" name="student_register"
                                   value="Register">
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
