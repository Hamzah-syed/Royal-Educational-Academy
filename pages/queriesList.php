<?php
include("../database_connection.php");


session_start();


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
    <title>Students Data</title>

</head>

<body>
    <div id="wrapper">
        <?php include '../layout/layout.php' ?>
        <div class="customcontainer  table-responsive">
            <h1 class="text-center blackColor" style="margin-bottom:50px;">All Batches</h1>
            <!-- <div class = "py-3" >
            <form class="d-flex align-items-center " method="GET">


                <input type="text" name="searchValue" id="searchValue" placeholder="Search Data" class="form-control" style="width:300px"/>
                <input type="submit" name="search_Code" id="search_Code" class="btn btn-info py-1 mx-2 form-control"style="width:100px" />
            </form>
        </div> -->




            <?php

            $AllStudentsQuery = "SELECT query_tbl.q_id , query_tbl.q_status, query_tbl.q_text ,users_tbl.u_name  FROM query_tbl , students_tbl , users_tbl WHERE  students_tbl.std_id = query_tbl.q_std_fk  AND users_tbl.u_id =  students_tbl.std_info_fk AND query_tbl.q_status = 1";
            $fire = mysqli_query($con, $AllStudentsQuery) or die("data not found " . mysqli_error($con));

            // condition that if data rows is greater than 0
            if (mysqli_num_rows($fire) > 0) {
                # code...

                while ($student = mysqli_fetch_assoc($fire)) { ?>

                    <div class="card my-4">
                        <div class="card-header" style="text-transform: capitalize;">
                            Query id #<?php echo $student['q_id'] ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" style="text-transform: capitalize;"><?php echo $student['u_name'] ?></h5>
                            <p class=" card-text"><?php echo  $student['q_text'] ?></p>
                            <a href="#" class="btn btn-primary">Reply</a>
                            <a href="<?php
                                        $_SERVER['PHP_SELF']
                                        ?> ?query_del=<?php echo  $student['q_id'] ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                <?php
                }
            } else { ?>
                <tr>


                    <<h3 class="py-4">No Data Found!. Insert Data </h3>

                </tr>
            <?php
            }
            ?>







        </div>
    </div>
</body>

</html>