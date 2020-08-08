<?php
//connection
include("../database_connection.php");
session_start();

if ($_SESSION["roleId"] == 3 || $_SESSION["roleId"] == 2) {
    header("Location:./dashboard.php");
}

if (isset($_POST['batchAddSubmit'])) {
    $batchCode = strip_tags($_POST['b_code']);
    $batchSemester = strip_tags($_POST['b_semester']);
    $batchDate = strip_tags($_POST['b_startDate']);

    // $stdSem = $_POST['std_sem'];
    $batchFaculty = strip_tags($_POST['b_faculty']);



    $addbatchQuery = "INSERT INTO batch_tbl(b_code,b_current_sem,batch_start_year,b_faculty_fk) VALUES('$batchCode', '$batchSemester','$batchDate','$batchFaculty')";
    $fire1 = mysqli_query($con, $addbatchQuery) or die("data not inserted " . mysqli_error($con));




    if ($fire1) {
        header("Location:./batches.php");
    }
    // }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <!-- css -->
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <div id="wrapper">
        <?php include '../layout/layout.php' ?>
        <form class="customcontainer" name="" id="" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <h1>Add Batch</h1>
            <div class="form-group">
                <label for="exampleInputName">Batch Code</label>
                <input type="text" name="b_code" id="b_code" class="form-control" aria-describedby="emailHelp" placeholder="Enter Batch Code" required>
                <!-- <small id="emailHelp" class="form-text text-muted">text</small> -->
            </div>

            <div class="form-group">
                <label for="exampleInputName">Batch Semester</label>
                <input type="text" name="b_semester" id="b_semester" class="form-control" aria-describedby="emailHelp" placeholder="Enter Semester" required>
                <!-- <small id="emailHelp" class="form-text text-muted">text</small> -->
            </div>


            <div class="form-group">
                <!-- Date input -->
                <label class="control-label" for="date">Date</label>
                <input class="form-control" name="b_startDate" id="b_startDate" placeholder="MM/DD/YYY" type="date" required />
            </div>
            <!-- <small id="emailHelp" class="form-text text-muted">text</small> -->


            <div class="form-group">
                <label for="exampleInputbatch">Faculty</label>
                <select name="b_faculty" id="b_faculty" class="form-control" required>


                    <?php
                    $sql = mysqli_query($con, "SELECT faculty_tbl.fac_id,users_tbl.u_name FROM faculty_tbl, users_tbl WHERE users_tbl.u_id = faculty_tbl.fac_info_fk");
                    $row = mysqli_num_rows($sql);
                    while ($row = mysqli_fetch_assoc($sql)) { ?>

                        <option value="<?php echo $row['fac_id'] ?>"> <?php echo $row['fac_id'] . " - " . $row['u_name'] ?> </option>;
                    <?php
                    }
                    ?>
                </select>
            </div>


            <button type="submit" name="batchAddSubmit" id="batchAddSubmit" class="btn btn-primary mt-3">Submit</button>
        </form>
        <?php


        ?>
    </div>
</body>

</html>