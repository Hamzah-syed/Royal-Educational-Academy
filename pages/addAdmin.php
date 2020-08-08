<?php
//connection
include("../database_connection.php");

session_start();

if ($_SESSION["roleId"] == 3 || $_SESSION["roleId"] == 2) {
    header("Location:./dashboard.php");
}


if (isset($_POST['u_add_submit'])) {
    $uName = strip_tags($_POST['u_Name']);
    $u_email = strip_tags($_POST['u_email']);
    $u_password = strip_tags($_POST['u_password']);




    $addStdInfoQuery =   "INSERT INTO users_tbl(u_email,u_password,u_name,r_id_fk) VALUES('$u_email', '$u_password','$uName', 1)";
    $fire1 = mysqli_query($con, $addStdInfoQuery);
    $last_id = mysqli_insert_id($con);
    $addStdQuery =   "INSERT INTO admin_tbl(ad_info_fk) VALUES('$last_id')";
    $fire2 = mysqli_query($con, $addStdQuery) or die("data not inserted " . mysqli_error($con));;


    if ($fire1 && $fire2) {
        header("Location:./allAdmins.php");
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <link rel="stylesheet" href="../assets/css/main.css">

</head>

<body>
    <div id="wrapper">
        <?php include '../layout/layout.php' ?>
        <form class="customcontainer" name="addAdmin" id="addAdmin" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <h1>Add Admin</h1>
            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" name="u_Name" id="u_Name" class="form-control" aria-describedby="emailHelp" placeholder="Enter Name" required>
                <!-- <small id="emailHelp" class="form-text text-muted">text</small> -->
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="u_email" id="u_email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" required>
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>





            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="u_password" id="u_password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" name="u_add_submit" id="u_add_submit" class="btn btn-primary mt-3">Submit</button>
        </form>
        <?php


        ?>
    </div>
</body>

</html>