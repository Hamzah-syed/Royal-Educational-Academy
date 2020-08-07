<?php
include("../database_connection.php");


session_start();


//search
if (isset($_POST['rollNumberSet'])) {
    // if ($_POST['searchByBatch'] == "notSet") {
        $rollNumber= $_POST['searchByRollNo'];
       
    // } 
    // else {
    //     header("Location:submittedAsgList.php");

    // }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Marks</title>

</head>

<body>
    <div id="wrapper">
        <?php include '../layout/layout.php' ?>
        <div class="customcontainer  table-responsive">
            <h1 class="text-center blackColor" style="margin-bottom:50px;">Result</h1>


            <form name="serachByBatch" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="py-4">
                <div class="">

                    <div class="form-group  ">
                        <label for="exampleInputbatch" class="">
                            <h4>Enter Roll Number</h4>
                        </label>

                        <div class="form-group">
                            <label for="exampleInputName">Roll Number</label>
                            <input type="text" name="searchByRollNo" id="searchByRollNo" class="form-control" aria-describedby="emailHelp" placeholder="Enter Roll Number" required>
                            <!-- <small id="emailHelp" class="form-text text-muted">text</small> -->
                        </div>
                     
                    </div>
                    <div class="form-group  ">
                        <button type="submit" name="rollNumberSet" id="rollNumberSet" class="btn btn-primary  px-5">Search</button>
                        </select>
                    </div>
                </div>
            </form>



<?php
if (isset($_POST['rollNumberSet'])) { ?>
   
    <table class="table table-striped  table-bordered">
    
        <thead>
            <tr>
                <th scope="col">#id</th>
    
                <th scope="col">Assignment</th>
                <th scope="col">Submitted Assignment</th>
                <th scope="col">Marks</th>
                <th scope="col">Roll Number</th>
    
    
    
            </tr>
        </thead>
        <tbody>
    
            <?php
            
            // , assign_assignment_tbl,submitted_asg_tbl , assignments_tbl WHERE assign_assignment_tbl.asg_id = marks_tbl.mrk_assignment_fk AND submitted_asg_tbl.subAs_id = marks_tbl.mrk_subAsg_fk  AND assignments_tbl.as_id = assign_assignment_tbl.asg_id
            $marksQuery = "SELECT marks_tbl.mrk_id, assignments_tbl.as_title,submitted_asg_tbl.subAs_file,marks_tbl.mrk_outOfMarks, marks_tbl.mrk_TotalMarks,students_tbl.std_rollNumber  FROM marks_tbl,assign_assignment_tbl,assignments_tbl,submitted_asg_tbl,students_tbl WHERE assign_assignment_tbl.asg_id =  marks_tbl.mrk_assignment_fk AND assignments_tbl.as_id = assign_assignment_tbl.asg_assignment_fk AND submitted_asg_tbl.subAs_id = marks_tbl.mrk_subAsg_fk AND students_tbl.std_id = marks_tbl.mrk_std_fk AND students_tbl.std_rollNumber = '$rollNumber' ";
            $fire = mysqli_query($con, $marksQuery) or die("data not found " . mysqli_error($con));
    
            // condition that if data rows is greater than 0
            if (mysqli_num_rows($fire) > 0) {
                # code...
    
                while ($student = mysqli_fetch_assoc($fire)) { ?>
                    <tr>
                        <th scope="row"><?php echo $student['mrk_id'] ?></th>
                        <td><?php echo $student['as_title'] ?></td>
                        <td><a href="<?php echo "../assets/asgSubmitFiles/" . $student['subAs_file'] ?>" target="_blank"> <?php echo $student['subAs_file'] ?></a></td>
                        <td><?php echo $student['mrk_outOfMarks'] . " / " . $student['mrk_TotalMarks']  ?></td>
                        <td><?php echo $student['std_rollNumber'] ?></td>
                        
    
    
    
                    </tr>
                <?php
                }
            } else { ?>
                <tr>
                    <td style="position:absolute; border:none;" >

                        <h3 class="py-4">No Data Found!</h3>
                    </td>
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