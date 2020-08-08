<?php
include("../database_connection.php");


session_start();

if ($_SESSION["roleId"] == 1 || $_SESSION["roleId"] == 2) {
    header("Location:./dashboard.php");
}
//Delete Data
if (isset($_GET['query_del'])) {

    $queryDel = $_GET['query_del'];
    $deleteBatchQuery = "DELETE FROM query_tbl WHERE q_id = ' $queryDel'";
    $fire = mysqli_query($con, $deleteBatchQuery) or die("this query is not deleted " . mysqli_error($con));
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Queries Reply</title>

</head>

<body>
    <div id="wrapper">
        <?php include '../layout/layout.php' ?>
        <div class="customcontainer  table-responsive">
            <h1 class="text-center blackColor" style="margin-bottom:50px;">Queries Replies</h1>
            <!-- <div class = "py-3" >
            <form class="d-flex align-items-center " method="GET">


                <input type="text" name="searchValue" id="searchValue" placeholder="Search Data" class="form-control" style="width:300px"/>
                <input type="submit" name="search_Code" id="search_Code" class="btn btn-info py-1 mx-2 form-control"style="width:100px" />
            </form>
        </div> -->




            <?php

            $AllReplyQuery = "SELECT reply_tbl.rep_id ,query_tbl.q_id, reply_tbl.rep_text,query_tbl.q_text FROM reply_tbl, query_tbl  WHERE  query_tbl.q_id = reply_tbl.rep_query_fk  AND query_tbl.q_std_fk = '$_SESSION[student_id]' ";
            $fire = mysqli_query($con, $AllReplyQuery) or die("data not found " . mysqli_error($con));

            // condition that if data rows is greater than 0
            if (mysqli_num_rows($fire) > 0) {
                # code...

                while ($query = mysqli_fetch_assoc($fire)) { ?>

                    <div class="card my-4">
                        <div class="card-header" style="text-transform: capitalize;">
                            Question id #<?php echo $query['q_id'] ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" style="text-transform: capitalize;"> <b>Your Text:</b> <?php echo $query['q_text'] ?></h5>
                            <p class=" card-text"><b>Reply: </b><?php echo  $query['rep_text'] ?></p>

                            <!-- update -->
                            <a class="btn btn-primary" href="askQuery.php">Ask Anything Else</a>


                        </div>
                    </div>
                <?php
                }
            } else { ?>
                <tr>


                    <<h3 class="py-4 text-center">There is no query reply</h3>

                </tr>
            <?php
            }
            ?>







        </div>
    </div>
</body>

</html>