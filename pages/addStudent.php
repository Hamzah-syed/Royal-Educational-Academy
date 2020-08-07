<?php
//connection
include("../database_connection.php");

session_start();

if ($_SESSION["roleId"] == 3 || $_SESSION["roleId"] == 2) {
    header("Location:./dashboard.php");
}


if (isset($_POST['stdAddSubmit'])) {
    $stdName = strip_tags($_POST['std_Name']);
    $stdEmail = strip_tags($_POST['std_email']);
    $stdBatch = strip_tags($_POST['std_batch']);
    $stdRollNumber = strip_tags($_POST['std_rollNum']);
    // $stdSem = $_POST['std_sem'];
    $stdPass = strip_tags($_POST['std_pass']);

    //validation
    $nameValidation = $emailValidation = $batchValidation = $passwordValidation =$stdRollNumberValidation = false;
    // name validation
    if (!empty(trim($stdName))) {
        if (strlen($stdName) > 0 && strlen($stdName) < 90) {
            if (!preg_match('/[^a-zA-Z\s]/', $stdName)) {
                echo "name is ok";
                $nameValidation = true;
            } else {
                echo 'invalid  name';
            }
        } else {
            echo "name characters should be greater than 2 and less than 90";
        }
    } else {
        echo "name is not ok";
    }
    //email validation
    if (!empty(trim($stdEmail))) {
        if (strlen($stdEmail) > 0 && strlen($stdName) < 90) {
            if (filter_var($stdEmail, FILTER_VALIDATE_EMAIL)) {
                echo "email looks good";
                $emailValidation = true;
            } else {
                echo 'invalid format of email';
            }
        } else {
            echo "email characters should be greater than 2 and less than 90";
        }
    } else {
        echo "email is not ok";
    }
    //password validation
    if (!empty(trim($stdEmail))) {
        if (strlen($stdEmail) > 0 && strlen($stdName) < 90) {
            $passwordValidation = true;
        } else {
            echo "password characters should be greater than 2 and less than 90";
        }
    } else {
        echo "password is not ok";
    }

 

if ( $nameValidation && $emailValidation && $passwordValidation) {
    
    $addStdInfoQuery =   "INSERT INTO users_tbl(u_email,u_password,u_name,r_id_fk) VALUES('$stdEmail', '$stdPass','$stdName', 3)";
    $fire1 = mysqli_query($con, $addStdInfoQuery);
    $last_id = mysqli_insert_id($con);
    $addStdQuery =   "INSERT INTO students_tbl(std_info_fk,std_rollNumber,std_batch_fk) VALUES('$last_id','$stdRollNumber','$stdBatch' )";
    $fire2 = mysqli_query($con, $addStdQuery) or die("data not inserted ". mysqli_error($con)); ;


    if ($fire1 && $fire2) {
        header("Location:./students.php");
    }
}

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="../assets/css/main.css">
   
</head>

<body>
<div id="wrapper">
  <?php include '../layout/layout.php' ?>
    <form class="customcontainer" name="addStudent" id="addAdmin" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <h1>Add Students</h1>
        <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input type="text" name="std_Name" id="std_Name" class="form-control" aria-describedby="emailHelp" placeholder="Enter Name" required>
            <!-- <small id="emailHelp" class="form-text text-muted">text</small> -->
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="std_email" id="std_email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" required>
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>

        <div class="form-group">
            <label for="exampleInputbatch">Batch Code</label>
            <select name="std_batch" id="std_batch" class="form-control" required>


                <?php
                $sql = mysqli_query($con, "SELECT b_id, b_code From batch_tbl");
                $row = mysqli_num_rows($sql);
                while ($row = mysqli_fetch_array($sql)) {
                    echo "<option value='" . $row['b_id'] . "'>" . $row['b_code'] . "</option>";
                }
                ?>
            </select>
        </div>


        <div class="form-group">
            <label for="exampleInputPassword1">Roll Number</label>
            <input type="text" name="std_rollNum" id="std_rollNum" class="form-control" placeholder="Roll Number" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="std_pass" id="std_pass" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" name="stdAddSubmit" id="stdAddSubmit" class="btn btn-primary mt-3">Submit</button>
    </form>
    <?php


    ?>
</div>
</body>

</html>