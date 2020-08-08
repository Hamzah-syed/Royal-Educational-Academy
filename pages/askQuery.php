<?php
//connection
include("../database_connection.php");
session_start();

if ($_SESSION["roleId"] == 1 || $_SESSION["roleId"] == 2) {
    header("Location:./dashboard.php");
}

if (isset($_POST['querySybmit'])) {
    $queryText = strip_tags($_POST['queryText']);






    $addQuery = "INSERT INTO query_tbl(q_text,q_std_fk,q_status) VALUES('$queryText', ' $_SESSION[student_id]',1)";
    $fire1 = mysqli_query($con, $addQuery) or die("data not inserted " . mysqli_error($con));




    if ($fire1) {
        header("Location:./askQuery.php");
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
            <h1>Ask For Queries</h1>


            <div class="form-group">
                <label for="exampleFormControlTextarea3">Your Text</label>
                <textarea class="form-control" id="exampleFormControlTextarea3" rows="7" name="queryText" required></textarea>
            </div>


            <!-- <small id="emailHelp" class="form-text text-muted">text</small> -->




            <button type="submit" name="querySybmit" id="querySybmit" class="btn btn-primary mt-3">Submit</button>
        </form>
        <?php


        ?>
    </div>
</body>

</html>