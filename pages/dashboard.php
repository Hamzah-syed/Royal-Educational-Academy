<?php
include("../database_connection.php");
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="../assets/css/main.css">
  <title>Dashboard</title>




</head>

<body id="page-top">

  <div id="wrapper">
    <?php include '../layout/layout.php' ?>
    <!-- Begin Page Content -->
    <div class="container-fluid ">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      </div>

      <!-- Content Row -->
      <?php
      if ( $_SESSION["roleId"] != 3) { ?>
        <div class="row">
  
          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Students</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php
                      $query = "SELECT * FROM students_tbl ";
                      $fire = mysqli_query($con, $query);
  
                      if ($fire) {
                        // it return number of rows in the table. 
                        $row = mysqli_num_rows($fire);
  
                        if ($row) {
                          printf($row);
                        }
                        // close the result. 
                        mysqli_free_result($fire);
                      }
                      ?>
  
                    </div>
                  </div>
                  <div class="col-auto">
  
                    <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
          <!-- Earnings (Monthly) Card Example -->
  
  
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Faculty</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php
                      $query = "SELECT * FROM faculty_tbl ";
                      $fire = mysqli_query($con, $query);
  
                      if ($fire) {
                        // it return number of rows in the table. 
                        $row = mysqli_num_rows($fire);
  
                        if ($row) {
                          printf($row);
                        }
                        // close the result. 
                        mysqli_free_result($fire);
                      }
                      ?>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-user fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
  
          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Batches</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php
                      $query = "SELECT * FROM batch_tbl ";
                      $fire = mysqli_query($con, $query);
  
                      if ($fire) {
                        // it return number of rows in the table. 
                        $row = mysqli_num_rows($fire);
  
                        if ($row) {
                          printf($row);
                        }
                        // close the result. 
                        mysqli_free_result($fire);
                      }
                      ?>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
  
  
  
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Assignments</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
  
                      <?php
                      $query = "SELECT * FROM faculty_tbl ";
                      $fire = mysqli_query($con, $query);
  
                      if ($fire) {
                        // it return number of rows in the table. 
                        $row = mysqli_num_rows($fire);
  
                        if ($row) {
                          printf($row);
                        }
                        // close the result. 
                        mysqli_free_result($fire);
                      }
                      ?>
  
                    </div>
                  </div>
                  <div class="col-auto">
  
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       <?php
      }
      
      ?>

      <!-- Content Row -->

      <div class="row">

        <!-- Area Chart -->
        <div class="col-12">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Instructions</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">


              <?php
              if ($_SESSION["roleId"] == 2 ||  $_SESSION["roleId"] == 1) { ?>

                <div class="alert alert-warning mb-4" role="alert">
                  <h4 class="alert-heading">Faculty Instructions</h4>
                  <li class="px-4 py-2">Make sure that assignment file should be in pdf format! </li>
                  <li class="px-4 py-2">Create Assignment before assigning assignments.</li>
                  <li class="px-4 py-2">Faculty members are not able to see or use assignments added by other faculty.</li>
                  <li class="px-4 py-2">Faculty can see and give marks to only those assignments which was assign by him/her </li>
                  <hr>
                  <p class="mb-0">Contact Admin For Any Query.</p>
                </div>
              <?php
              }
              ?>

              <?php
              if ($_SESSION["roleId"] == 3 ||  $_SESSION["roleId"] == 1) { ?>


                <div class="alert alert-warning mb-4" role="alert">
                  <h4 class="alert-heading">Students Instructions</h4>
                  <li class="px-4 py-2">Make sure that assigment should be in pdf format </li>
                  <li class="px-4 py-2">You can find your assignments marks from marks page by entering your roll number</li>

                  <hr>
                  <p class="mb-0">Go to query page to ask any question</p>
                </div>
              <?php
              }
              ?>



            </div>
          </div>
        </div>





      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Royal Learning Academy 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

</body>

</html>