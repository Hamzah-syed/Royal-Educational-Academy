
<?php
include("../database_connection.php");
include("../layout/layout.php");

//demo session
$_SESSION["faculty_id"] = 1;
$_SESSION["roleId"] = 2;
$_SESSION["batchId"] = 6;


if ($_SESSION["roleId"] === 3) {
    header("Location:./dashboard.php");
}

//search
if (isset($_POST['SearchAsgByName'])) {
   
       $searchValue = $_POST['searchByBatch'];
        
    
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Batch</title>
</head>
<body>
    <div class="customcontainer">
<form name="serachByBatch" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

                <div class="form-group  ">
                    <label for="exampleInputbatch" class="">
                        <h4>Select Batch Code</h4>
                    </label>
                    <select name="searchByBatch" id="searchByBatch" class="form-control" required>


                        <option disabled  > Select Batch </option>;
                        <?php
                        $sql = mysqli_query($con, "SELECT b_id, b_code From batch_tbl ");
                        $batch = mysqli_query($con, "SELECT b_id From batch_tbl WHERE b_id = $searchValue");
                        $row = mysqli_num_rows($sql);
                        while ($row = mysqli_fetch_assoc($sql)) { ?>

                            <option value="<?php echo $row['b_id'] ?>"> <?php echo $row['b_code'] ?> </option>
                            
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group  ">
                     <!-- update -->
                     <a name="SearchAsgByName"  href="batchAssignments.php?batch_id=<?php echo $searchValue ?>" class="btn  btn-primary">Search</a>
                    <button type="submit" name="SearchAsgByName" id="SearchAsgByName" class="btn btn-primary  px-5">Search</button>
                    </select>
                </div>
            </form>
        </div>
</body>
</html>