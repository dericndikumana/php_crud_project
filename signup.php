<?php
session_start();
include "connect.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook SingUp</title>
     <link href="bootstrap-5.0.2-dist\css\bootstrap.css" rel="stylesheet">
    <link href="fontawesome-free-6.1.1-web\css\all.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center min-vh-100">
            <div class="col-md-6 col-lg-5 my-5">
                <!-- header  -->
                <div class="text-center mb-4">
                    <h1 class="text-primary fw-bold mb-4" style="font-size: 3.5rem;">facebook</h1>
                    <h2 class="mb-4">Create a new account</h2>
                </div>
                
                <!-- Signup Form -->
                <div class="card shadow-sm p-4">
                    <form action="" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="text" name="firstname" class="form-control" placeholder="First name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="lastname" class="form-control" placeholder="Last name" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <input type="email"name="email" class="form-control" placeholder="email" required>
                        </div>

                        <div class="mb-3">
                            <input type="date" name="dob" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="password" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="cpassword" class="form-control" placeholder="Confirm password" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender</label><br>
                            <input type="radio" name="gender" value="female">Female
                            <input type="radio" name="gender" value="male">Male
                        </div>
                        
                        <div class="mb-3">
                            <p class="small text-muted">
                                People who use our service may have uploaded your contact information to Facebook. 
                                <a href="#" class="text-decoration-none">Learn more</a>.
                            </p>
                        </div>
                        
                        <div class="mb-3">
                            <p class="small text-muted">
                                By clicking Sign Up, you agree to our 
                                <a href="#" class="text-decoration-none">Terms</a>, 
                                <a href="#" class="text-decoration-none">Privacy Policy</a> and 
                                <a href="#" class="text-decoration-none">Cookies Policy</a>.
                                You may receive SMS notifications from us and can opt out any time.
                            </p>
                        </div>

                         <div class="row mb-3">
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-success form-control fw-bold">Sign Up</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success form-control fw-bold">Sign Up With Google</button>
                            </div>
                        </div>
                        
                        
                        <div class="text-center">
                            <a href="login.php" class="text-decoration-none">Already have an account?</a>
                        </div>
                    </form>

                    <!-- starting signup  -->
                     <?php
                     if(isset($_POST['submit'])){
                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $email = $_POST['email'];
                        $dob = $_POST['dob'];
                        $password = $_POST['password'];
                        $confirm = $_POST['cpassword'];
                        $gender = $_POST['gender'];

                        $hashed = password_hash($password,PASSWORD_DEFAULT);

                        if(strlen($password) < 6){
                                echo "<script>alert('Password must be at least 6 characters');</script>";
                                exit;
                            }

                            if($confirm !== $password){
                                echo "<script>alert('Confirm password is not the same as password');</script>";
                                exit;
                            }

                            // checking email 
                            // $check = mysqli_query($connect,"SELECT*FROM students where email = '$email'");
                            // if(mysqli_num_row($check) > 0){
                            //     echo "<script>alert('Email arleady registered');</script>";
                            //     exit;
                            // }

                            $insert = mysqli_query($connect,"INSERT INTO students(firstname,lastname,email,dob,password,gender) values('$firstname','$lastname','$email','$dob','$hashed','$gender')");
                            if ($insert) {
                                $_SESSION['user_email'] = $email;
                            echo "<script>
                            alert('Student well inserted successfully!');
                            window.location='login.php';
                            </script>";
                            exit;
                        } else {
                            echo "<script>alert('Student not inserted');</script>";
                        }
                        
                     }
                     ?>

                    <!-- end of making signup -->

                </div>
            </div>
        </div>
    </div>
</body>
</html>