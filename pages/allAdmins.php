<?php
include("../database_connection.php");


session_start();
if ($_SESSION["roleId"] == 3 || $_SESSION["roleId"] == 2) {
    header("Location:./dashboard.php");
}
//Delete Data
if (isset($_GET['uId_del'])) {

    $adminInfoId = $_GET['u_info_del'];
    $adminId = $_GET['uId_del'];

    $deleteStdInfoQuery = "DELETE FROM users_tbl WHERE u_id = ' $adminInfoId'";
    $deleteStdQuery = "DELETE FROM admin_tbl WHERE ad_id = '$adminId'";

    $fire1 = mysqli_query($con, $deleteStdQuery) or die("this student is not deleted" . mysqli_error($con));
    $fire2 = mysqli_query($con, $deleteStdInfoQuery)  or die("this student is not deleted" . mysqli_error($con));
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>All Admins</title>

</head>

<body>
    <div id="wrapper">
        <?php include '../layout/layout.php' ?>
        <div class="customcontainer  table-responsive">
            <h1 class="text-center blackColor" style="margin-bottom:50px;">All Admins</h1>

            <table class="table table-striped  table-bordered">

                <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>


                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $AllStudentsQuery = "SELECT users_tbl.u_id ,users_tbl.u_email, users_tbl.u_password, users_tbl.u_name,admin_tbl.ad_id  FROM users_tbl , admin_tbl  WHERE users_tbl.r_id_fk =1 AND  admin_tbl.ad_info_fk =  users_tbl.u_id ";
                    $fire = mysqli_query($con, $AllStudentsQuery) or die("data not found " . mysqli_error($con));

                    // condition that if data rows is greater than 0
                    if (mysqli_num_rows($fire) > 0) {
                        # code...

                        while ($student = mysqli_fetch_assoc($fire)) { ?>
                            <tr>
                                <th scope="row"><?php echo $student['ad_id'] ?></th>
                                <td><?php echo $student['u_name'] ?></td>
                                <td><?php echo $student['u_email'] ?></td>
                                <td><?php echo $student['u_password'] ?></td>

                                <td>
                                    <!-- Delete -->
                                    <a href="<?php
                                                $_SERVER['PHP_SELF']
                                                ?> ?uId_del=<?php echo  $student['ad_id'] ?>&u_info_del=<?php echo  $student['u_id'] ?>" class="btn btn-danger">Delete</a>
                                    <!-- update -->
                                    <a href="updateAdmin.php ?u_update=<?php echo  $student['ad_id'] ?>& u_info_update=<?php echo  $student['u_id'] ?>" class="btn  btn-primary">Edit</a>


                                </td>

                            </tr>
                        <?php
                        }
                    } else { ?>
                        <tr>
                            <h3 class="py-4">No Data Found!. Insert Data </h3>
                        </tr>
                    <?php
                    }
                    ?>





                </tbody>
            </table>
            <a href="./addadmin.php">
                <button class="btn btn-primary">Add Admin</button>
            </a>
        </div>
    </div>
</body>

</html>