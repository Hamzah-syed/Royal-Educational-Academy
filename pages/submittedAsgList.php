<?php
include("../database_connection.php");


//demo session
$_SESSION["faculty_id"] = 2;
$_SESSION["roleId"] = 2;



if ($_SESSION["roleId"] === 3) {
    header("Location:./dashboard.php");
}

//search
if (isset($_POST['batchCodeSet'])) {
    if ($_POST['searchByBatch'] == "notSet") {
        header("Location:submittedAsgList.php");
    } else {

        $searchValue = $_POST['searchByBatch'];
    }
}

//Delete Data
if (isset($_GET['as_del'])) {

    $asDel = $_GET['as_del'];
    $asDelImg = $_GET['as_del_img'];
    $imagePath = "../assets/asg_files/" . $asDelImg;

    if (!unlink($imagePath)) {
        echo '<script>alert("you have an error")</script>';
        header("Location:assignment.php");
    }
    $deleteAsgQuery = "DELETE FROM assignments_tbl WHERE as_id = ' $asDel'";
    $fire = mysqli_query($con, $deleteAsgQuery) or die("this batch is not deleted " . mysqli_error($con));
}
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
    <title>Submitted Asignments</title>

</head>

<body>
    <div id="wrapper">
        <?php include '../layout/layout.php' ?>
        <div class="customcontainer  table-responsive">
            <h1 class="text-center blackColor" style="margin-bottom:50px;">Submitted Assignments</h1>



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

                            $row = mysqli_num_rows($sql);
                            while ($row = mysqli_fetch_assoc($sql)) { ?>

                                <option value="<?php echo $row['b_id'] ?>"> <?php echo $row['b_code'] ?> </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group  ">
                        <button type="submit" name="batchCodeSet" id="batchCodeSet" class="btn btn-primary  px-5">Search</button>
                        </select>
                    </div>
                </div>
            </form>





            <?php

            if (isset($_POST['batchCodeSet'])) { ?>
                <table class="table table-striped  table-bordered">

                    <thead>
                        <tr>
                            <th scope="col">#id</th>
                            <th scope="col">Assignment Title</th>
                            <th scope="col">Student Roll.No</th>
                            <th scope="col">File</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Submited Date</th>
                            <?php
                            if ($_SESSION["roleId"] == 1) { ?>
                                <th scope="col">Faculty</th>
                            <?php
                            }

                            ?>





                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        if ($_SESSION["roleId"] == 2) {
                            $AllAsgsQuery = "SELECT submitted_asg_tbl.subAs_id, students_tbl.std_id, submitted_asg_tbl.subAs_date, assignments_tbl.as_title, students_tbl.std_rollNumber,submitted_asg_tbl.subAs_file, subject_tbl.subject_name,assign_assignment_tbl.asg_due_date,assign_assignment_tbl.asg_id  FROM   students_tbl, submitted_asg_tbl,assign_assignment_tbl,assignments_tbl,subject_tbl WHERE students_tbl.std_id =submitted_asg_tbl.subAs_student_fk AND assign_assignment_tbl.asg_id =submitted_asg_tbl.subAs_assignaAssignment_fk   AND assign_assignment_tbl.asg_batch_fk =  '$searchValue' AND assignments_tbl.as_id =assign_assignment_tbl.asg_assignment_fk  AND subject_tbl.subject_id =assignments_tbl.as_subject_fk  AND assignments_tbl.as_faculty_fk = $_SESSION[faculty_id]  ";
                        } else if ($_SESSION["roleId"] == 1) {
                            $AllAsgsQuery = "SELECT submitted_asg_tbl.subAs_id, students_tbl.std_id, submitted_asg_tbl.subAs_date, assignments_tbl.as_title, students_tbl.std_rollNumber,submitted_asg_tbl.subAs_file, subject_tbl.subject_name,assign_assignment_tbl.asg_due_date,users_tbl.u_name,assign_assignment_tbl.asg_id  FROM   students_tbl, submitted_asg_tbl,assign_assignment_tbl,assignments_tbl,subject_tbl,faculty_tbl, users_tbl WHERE students_tbl.std_id =submitted_asg_tbl.subAs_student_fk AND assign_assignment_tbl.asg_id =submitted_asg_tbl.subAs_assignaAssignment_fk   AND assign_assignment_tbl.asg_batch_fk =  '$searchValue' AND assignments_tbl.as_id =assign_assignment_tbl.asg_assignment_fk  AND subject_tbl.subject_id =assignments_tbl.as_subject_fk AND faculty_tbl.fac_id = assignments_tbl.as_faculty_fk AND users_tbl.u_id = faculty_tbl.fac_info_fk";
                        }


                        $fire = mysqli_query($con, $AllAsgsQuery) or die("data not found " . mysqli_error($con));

                        // condition that if data rows is greater than 0
                        if (mysqli_num_rows($fire) > 0) {
                            # code...

                            while ($student = mysqli_fetch_assoc($fire)) { ?>
                                <tr>
                                    <th scope="row"><?php echo $student['subAs_id'] ?></th>
                                    <td><?php echo $student['as_title'] ?></td>
                                    <td><?php echo $student['std_rollNumber'] ?></td>

                                    <td><a href="<?php echo "../assets/asgSubmitFiles/" . $student['subAs_file'] ?>" target="_blank"> <?php echo $student['subAs_file'] ?></a></td>
                                    <td><?php echo $student['subject_name'] ?></td>
                                    <td><?php echo $student['subAs_date'] ?></td>
                                    <?php
                                    if ($_SESSION["roleId"] == 1) { ?>

                                        <td><?php echo $student['u_name'] ?></td>
                                    <?php
                                    }

                                    ?>

                                    <td>
                                        <!-- Delete -->
                                        <a href="<?php
                                                    $_SERVER['PHP_SELF']
                                                    ?> ?as_del=<?php echo  $student['as_id'] ?>&as_del_img=<?php echo  $student['as_file_path'] ?>" class="btn btn-danger">Delete</a>
                                        <!-- update -->
                                        <a href="addmarks.php ?std_id=<?php echo  $student['std_id'] ?>& submittedAsgId=<?php echo  $student['subAs_id'] ?>& assignedAsgId=<?php echo  $student['asg_id'] ?>" class="btn  btn-primary">Set Marks</a>


                                    </td>

                                </tr>
                            <?php
                            }
                        } else { ?>
                            <tr>

                                <h3 class="py-4">No Data Found! </h3>
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
    </div>
</body>

</html>