<?php
//connection
include("../database_connection.php");
session_start();

if ($_SESSION["roleId"] == 3) {
    header("Location:./dashboard.php");
}

if (isset($_GET['q_id'])) {
    $queryId = $_GET['q_id'];

    // }
}
if (isset($_POST['replySybmit'])) {

    $repText = $_POST['queryReplyText'];

    $addreplyQuery = "INSERT INTO reply_tbl(rep_text,rep_query_fk) VALUES('$repText', '$queryId ')";
    $fire = mysqli_query($con, $addreplyQuery) or die("data not found " . mysqli_error($con));

    $UpdatequeryStatusQuery =   "UPDATE  query_tbl SET q_status = 0 WHERE q_id = '$queryId'";
    $fire1 = mysqli_query($con, $UpdatequeryStatusQuery)  or die('error' . mysqli_error($con));

    if ($fire1) {
        header("Location:./queriesList.php");
    }
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query Reply</title>
    <!-- css -->
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <div id="wrapper">
        <?php include '../layout/layout.php' ?>
        <form class="customcontainer" name="" id="" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <h1>Queries Reply</h1>


            <div class="form-group">
                <label for="exampleFormControlTextarea3">Your Text</label>
                <textarea class="form-control" id="exampleFormControlTextarea3" rows="7" name="queryReplyText" required></textarea>
            </div>


            <!-- <small id="emailHelp" class="form-text text-muted">text</small> -->




            <button type="submit" name="replySybmit" id="replySybmit" class="btn btn-primary mt-3">Submit</button>
        </form>
        <?php


        ?>
    </div>
</body>

</html>