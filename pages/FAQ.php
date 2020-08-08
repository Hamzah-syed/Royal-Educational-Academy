<?php
include("../database_connection.php");


session_start();
// if ($_SESSION["roleId"] == 3 || $_SESSION["roleId"] == 2) {
//     header("Location:./dashboard.php");
// }
//Delete Data
if (isset($_GET['faq_id'])) {

    $faqId = $_GET['faq_id'];


    $deletefaqQuery = "DELETE FROM faqs_tbl WHERE faq_id = ' $faqId'";


    $fire = mysqli_query($con, $deletefaqQuery) or die("this faq is not deleted" . mysqli_error($con));
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>FAQ's</title>
    <style>
        #headingOne {
            cursor: pointer;
        }
    </style>

</head>

<body>
    <div id="wrapper">
        <?php include '../layout/layout.php' ?>
        <div class="customcontainer  table-responsive">
            <h1 class="text-center blackColor" style="margin-bottom:50px;">FAQ's</h1>


            <?php

            $AllFAQQuery = "SELECT *  FROM faqs_tbl";
            $fire = mysqli_query($con, $AllFAQQuery) or die("data not found " . mysqli_error($con));

            // condition that if data rows is greater than 0
            if (mysqli_num_rows($fire) > 0) {
                # code...

                while ($student = mysqli_fetch_assoc($fire)) { ?>
                    <div id="accordion" class="my-4">
                        <div class="card">
                            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne<?php echo $student['faq_id'] ?>" aria-expanded="false" aria-controls="collapseOne">
                                <h5 class="mb-0">
                                    <a class="btn btn-link">
                                        <?php echo $student['faq_question'] ?>
                                    </a>
                                </h5>
                            </div>

                            <div id="collapseOne<?php echo $student['faq_id'] ?>" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <?php echo $student['faq_answer'] ?>
                                </div>
                                <?php
                                if ($_SESSION["roleId"] == 1) { ?>
                                    <div class="card-body">
                                        <!-- Delete -->
                                        <a href="<?php
                                                    $_SERVER['PHP_SELF']
                                                    ?> ?uId_del=<?php echo  $student['faq_id'] ?>" class="btn btn-danger">Delete</a>
                                        <!-- update -->
                                        <a href="updateFaq.php ?faq_update=<?php echo  $student['faq_id'] ?>" class="btn  btn-primary">Edit</a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                    </div>




                <?php
                }
            } else { ?>
                <tr>
                    <h3 class="py-4">No Data Found!. Insert FAQ's </h3>
                </tr>
            <?php
            }
            ?>





        </div>
    </div>
</body>

</html>