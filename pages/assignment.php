<?php
include("../database_connection.php");
include("../layout/layout.php");

//demo session
$_SESSION["faculty_id"] = 1;
$_SESSION["roleId"] = 1;


if ($_SESSION["roleId"] === 3) {
    header("Location:./dashboard.php");
}

//Delete Data
if (isset($_GET['as_del'])) {

    $asDel = $_GET['as_del'];
    $asDelImg = $_GET['as_del_img'];
    $imagePath = "../assets/asg_files/" . $asDelImg;

    if (!unlink($imagePath)) {
        echo '<script>alert("you have an error")</script>';
        header("Location:assignment.php");
    }
    $deleteAsgQuery = "DELETE FROM assignments_tbl WHERE as_id = ' $asDel'";
    $fire = mysqli_query($con, $deleteAsgQuery) or die("this batch is not deleted " . mysqli_error($con));
}
// search
// if (isset($_GET['search_Code'])) {
//     $searchValue = $_GET['searchValue'];
// }


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
    <div class="customcontainer  table-responsive">
        <h1 class="text-center blackColor" style="margin-bottom:50px;">All Assignments</h1>
        <!-- <div class = "py-3" >
            <form class="d-flex align-items-center " method="GET">


                <input type="text" name="searchValue" id="searchValue" placeholder="Search Data" class="form-control" style="width:300px"/>
                <input type="submit" name="search_Code" id="search_Code" class="btn btn-info py-1 mx-2 form-control"style="width:100px" />
            </form>
        </div> -->
        <table class="table table-striped ">

            <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Title</th>
                    <th scope="col">File</th>
                    <th scope="col">Subject</th>

                    <th scope="col">Faculty</th>
                    <th scope="col"></th>

                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                <?php

                if ($_SESSION["roleId"] == 1) {
                    $AllAsgsQuery = "SELECT assignments_tbl.as_id ,assignments_tbl.as_title, assignments_tbl.as_file_path, assignments_tbl.as_faculty_fk, users_tbl.u_name, subject_tbl.subject_name  FROM assignments_tbl , faculty_tbl , users_tbl,subject_tbl WHERE  faculty_tbl.fac_id = assignments_tbl.as_faculty_fk  AND users_tbl.u_id = faculty_tbl.fac_info_fk AND subject_tbl.subject_id = assignments_tbl.as_subject_fk ";
                } else if ($_SESSION["roleId"] == 2) {
                    $AllAsgsQuery = "SELECT assignments_tbl.as_id ,assignments_tbl.as_title, assignments_tbl.as_file_path, assignments_tbl.as_faculty_fk, users_tbl.u_name,  subject_tbl.subject_name FROM assignments_tbl , faculty_tbl , users_tbl,subject_tbl WHERE  faculty_tbl.fac_id = assignments_tbl.as_faculty_fk  AND users_tbl.u_id = faculty_tbl.fac_info_fk AND subject_tbl.subject_id = assignments_tbl.as_subject_fk AND assignments_tbl.as_faculty_fk = '$_SESSION[faculty_id]' ";
                }


                $fire = mysqli_query($con, $AllAsgsQuery) or die("data not found " . mysqli_error($con));

                // condition that if data rows is greater than 0
                if (mysqli_num_rows($fire) > 0) {
                    # code...

                    while ($student = mysqli_fetch_assoc($fire)) { ?>
                        <tr>
                            <th scope="row"><?php echo $student['as_id'] ?></th>
                            <td><?php echo $student['as_title'] ?></td>
                            <td><a href="<?php echo "../assets/asg_files/" . $student['as_file_path'] ?>" target="_blank"> <?php echo $student['as_file_path'] ?></a></td>
                            <td><?php echo $student['subject_name'] ?></td>
                            <td><?php echo $student['u_name'] ?></td>

                            <td>
                                <!-- Delete -->
                                <a href="<?php
                                            $_SERVER['PHP_SELF']
                                            ?> ?as_del=<?php echo  $student['as_id'] ?>&as_del_img=<?php echo  $student['as_file_path'] ?>" class="btn btn-danger">Delete</a>

                            </td>

                        </tr>
                    <?php
                    }
                } else { ?>
                    <tr>

                        <h3 class="py-4">No Data Found!. Insert Data </h3>


                    </tr>
                <?php
                }
                ?>





            </tbody>
        </table>
        <?php
        if ($_SESSION["roleId"] == 2) {

            echo "<a href=./assignments/add_assignment.php>";
            echo  " <button class='btn btn-primary'>Add Assignment</button>";
            echo "</a>";
        }
        if ($_SESSION["roleId"] == 1) {

            echo "";
        }

        ?>
    </div>
</body>

</html>