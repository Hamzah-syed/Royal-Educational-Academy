<?php
//connection
include("../database_connection.php");

session_start();
if ($_SESSION["roleId"] == 3 || $_SESSION["roleId"] == 2) {
    header("Location:./dashboard.php");
}
//fetch data of particular id 
if (isset($_GET['u_update'])) {

    $u_id = $_GET['u_info_update'];
    $u_info = $_GET['u_update'];

    $userDataQuery = "SELECT users_tbl.u_email, users_tbl.u_password, users_tbl.u_name FROM users_tbl  WHERE users_tbl.u_id ='$u_id'";
    $fire = mysqli_query($con, $userDataQuery) or die('student is not selected' . mysqli_error($con));
    $user = mysqli_fetch_assoc($fire);
}

//updating data of particular id 
if (isset($_POST['uUpdateSubmit'])) {

    $u_name = $_POST['u_name'];
    $u_email = $_POST['u_email'];


    $u_pass = $_POST['u_pass'];



    //user table data updated
    $UpdateStdInfoQuery =   "UPDATE  users_tbl SET u_email = '$u_email', u_password = '$u_pass ',u_name  = '$u_name'  WHERE u_id = '$u_id '";
    $fire1 = mysqli_query($con, $UpdateStdInfoQuery)  or die('student data is not updated' . mysqli_error($con));



    //if query executed succesfully
    if ($fire1) header("location:./allFaculty.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Faculty Member</title>
    <!-- css -->
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <div id="wrapper">
        <?php include '../layout/layout.php' ?>
        <form class="customcontainer" name="addAdmin" id="addAdmin" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <h1>Edit Faculty Member</h1>
            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" name="u_name" id="u_name" class="form-control" aria-describedby="emailHelp" value="<?php echo $user['u_name']; ?>" placeholder="Enter Name" required>
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="u_email" id="u_email" class="form-control" aria-describedby="emailHelp" value="<?php echo $user['u_email']; ?>" placeholder="Enter email" required>
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>


            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="text" name="u_pass" id="u_pass" class="form-control" value="<?php echo $user['u_password']; ?>" placeholder="Password" required>
            </div>

            <button type="submit" name="uUpdateSubmit" id="uUpdateSubmit" class="btn btn-primary mt-3">Submit</button>
        </form>
        <?php


        ?>
    </div>
</body>

</html>