<?php
session_start();
include "connect.php";

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>dashboard Page</title>
    <link href="bootstrap-5.0.2-dist\css\bootstrap.css" rel="stylesheet">
    <link href="fontawesome-free-6.1.1-web\css\all.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- header part  -->
<nav class="navbar navbar-light bg-white border-bottom fixed-top">
    <div class="container-fluid">

        <!-- LEFT Side -->
        <div class="d-flex align-items-center">
            <i class="fab fa-facebook fa-2x text-primary"></i>

            <div class="ms-3">
                <input type="text" class="form-control form-control-sm rounded-pill bg-light" 
                       placeholder="Search Facebook">
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div  class="d-md-flex gap-5" style="justify-content:center; margin-top:-30px; 
        align-items:center; width:100%;">
            
            <i class="fas fa-home fa-lg"></i>
            <i class="fas fa-tv fa-lg"></i>
            <i class="fas fa-store fa-lg"></i>
            <i class="fas fa-users fa-lg"></i>
            <i class="fas fa-gamepad fa-lg"></i>

            
        </div>
        
    </div>
                <a href="logout.php" class="btn btn-primary float-start" style="margin-left:90%; margin-top:-30px">Logout</a>
    
</nav>

<!-- SIDEBAR CONTENT  -->
<div class="container-fluid" style="padding-top: 70px;">
    <div class="row">

        <!-- LEFTSIDE  -->
        <div class="col-md-3 col-lg-2 bg-white border-end" 
             style="height:100vh; position:fixed; ">

            <ul class="list-group list-group-flush">
                <li class="list-group-item border-0">
                    <i class="fas fa-user-circle me-2"></i>
                    <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?>
                </li>

                <li class="list-group-item border-0">
                    <i class="fas">📊</i> dashboard
                </li>
                
            </ul>

            <hr>

            <p class="text-muted ms-3">Settings</p>
                <li class="list-group-item border-0">
                    <i class="fas">📊</i> Update
                </li>

                <li class="list-group-item border-0">
                    <i class="fas">📊</i> Delete
                </li>

           
        </div>

        <!-- displaying my student list  -->
        <div class="col-md-9 col-lg-10 offset-md-3 offset-lg-2">
            <div class="p-4">
                <h3>Student List</h3>
                <hr>

                <!-- starting  -->

                <div class="conatiner mt-5">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                          <?php
                            // Show message if exists
                            if (isset($_SESSION['message'])) {
                                echo "<div class='alert alert-success text-center'>" . $_SESSION['message'] . "</div>";
                                unset($_SESSION['message']);
                            } 
                            ?>

                            <tr>
                                <th>No</th>
                                <th>First Names</th>
                                <th>Last Names</th>
                                <th>Email</th>
                                <th>Date Of Birth</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>  
                            <?php
                            $select = mysqli_query($connect,"SELECT*FROM students");
                            if(mysqli_num_rows($select) > 0){
                                $count = 1;
                                while($rows=mysqli_fetch_assoc($select)){
                                    echo "<tr>";
                                    echo "<td>".$count."</td>";
                                    echo "<td>".$rows['firstname']."</td>";
                                    echo "<td>".$rows['lastname']."</td>";
                                    echo "<td>".$rows['email']."</td>";
                                    echo "<td>".$rows['dob']."</td>";
                                    echo "<td>".$rows['gender']."</td>";
                                    echo "<td>
                                            <a href='update.php?id=".$rows['id']."' class='btn btn-success btn-sm'>Update</a>
                                            <a href='delete.php?id=".$rows['id']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this student?\");'>Delete</a>
                                        </td>";
                                    echo "</tr>";
                                    $count++;
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <!-- ending of displaying table  -->

            </div>
        </div>

    </div>
</div>

</body>
</html>
