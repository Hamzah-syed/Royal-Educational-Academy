<?php
//connection
include("../database_connection.php");

session_start();
if ($_SESSION["roleId"] == 3 || $_SESSION["roleId"] == 2) {
    header("Location:./dashboard.php");
}
//fetch data of particular id 
if (isset($_GET['std_update'])) {
    
    $studentInfoId = $_GET['std_info_update'];
    $studentId = $_GET['std_update'];
    
    $studentDataQuery = "SELECT users_tbl.u_email, users_tbl.u_password, users_tbl.u_name,students_tbl.std_rollNumber, batch_tbl.b_code,batch_tbl.b_id FROM users_tbl , students_tbl , batch_tbl WHERE users_tbl.u_id ='$studentInfoId' AND  students_tbl.std_info_fk =  users_tbl.u_id AND batch_tbl.b_id=students_tbl.std_batch_fk ";
    $fire = mysqli_query($con , $studentDataQuery) or die('student is not selected'. mysqli_error($con) );
    $student = mysqli_fetch_assoc($fire);
}

//updating data of particular id 
if (isset($_POST['stdUpdateSubmit'])) {

    $stdName = $_POST['std_Name'];
    $stdEmail = $_POST['std_email'];
    $stdBatch = $_POST['std_batch'];
    $stdRollNum = $_POST['std_rollNum'];
   
    $stdPass = $_POST['std_pass'];

    
    
    //user table data updated
    $UpdateStdInfoQuery =   "UPDATE  users_tbl SET u_email = '$stdEmail', u_password = '$stdPass ',u_name  = '$stdName'  WHERE u_id = '$studentInfoId '" ;
    $fire1 = mysqli_query($con, $UpdateStdInfoQuery)  or die('student data is not updated'. mysqli_error($con) );
    //student table data updated
    $last_id = mysqli_insert_id($con);
    $UpdateStdQuery =   "UPDATE students_tbl SET  std_batch_fk = '$stdBatch',std_rollNumber = '$stdRollNum' WHERE  std_id='$studentId'" ;
    $fire2 = mysqli_query($con, $UpdateStdQuery) or die('student data is not updated'. mysqli_error($con) );

    //if query executed succesfully
    if ($fire2) header("location:./students.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <!-- css -->
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
<div id="wrapper">
  <?php include '../layout/layout.php' ?>
    <form class="customcontainer" name="addStudent" id="addAdmin" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <h1>Edit Students</h1>
        <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input type="text" name="std_Name" id="std_Name" class="form-control" aria-describedby="emailHelp" value="<?php echo $student['u_name'];?>" placeholder="Enter Name" required>
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="std_email" id="std_email" class="form-control" aria-describedby="emailHelp" value="<?php echo $student['u_email'];?>" placeholder="Enter email" required>
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>

        <div class="form-group">
            <label for="exampleInputbatch">Batch Code</label>
            <select name="std_batch" id="std_batch"  class="form-control" required>

                <option value="<?php echo $student['b_id'];?>"> <?php echo  $student['b_code'] ?> </option>;
                <?php
                $sql = mysqli_query($con, "SELECT b_id, b_code From batch_tbl WHERE b_id != '$student[b_id] '");
                $row = mysqli_num_rows($sql);
                while ($row = mysqli_fetch_assoc($sql)) {?>
                   
                   <option value="<?php echo $row['b_id'] ?>"> <?php echo $row['b_code'] ?> </option>;
                <?php
                }
                ?>
            </select>
        </div>


        <div class="form-group">
            <label for="exampleInputPassword1">Roll Number</label>
            <input type="text" name="std_rollNum" id="std_rollNum" class="form-control" value="<?php echo $student['std_rollNumber'];?>" placeholder="Roll Number" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="text" name="std_pass" id="std_pass" class="form-control" value="<?php echo $student['u_password'];?>" placeholder="Password" required>
        </div>

        <button type="submit" name="stdUpdateSubmit" id="stdUpdateSubmit" class="btn btn-primary mt-3">Submit</button>
    </form>
    <?php


    ?>
</div>
</body>

</html>