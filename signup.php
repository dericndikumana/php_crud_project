<?php
session_start();
include "connect.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook SignUp</title>
    <link href="bootstrap-5.0.2-dist\css\bootstrap.css" rel="stylesheet">
    <link href="fontawesome-free-6.1.1-web\css\all.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center min-vh-100">
            <div class="col-md-6 col-lg-5 my-5">
                <!-- Header -->
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
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>

                        <div class="mb-3">
                            <input type="date" name="dob" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender</label><br>
                            <input type="radio" name="gender" value="female" required> Female
                            <input type="radio" name="gender" value="male" required> Male
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-success form-control fw-bold">Sign Up</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-success form-control fw-bold">Sign Up With Google</button>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <a href="login.php" class="text-decoration-none">Already have an account?</a>
                        </div>
                    </form>

                    <?php
                    if(isset($_POST['submit'])){
                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $email = $_POST['email'];
                        $dob = $_POST['dob'];
                        $password = $_POST['password'];
                        $confirm = $_POST['cpassword'];
                        $gender = $_POST['gender'];

                        if(strlen($password) < 6){
                            echo "<script>alert('Password must be at least 6 characters');</script>";
                            exit;
                        }

                        if($confirm !== $password){
                            echo "<script>alert('Confirm password is not the same as password');</script>";
                            exit;
                        }

                        // Check if email already exists
                        $check = mysqli_query($connect,"SELECT * FROM students WHERE email = '$email'");
                        if(mysqli_num_rows($check) > 0){
                            echo "<script>alert('Email already registered');</script>";
                            exit;
                        }

                        // Hash password
                        $hashed = password_hash($password,PASSWORD_DEFAULT);

                        // Insert into database
                        $insert = mysqli_query($connect,"INSERT INTO students(firstname,lastname,email,dob,password,gender) VALUES ('$firstname','$lastname','$email','$dob','$hashed','$gender')");

                        if ($insert) {
                            // Do NOT set session here; login will handle session
                            echo "<script>
                                alert('Student registered successfully!');
                                window.location='login.php';
                            </script>";
                            exit;
                        } else {
                            echo "<script>alert('Error inserting student');</script>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
