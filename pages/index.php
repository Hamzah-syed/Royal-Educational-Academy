<?php
//connection
session_start();
include("../database_connection.php");

if (isset($_SESSION["rolesId"])) {
  header("Location:./dashboard.php");
}

if (isset($_POST['loginSubmit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT users_tbl.u_name,users_tbl.u_id, roles_tbl.r_id  FROM users_tbl, roles_tbl  WHERE roles_tbl.r_id = users_tbl.r_id_fk AND u_email = '$email' && u_password= '$password'  ";
  $fire =  mysqli_query($con, $query);

  $row = mysqli_num_rows($fire);
  if ($row == 1) {
    $data = mysqli_fetch_array($fire);
    $_SESSION["userName"] = $data['u_name'];
    $_SESSION["roleId"] = $data['r_id'];

    if ($_SESSION["roleId"] == 2) {

      $query = "SELECT faculty_tbl.fac_id  FROM faculty_tbl,users_tbl  WHERE faculty_tbl.fac_info_fk = users_tbl.u_id   ";
      $fire2 =  mysqli_query($con, $query);
      $Facdata = mysqli_fetch_array($fire2);
      $_SESSION["faculty_id"] = $Facdata['fac_id'];
    }
    if ($_SESSION["roleId"] == 3) {
      "welcome";
      $query = "SELECT students_tbl.std_id,students_tbl.std_batch_fk FROM students_tbl ,users_tbl  WHERE students_tbl.std_info_fk = users_tbl.u_id   ";
      $fire3 =  mysqli_query($con, $query);
      $stdData = mysqli_fetch_array($fire3);
      $_SESSION["student_id"] = $stdData['std_id'];
      $_SESSION["batchId"] = $stdData['std_batch_fk'];
    }

    header("Location:./dashboard.php");
  } else {
    echo  "<script>alert('invalid email or password')</script>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Royal Learning Academy</title>



  <!-- Custom fonts for this template-->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>
  <div class="bg-primary" style="width: 100%; height:100vh;display:flex" class="d-flex align-content-center flex-column">
    <div class="container ">

      <!-- Outer Row -->
      <div style="width: 100%;height:100vh" class="row justify-content-center align-items-center">

        <div class="col-xl-6 col-lg-6 col-md-9">

          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">

                <div class="col-lg-12">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Login</h1>
                    </div>
                    <form class="user" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                      <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." required>
                      </div>
                      <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                      </div>
                      <div class="form-group">

                      </div>
                      <button name="loginSubmit" class="btn btn-primary btn-user btn-block">
                        Login
                      </button>

                    </form>
                    <hr>
                    <div class="text-center">
                      <p class="small" href="forgot-password.html">Forgot Password? Contact To Admin</p>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>


    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>