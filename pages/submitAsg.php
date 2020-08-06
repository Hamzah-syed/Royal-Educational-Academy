<?php
include("../database_connection.php");
include("../layout/layout.php");

//demo session
$_SESSION["faculty_id"] = 1;
$_SESSION["student_id"] = 19;
$_SESSION["roleId"] = 3;
$_SESSION["batchId"] = 7;



if (isset($_POST['asgSubmit'])) {
   $AsgValue = $_POST['assignmentSelected'];
   


   //file
   $asFileName = $_FILES['asgSubmit_file']['name'];
   //rplace space with "_"
   $asFileName = preg_replace("/\s+/", "_", $asFileName);
   $asFileTempName = $_FILES['asgSubmit_file']['tmp_name'];
   $asFileSize = $_FILES['asgSubmit_file']['size'];
   $asFileType = $_FILES['asgSubmit_file']['type'];
   //for extension
   $asFileExt = pathinfo($asFileName, PATHINFO_EXTENSION);
   //for name without extension
   $asFileName = pathinfo($asFileName, PATHINFO_FILENAME);

   $modifiedName =  $asFileName . date("mjYHis") . "." . $asFileExt;
   $FinalFilePath = "../assets/asgSubmitFiles/" . $modifiedName;
   $upload = move_uploaded_file($asFileTempName, $FinalFilePath);

   //demo date For Now
   if ($upload) {

       // if ($nameValidation && $emailValidation && $passwordValidation) {

       $SubmitasignmentQuery = "INSERT INTO submitted_asg_tbl(subAs_file,subAs_date, subAs_student_fk,subAs_assignaAssignment_fk) VALUES('$modifiedName',2020-08-05 , '$_SESSION[student_id]','$AsgValue')";
       $fire = mysqli_query($con, $SubmitasignmentQuery) or die("data not inserted " . mysqli_error($con));

       if ($fire) {
           echo '<script type="text/javascript">alert("assignment submitted successfully")</script>';
           header("Location:./submitAsg.php");
           session_unset( $_SESSION['AsgValue']);
       }
   }
}






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
        <h1 class="text-center blackColor" style="margin-bottom:50px;">Submit Assignment</h1>







     
       
            <form class="py-2" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
           
                <p class="text-warning" ><b>note: Assignment should be in .pdf format</b></p>
                <div class="form-group  ">
                    <label for="exampleInputbatch" class="">
                       Select Assignment
                    </label>
                    <select name="assignmentSelected" id="assignmentSelected" class="form-control" required>


                        <option value="notSet" disabled> choose assignment </option>;
                        <?php
                        $sql = mysqli_query($con, "SELECT assign_assignment_tbl.asg_id,assignments_tbl.as_title From assign_assignment_tbl,assignments_tbl WHERE assignments_tbl.as_id = assign_assignment_tbl.asg_assignment_fk AND assign_assignment_tbl.asg_batch_fk = '$_SESSION[batchId]' AND assign_assignment_tbl.asg_status = 1 ");

                        $row = mysqli_num_rows($sql);
                        while ($row = mysqli_fetch_assoc($sql)) { ?>

                            <option value="<?php echo $row['asg_id'] ?>"> <?php echo $row['as_title'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputName">Assignment File</label><br />
                    <input type="file" name="asgSubmit_file" aria-describedby="emailHelp" accept="application/pdf" required>

                    <!-- <small id="emailHelp" class="form-text text-muted">text</small> -->
                </div>





                <button type="submit"  name="asgSubmit" id="asgSubmit" class="btn btn-success mt-1 px-4">Submit</button>
            </form>


        


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