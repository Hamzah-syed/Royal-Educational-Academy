<?php
//connection
include("../database_connection.php");
session_start();
if ($_SESSION["roleId"]==3) {
    header("Location:./dashboard.php");
 }

//fetch data of particular id 
if (isset($_GET['std_id'])) {

    $studentId = $_GET['std_id'];
    $subAsgId = $_GET['submittedAsgId'];
    $assignedAsgId = $_GET['assignedAsgId'];

    $marksDataQuery = "SELECT students_tbl.std_rollNumber FROM submitted_asg_tbl,assign_assignment_tbl , students_tbl , batch_tbl WHERE submitted_asg_tbl.subAs_id='$subAsgId' AND assign_assignment_tbl.asg_id= '$assignedAsgId' AND students_tbl.std_id = '$studentId ' ";
    $fire = mysqli_query($con, $marksDataQuery) or die('student is not selected' . mysqli_error($con));
    $marks = mysqli_fetch_assoc($fire);
}

//updating data of particular id 
if (isset($_POST['marksAdd'])) {

   
    $stdRollNum = $_POST['std_rollNum'];
    $totalMarks = $_POST['totalMarks'];
    $obtainedMarks = $_POST['marksObtained'];





    //user table data updated
    $addMarksQuery =   "INSERT INTO marks_tbl(mrk_std_fk,mrk_subAsg_fk,mrk_assignment_fk,mrk_outOfMarks,mrk_TotalMarks) VALUES('$studentId','$subAsgId','$assignedAsgId','$totalMarks','$obtainedMarks')";
    $fire1 = mysqli_query($con, $addMarksQuery)  or die('student data is not updated' . mysqli_error($con));

   
    //if query executed succesfully
    if ($fire1) header("location:./submittedAsgList.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Marks</title>
    <!-- css -->
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <div id="wrapper">
        <?php include '../layout/layout.php' ?>
        <form class="customcontainer" name="addStudent" id="addAdmin" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <h1>Add Marks</h1>



            <div class="form-group">
                <label for="exampleInputPassword1">Roll Number</label>
                <input type="text" name="std_rollNum" id="std_rollNum" class="form-control" value="<?php echo $marks['std_rollNumber']; ?>" placeholder="Roll Number" required readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Total Marks</label>
                <input type="number" name="totalMarks" id="totalMarks" class="form-control" min="1" max="200" placeholder="Total marks" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Obtained Marks</label>
                <input type="number" name="marksObtained" id="marksObtained" class="form-control" min="1" max="200" placeholder="Obtained marks" required>
            </div>

            <button type="submit" name="marksAdd" id="marksAdd" class="btn btn-primary mt-3">Submit</button>
        </form>
        <?php


        ?>
    </div>
</body>

</html>