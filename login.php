<?php
session_start();
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook LogIn </title>
    <link href="bootstrap-5.0.2-dist\css\bootstrap.css" rel="stylesheet">
    <link href="fontawesome-free-6.1.1-web\css\all.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- Left Column -->
            <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-start px-5">
                <h1 class="text-primary fw-bold mb-4" style="font-size: 3.5rem;">facebook</h1>
                <p class="fs-4">Connect with friends and the world around you on Facebook.</p>
            </div>

             <!-- Right column with login  -->
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center px-5">
                <div class="card shadow-sm p-4 mb-4" style="width: 100%; max-width: 400px;">
                    
                    <form action="" method="post">
                        <div class="mb-3">
                            <input type="text" name="email" class="form-control form-control-lg" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" name="login" class="btn btn-primary btn-lg fw-bold">Log In</button>
                        </div>
                        <div class="text-center mb-3">
                            <a href="#" class="text-decoration-none">Forgot password?</a>
                        </div>
                        <hr>
                        <div class="d-grid">
                            <a href="signup.php" class="btn btn-success btn-lg fw-bold">
                                <button type="button" class="btn btn-success" ><b>Create new account</b></button>
                            </a>
                        </div>
                    </form>

                    <!-- starting of login  -->
                     <?php
                     if(isset($_POST['login'])){
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $query = mysqli_query($connect,"SELECT*FROM students WHERE email='$email' ");
                        if(mysqli_num_rows($query) == 1){
                            $user = mysqli_fetch_assoc($query);

                            if(password_verify($password,$user['password'])){
                             $_SESSION['user_email'] = $user['email'];
                             $_SESSION['user_id'] = $user['id'];
                             $_SESSION['firstname'] = $user['firstname'];
                             $_SESSION['lastname'] = $user['lastname'];
                            header("Location: dashboard.php");
                            exit;
                        }else{
                            echo "<script>alert('Incorrect password');</script>";
                        }
                    }else{
                        echo "<script>alert('Email not found');</script>";
                    }
                 }
                     ?>
                    <!-- Ending of login  -->
                </div>
                <div class="text-center mt-4">
                    <p class="mb-0"><a href="" class="text-decoration-none fw-bold">Create a Page</a> for a celebrity, brand or business.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>