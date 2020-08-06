<?php
include("../database_connection.php");


//demo session
$_SESSION["roleId"] = 1;
if ($_SESSION["roleId"] === 3 || $_SESSION["roleId"] === 2) {
    header("Location:./dashboard.php");
}

//Delete Data
if (isset($_GET['batch_del'])) {

    $batchDel = $_GET['batch_del'];
    $deleteBatchQuery = "DELETE FROM batch_tbl WHERE b_id = ' $batchDel'";
    $fire = mysqli_query($con, $deleteBatchQuery) or die("this batch is not deleted " . mysqli_error($con));
}
//search
if (isset($_GET['search_Code'])) {
    $searchValue = $_GET['searchValue'];
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Students Data</title>

</head>

<body>
    <div id="wrapper">
        <?php include '../layout/layout.php' ?>
        <div class="customcontainer  table-responsive">
            <h1 class="text-center blackColor" style="margin-bottom:50px;">All Batches</h1>
            <!-- <div class = "py-3" >
            <form class="d-flex align-items-center " method="GET">


                <input type="text" name="searchValue" id="searchValue" placeholder="Search Data" class="form-control" style="width:300px"/>
                <input type="submit" name="search_Code" id="search_Code" class="btn btn-info py-1 mx-2 form-control"style="width:100px" />
            </form>
        </div> -->
            <table class="table table-striped ">

                <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Batch Code</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">Faculty</th>
                        <th scope="col"></th>

                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $AllStudentsQuery = "SELECT batch_tbl.b_id ,batch_tbl.b_code, batch_tbl.b_current_sem, batch_tbl.batch_start_year,batch_tbl.b_faculty_fk, users_tbl.u_name  FROM batch_tbl , faculty_tbl , users_tbl WHERE  faculty_tbl.fac_id = b_faculty_fk  AND users_tbl.u_id = faculty_tbl.fac_info_fk  ORDER BY batch_tbl.batch_start_year";
                    $fire = mysqli_query($con, $AllStudentsQuery) or die("data not found " . mysqli_error($con));

                    // condition that if data rows is greater than 0
                    if (mysqli_num_rows($fire) > 0) {
                        # code...

                        while ($student = mysqli_fetch_assoc($fire)) { ?>
                            <tr>
                                <th scope="row"><?php echo $student['b_id'] ?></th>
                                <td><?php echo $student['b_code'] ?></td>
                                <td><?php echo $student['b_current_sem'] ?></td>
                                <td><?php echo  $student['batch_start_year'] ?></td>
                                <td><?php echo $student['u_name'] ?></td>
                                <td>
                                    <!-- Delete -->
                                    <a href="<?php
                                                $_SERVER['PHP_SELF']
                                                ?> ?batch_del=<?php echo  $student['b_id'] ?>" class="btn btn-danger">Delete</a>
                                    <!-- update -->
                                    <!-- <a href="students/updateStudent.php ?std_update=<?php echo  $student['std_id'] ?>& std_info_update=<?php echo  $student['u_id'] ?>" class="btn  btn-primary">Edit</a> -->


                                </td>

                            </tr>
                        <?php
                        }
                    } else { ?>
                        <tr>


                            <<h3 class="py-4">No Data Found!. Insert Data </h3>

                        </tr>
                    <?php
                    }
                    ?>





                </tbody>
            </table>
            <a href="./batches/addBatch.php">
                <button class="btn btn-primary">Add Batch</button>
            </a>
        </div>
    </div>
</body>

</html>