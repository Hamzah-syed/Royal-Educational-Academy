<?php
include("../database_connection.php");
include("../layout/layout.php");

//demo session
$_SESSION["faculty_id"] = 1;
$_SESSION["roleId"] = 3;
// $_SESSION["batchId"] = 6;


//search
if (isset($_POST['SearchAsgByName'])) {
    if ($_POST['searchByBatch'] == "notSet") {
        header("Location:batchAssignments.php");
    } else {

        echo $searchValue = $_POST['searchByBatch'];
    }
}


//Delete Data
if (isset($_POST['asg_del'])) {

    $asgDel = $_GET['asg_del'];



    $deleteAsgQuery = "DELETE FROM assign_assignment_tbl WHERE asg_id = ' $asgDel'";
    $fire = mysqli_query($con, $deleteAsgQuery) or die("error" . mysqli_error($con));
    if ($fire) {
        echo "<script>alert('Assignment Deleted')</script>";
    }
}
// //status expire 
// if (isset($_GET['statusExpire'])) {

//     $StatusExpire = $_GET['statusExpire'];

//     //assign assignment table data updated
//     $UpdateStatusQuery =   "UPDATE  assign_assignment_tbl SET asg_status = 0 WHERE asg_id = '$StatusExpire'";
//     $fire1 = mysqli_query($con, $UpdateStatusQuery)  or die('error: ' . mysqli_error($con));

//     if ($fire1) {
//         echo "<script>alert('Status Updated')</script>";
//     }
// }
// //status Active 
// if (isset($_GET['statusActive'])) {

//     $statusActive = $_GET['statusActive'];

//     //assign assignment table data updated
//     $UpdateStatusQuery =   "UPDATE  assign_assignment_tbl SET asg_status = 1 WHERE asg_id = '$statusActive'";
//     $fire1 = mysqli_query($con, $UpdateStatusQuery)  or die('error: ' . mysqli_error($con));

//     if ($fire1) {
//         echo "<script>alert('Status Updated')</script>";
//     }
// }



// search
// if (isset($_GET['search_Code'])) {
//     $searchValue = $_GET['searchValue'];
// }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Batch Assignments</title>

</head>

<body>
    <div class="customcontainer  table-responsive">
        <h1 class="text-center blackColor" style="margin-bottom:50px;">All Assignments</h1>
        <!-- <div class = "py-3" >
            <form class="d-flex align-items-center " method="GET">


                <input type="text" name="searchValue" id="searchValue" placeholder="Search Data" class="form-control" style="width:300px"/>
                <input type="submit" name="search_Code" id="search_Code" class="btn btn-info py-1 mx-2 form-control"style="width:100px" />
            </form>
        </div> -->
<?php 
if (!isset($_SESSION["batchId"])) { ?>
    
    <form name="serachByBatch" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="">
    
            <div class="form-group  ">
                <label for="exampleInputbatch" class="">
                    <h4>Select Batch Code</h4>
                </label>
                <select name="searchByBatch" id="searchByBatch" class="form-control" required>
    
    
                    <option value="notSet" selected> Select Batch </option>;
                    <?php
                    $sql = mysqli_query($con, "SELECT b_id, b_code From batch_tbl ");
                    $batch = mysqli_query($con, "SELECT b_id From batch_tbl WHERE b_id = $searchValue");
                    $row = mysqli_num_rows($sql);
                    while ($row = mysqli_fetch_assoc($sql)) { ?>
    
                        <option value="<?php echo $row['b_id'] ?>"> <?php echo $row['b_code'] ?> </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group  ">
                <button type="submit" name="SearchAsgByName" id="SearchAsgByName" class="btn btn-primary  px-5">Search</button>
                </select>
            </div>
        </div>
    </form>

    <?php
}

?>


        <?php
        if (isset($_POST['SearchAsgByName']) || isset($_SESSION["batchId"])) { ?>

            <table class="table table-striped ">

                <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Assignment</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Faculty</th>
                        <th scope="col">Due Date</th>
                        <!-- <th scope="col">Status</th> -->

                        <th scope="col"></th>


                    </tr>
                </thead>
                <tbody>

                    <?php

                    if (!isset($_SESSION["batchId"])) {
                        $AllAsgsQuery = "SELECT assign_assignment_tbl.asg_id ,assignments_tbl.as_title, assignments_tbl.as_file_path, assignments_tbl.as_faculty_fk, users_tbl.u_name, subject_tbl.subject_name,assign_assignment_tbl.asg_due_date, assign_assignment_tbl.asg_status  FROM assign_assignment_tbl, assignments_tbl , faculty_tbl , users_tbl,subject_tbl WHERE assignments_tbl.as_id =  assign_assignment_tbl.asg_assignment_fk AND faculty_tbl.fac_id = assignments_tbl.as_faculty_fk  AND users_tbl.u_id = faculty_tbl.fac_info_fk AND subject_tbl.subject_id = assignments_tbl.as_subject_fk AND assign_assignment_tbl.asg_batch_fk  = '$searchValue'";
                    } else if (isset($_SESSION["batchId"])) {
                        $AllAsgsQuery = "SELECT assign_assignment_tbl.asg_id ,assignments_tbl.as_title, assignments_tbl.as_file_path, assignments_tbl.as_faculty_fk, users_tbl.u_name, subject_tbl.subject_name,assign_assignment_tbl.asg_due_date, assign_assignment_tbl.asg_status  FROM assign_assignment_tbl, assignments_tbl , faculty_tbl , users_tbl,subject_tbl WHERE assignments_tbl.as_id =  assign_assignment_tbl.asg_assignment_fk AND faculty_tbl.fac_id = assignments_tbl.as_faculty_fk  AND users_tbl.u_id = faculty_tbl.fac_info_fk AND subject_tbl.subject_id = assignments_tbl.as_subject_fk AND assign_assignment_tbl.asg_batch_fk  = '$_SESSION[batchId]'";
                    }
                    //  else if ($_SESSION["roleId"] == 2) {
                    //     $AllAsgsQuery = "SELECT assignments_tbl.as_id ,assignments_tbl.as_title, assignments_tbl.as_file_path, assignments_tbl.as_faculty_fk, users_tbl.u_name,  subject_tbl.subject_name FROM assignments_tbl , faculty_tbl , users_tbl,subject_tbl WHERE  faculty_tbl.fac_id = assignments_tbl.as_faculty_fk  AND users_tbl.u_id = faculty_tbl.fac_info_fk AND subject_tbl.subject_id = assignments_tbl.as_subject_fk AND assignments_tbl.as_faculty_fk = '$_SESSION[faculty_id]' ";
                    // }


                    $fire = mysqli_query($con, $AllAsgsQuery) or die("data not found " . mysqli_error($con));

                    // condition that if data rows is greater than 0
                    if (mysqli_num_rows($fire) > 0) {
                        # code...

                        while ($student = mysqli_fetch_assoc($fire)) { ?>
                            <tr>
                                <th scope="row"><?php echo $student['asg_id'] ?></th>
                                <td><?php echo $student['as_title'] ?></td>
                                <td><a href="<?php echo "../assets/asg_files/" . $student['as_file_path'] ?>" target="_blank"> <?php echo $student['as_file_path'] ?></a></td>
                                <td><?php echo $student['subject_name'] ?></td>
                                <td><?php echo $student['u_name'] ?></td>
                                <td><?php echo $student['asg_due_date'] ?></td>
                                <!-- <td><?php if ($student['asg_status'] == 1) {
                                                echo "<b class='text-success'>Available</b>";
                                            } else {
                                                echo "<b class='text-danger'>Expired </b>";
                                            } ?></td> -->

                                <td>

                                    <!-- Delete -->
                                    <a href="<?php
                                                $_SERVER['PHP_SELF']
                                                ?> ?asg_del=<?php echo  $student['asg_id'] ?>&as_del_img=<?php echo  $student['as_file_path'] ?>" class="btn btn-danger">Delete</a>

                                </td>

                            </tr>
                        <?php
                        }
                    } else { ?>
                        <tr>

                            <h3 class="py-4">There is no assignment currently</h3>


                        </tr>
                    <?php
                    }
                    ?>





                </tbody>
            </table>
        <?php
        }

        ?>


    </div>
</body>

</html>

<!-- not avilabe -->

<!-- <?php
        if ($student['asg_status'] == 1) { ?>

                                        <a href="<?php
                                                    $_SERVER['PHP_SELF']
                                                    ?> ?statusExpire=<?php echo  $student['asg_id'] ?>" class="btn btn-info">Expire</a>
                                    <?php
                                }
                                if ($student['asg_status'] == 0) { ?>

                                        <a href="<?php
                                                    $_SERVER['PHP_SELF']
                                                    ?> ?statusActive=<?php echo  $student['asg_id'] ?>" class="btn btn-success">Active</a>
                                    <?php
                                }

                                    ?> -->