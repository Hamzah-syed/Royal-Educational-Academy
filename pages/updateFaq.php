<?php
//connection
include("../database_connection.php");

session_start();
if ($_SESSION["roleId"] == 3 || $_SESSION["roleId"] == 2) {
    header("Location:./dashboard.php");
}
//fetch data of particular id 
if (isset($_GET['faq_update'])) {

    $faq_id = $_GET['faq_update'];


    $userDataQuery = "SELECT * FROM faqs_tbl  WHERE faq_id ='$faq_id'";
    $fire = mysqli_query($con, $userDataQuery) or die('faqs is not selected' . mysqli_error($con));
    $faqs = mysqli_fetch_assoc($fire);
}

//updating data of particular id 
if (isset($_POST['updateFaq'])) {

    $faq_question = $_POST['faq_question'];
    $faq_answer = $_POST['faq_answer'];






    //user table data updated
    $UpdatefaqQuery =   "UPDATE  faqs_tbl SET faq_answer = '$faq_answer', faq_question  = '$faq_question'  WHERE faq_id = '$faq_id '";
    $fire1 = mysqli_query($con, $UpdatefaqQuery)  or die('faqs data is not updated' . mysqli_error($con));



    //if query executed succesfully
    if ($fire1) header("location:./FAQ.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <!-- css -->
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <div id="wrapper">
        <?php include '../layout/layout.php' ?>
        <form class="customcontainer" name="addAdmin" id="addAdmin" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <h1>Edit FAQ</h1>
            <div class="form-group">
                <label for="exampleInputName">Question</label>
                <input type="text" name="faq_question" id="faq_question" class="form-control" aria-describedby="emailHelp" value="<?php echo $faqs['faq_question']; ?>" placeholder="Enter Question" required>
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Answer</label>
                <textarea rows="6" name="faq_answer" id="faq_answer" class="form-control" aria-describedby="emailHelp" value="<?php echo $faqs['faq_answer']; ?>" placeholder="Enter Answer" required><?php echo $faqs['faq_answer']; ?></textarea>
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>




            <button type="submit" name="updateFaq" id="updateFaq" class="btn btn-primary mt-3">Submit</button>
        </form>
        <?php


        ?>
    </div>
</body>

</html>