<?php
session_start();
include "connect.php";

// Make sure user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

// Check if id is provided
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

// Fetch student data
$student_query = mysqli_query($connect, "SELECT * FROM students WHERE id='$id'");
if (mysqli_num_rows($student_query) == 0) {
    header("Location: dashboard.php");
    exit;
}

$student = mysqli_fetch_assoc($student_query);

if (isset($_POST['update'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    $update_query = mysqli_query($connect, "UPDATE students SET firstname='$firstname', lastname='$lastname', email='$email', dob='$dob', gender='$gender' WHERE id='$id'");

    if ($update_query) {
        // Set a session message to show on dashboard
        $_SESSION['message'] = "Student well updated";
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Error updating student";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link href="bootstrap-5.0.2-dist/css/bootstrap.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h3 class="mb-4">Update Student</h3>
                <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                <form method="POST">
                    <div class="mb-3">
                        <input type="text" name="firstname" class="form-control" value="<?= htmlspecialchars($student['firstname']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="lastname" class="form-control" value="<?= htmlspecialchars($student['lastname']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($student['email']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="date" name="dob" class="form-control" value="<?= htmlspecialchars($student['dob']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Gender</label><br>
                        <input type="radio" name="gender" value="female" <?= $student['gender']=='female' ? 'checked' : '' ?>> Female
                        <input type="radio" name="gender" value="male" <?= $student['gender']=='male' ? 'checked' : '' ?>> Male
                    </div>
                    <button type="submit" name="update" class="btn btn-success form-control">Update</button>
                </form>
                <a href="dashboard.php" class="btn btn-secondary mt-3 form-control">Cancel</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
