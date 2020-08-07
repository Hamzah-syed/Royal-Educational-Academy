<?php

//connection
include("../database_connection.php");

// demo session
session_start();



if ($_SESSION["roleId"] == 3 || $_SESSION["roleId"] == 1) {
    header("Location:./dashboard.php");
}

if (isset($_POST['asAddSubmit'])) {
    $asTitle = strip_tags($_POST['asTitle']);
    $as_subject = strip_tags($_POST['as_subject']);


    //file
    $asFileName = $_FILES['as_file']['name'];
    //rplace space with "_"
    $asFileName = preg_replace("/\s+/", "_", $asFileName);
    $asFileTempName = $_FILES['as_file']['tmp_name'];
    $asFileSize = $_FILES['as_file']['size'];
    $asFileType = $_FILES['as_file']['type'];
    //for extension
    $asFileExt = pathinfo($asFileName, PATHINFO_EXTENSION);
    //for name without extension
    $asFileName = pathinfo($asFileName, PATHINFO_FILENAME);

    $modifiedName =  $asFileName . date("mjYHis") . "." . $asFileExt;
    $FinalFilePath = "../assets/asg_files/" . $modifiedName;
    $upload = move_uploaded_file($asFileTempName,   $FinalFilePath);

    if ($upload) {

        // if ($nameValidation && $emailValidation && $passwordValidation) {

        $addasignmentQuery = "INSERT INTO assignments_tbl(as_title,as_file_path,as_faculty_fk, as_subject_fk) VALUES('$asTitle','$modifiedName','$_SESSION[faculty_id]','$as_subject')";
        $fire = mysqli_query($con, $addasignmentQuery) or die("data not inserted " . mysqli_error($con));

        if ($fire) {
            echo '<script type="text/javascript">alert("assignment added successfully")</script>';
            header("Location:./assignment.php");
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Assignment</title>
    <!-- css -->
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <div id="wrapper">
        <?php include '../layout/layout.php' ?>
        <form class="customcontainer" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <h1>Add Assignment</h1>
            <div class="form-group">
                <label for="exampleInputName">Assignment Title</label>
                <input type="text" name="asTitle" id="asTitle" class="form-control" aria-describedby="emailHelp" placeholder="Title" required>
                <!-- <small id="emailHelp" class="form-text text-muted">text</small> -->
            </div>
            <div class="form-group">
                <label for="exampleInputbatch">Subject</label>
                <select name="as_subject" id="as_subject" class="form-control">


                    <?php
                    $sql = mysqli_query($con, "SELECT subject_tbl.subject_id, subject_tbl.subject_name FROM subject_tbl");
                    $row = mysqli_num_rows($sql);
                    while ($row = mysqli_fetch_assoc($sql)) { ?>

                        <option value="<?php echo $row['subject_id'] ?>"> <?php echo $row['subject_name'] ?> </option>;
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputName">Assignment File</label><br />
                <input type="file" name="as_file" aria-describedby="emailHelp" accept="application/pdf" required>

                <!-- <small id="emailHelp" class="form-text text-muted">text</small> -->
            </div>





            <button type="submit" name="asAddSubmit" id="asAddSubmit" class="btn btn-primary mt-1">Submit</button>
        </form>
        <?php


        ?>
    </div>
</body>

</html>