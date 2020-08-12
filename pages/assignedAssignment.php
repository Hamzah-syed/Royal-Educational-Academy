<?php
//connection
include("../database_connection.php");
session_start();

if ($_SESSION["roleId"] == 3 || $_SESSION["roleId"] == 1) {
    header("Location:./dashboard.php");
}


if (isset($_POST['asg_assign'])) {
    $asgStartD = strip_tags($_POST['asg_start_d']);
    $asgEndDate = strip_tags($_POST['asg_end_d']);
    $asgAssignment = strip_tags($_POST['asg_assignments']);
    $asgBatch = strip_tags($_POST['asg_batch']);



    // if ($nameValidation && $emailValidation && $passwordValidation) {

    $assignasignmentQuery = "INSERT INTO assign_assignment_tbl(asg_status,asg_due_date,asg_upload_date, asg_batch_fk,asg_assignment_fk) VALUES( 1,'$asgEndDate','$asgStartD','$asgBatch','$asgAssignment')";
    $fire = mysqli_query($con, $assignasignmentQuery) or die("data not inserted " . mysqli_error($con));

    // if ($fire) {
    //     echo '<script type="text/javascript">alert("assignment Assigned successfully")</script>';

    // }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Assignment</title>
    <!-- css -->
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <div id="wrapper">
        <?php include '../layout/layout.php' ?>
        <form class="customcontainer" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <h1>Assign Assignment</h1>

            <div class="form-group">
                <!-- Date input -->
                <label class="control-label" for="date">Assignment Start Date</label>
                <input class="form-control" name="asg_start_d" id="asg_start_d" placeholder="MM/DD/YYY" type="date" required />
            </div>
            <div class="form-group">
                <!-- Date input -->
                <label class="control-label" for="date">Assignment End Date</label>
                <input class="form-control" name="asg_end_d" id="asg_end_d" placeholder="MM/DD/YYY" type="date" required />
            </div>
            <div class="form-group">
                <label for="exampleInputbatch">Assignment</label>
                <select name="asg_assignments" id="asg_assignments" class="form-control" required>


                    <option disabled> Select Assignment By Title </option>;
                    <?php
                    $sql = mysqli_query($con, "SELECT assignments_tbl.as_id, assignments_tbl.as_title FROM assignments_tbl WHERE assignments_tbl.as_faculty_fk ='$_SESSION[faculty_id]'");
                    $row = mysqli_num_rows($sql);
                    while ($row = mysqli_fetch_assoc($sql)) { ?>

                        <option value="<?php echo $row['as_id'] ?>"> <?php echo $row['as_title'] ?> </option>;
                    <?php
                    }
                    ?>
                </select>



            </div>
            <div class="form-group">
                <label for="exampleInputbatch">Batch</label>
                <select name="asg_batch" id="asg_batch" class="form-control" required>


                    <option disabled> Select Batch </option>;
                    <?php
                    $sql = mysqli_query($con, "SELECT  b_id, b_code From batch_tbl WHERE batch_tbl.b_faculty_fk = '$_SESSION[faculty_id]'");
                    $row = mysqli_num_rows($sql);
                    while ($row = mysqli_fetch_assoc($sql)) { ?>

                        <option value="<?php echo $row['b_id'] ?>"> <?php echo $row['b_code'] ?> </option>;
                    <?php
                    }
                    ?>
                </select>



            </div>





            <button type="submit" name="asg_assign" id="asg_assign" class="btn btn-primary mt-1">Submit</button>
        </form>
        <?php


        ?>
    </div>
</body>

</html>