<?php

if (!isset($_SESSION["userName"])) {
  header("Location:./index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Custom fonts for this template-->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
  <title>Royal Learning Academy</title>
</head>

<body>

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">

      </div>
      <div class="sidebar-brand-text mx-3">Royal Learning Academy</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="dashboard.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <?php
    if ($_SESSION["roleId"] == 1) { ?>

      <div class="sidebar-heading">
        Users
      </div>

      <!-- Nav Item - Pages Collapse Menu -->

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseadmin" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-user-cog"></i>
          <span>Admins</span>
        </a>
        <div id="collapseadmin" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Admin Details</h6>
            <a class="collapse-item" href="./allAdmins.php">Admins</a>
            <a class="collapse-item" href="./addAdmin.php">Add Admin</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsefac" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-chalkboard-teacher"></i>
          <span>Faculty</span>
        </a>
        <div id="collapsefac" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Faculty Details</h6>
            <a class="collapse-item" href="./allFaculty.php">Faculty</a>
            <a class="collapse-item" href="./addFaculty.php">Add Faculty Member</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-user-graduate"></i>
          <span>Students</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Students Details</h6>
            <a class="collapse-item" href="./students.php">Students</a>
            <a class="collapse-item" href="./addStudent.php">Add Students</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
    <?php
    } else {
    ?>
      <div></div>
    <?php
    }
    ?>
    <!-- Heading -->
    <div class="sidebar-heading">
      Working
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Assignments</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Assignments Details:</h6>

          <?php
          if ($_SESSION["roleId"] == 2 || $_SESSION["roleId"] == 1) { ?>

            <a class="collapse-item" href="./assignment.php">Assignments</a>
          <?php
          } else {
          ?>
            <span></span>
          <?php
          }
          ?>
          <?php
          if ($_SESSION["roleId"] == 2) { ?>

            <a class="collapse-item" href="./add_assignment.php">Add Assignment</a>
          <?php
          } else {
          ?>
            <span></span>
          <?php
          }
          ?>
          <?php
          if ($_SESSION["roleId"] == 3) { ?>

            <a class="collapse-item" href="./submitAsg.php">Submit Assignment</a>
          <?php
          } else {
          ?>
            <span></span>
          <?php
          }
          ?>
          <?php
          if ($_SESSION["roleId"] == 2) { ?>

            <div class="collapse-divider">
              <h6 class="collapse-header">Assign Assignments:</h6>
              <a class="collapse-item" href="./assignedAssignment.php">Assign Assignments</a>
            </div>
          <?php
          } else {
          ?>
            <span></span>
          <?php
          }
          ?>

          <div class="collapse-divider">
            <h6 class="collapse-header">Assignments List:</h6>

            <a class="collapse-item" href="./batchAssignments.php">Batch Assignments</a>
            <?php
            if ($_SESSION["roleId"] == 2 || $_SESSION["roleId"] == 1) { ?>

              <div class="collapse-divider">
                <a class="collapse-item" href="./submittedAsgList.php">Submitted Assignments</a>
              </div>
            <?php
            } else {
            ?>
              <span></span>
            <?php
            }
            ?>
          </div>
        </div>
    </li>
    <?php
    if ($_SESSION["roleId"] == 1) { ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsethree" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-chalkboard-teacher"></i>
          <span>Batches</span>
        </a>

        <div id="collapsethree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Batches</h6>
            <a class="collapse-item" href="./batches.php">All Batches</a>
            <a class="collapse-item" href="./addBatch.php">Add Batch</a>
          </div>
        </div>
      </li>
    <?php
    } else {
    ?>
      <span></span>
    <?php
    }
    ?>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsefoure" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-comments"></i>
        <span>Feedback/Question</span>
      </a>

      <div id="collapsefoure" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Queries</h6>
          <?php
          if ($_SESSION["roleId"] == 3) { ?>
            <a class="collapse-item" href="./askQuery.php">Feedback/Question Form</a>
            <a class="collapse-item" href="./replyQueryList.php">Feedback/Question Reply</a>
          <?php
          } else {
          ?>
            <span></span>
          <?php
          }
          ?>
          <?php
          if ($_SESSION["roleId"] == 1 || $_SESSION["roleId"] == 2) { ?>
            <a class="collapse-item" href="./queriesList.php">Feedbacks/Questions List</a>
          <?php
          } else {
          ?>
            <span></span>
          <?php
          }
          ?>
        </div>
      </div>
    </li>


    <!-- Nav Item - Charts -->
    <li class="nav-item">
      <a class="nav-link" href="./marks.php">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Marks</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
      <a class="nav-link" href="FAQ.php">
        <i class="fas fa-question-circle"></i>
        <span>FAQ</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <div id="" class="mr-3">
          <p style="margin: 0;"><b class="text-primary">Welcome:</b> <?php
                                                                      if ($_SESSION["roleId"] == 1) {
                                                                        echo "Admin";
                                                                      } elseif ($_SESSION["roleId"] == 2) {
                                                                        echo "Faculty";
                                                                      } elseif ($_SESSION["roleId"] == 3) {
                                                                        echo $_SESSION["rollNumber"];
                                                                      }
                                                                      ?> </p>
        </div>


        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

          <!-- Nav Item - Search Dropdown (Visible Only XS) -->
          <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
              <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                  <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                      <i class="fas fa-search fa-sm"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>


          <!-- <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-bell fa-fw"></i>
         
              <span class="badge badge-danger badge-counter">3+</span>
            </a>
          
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
              <h6 class="dropdown-header">
                Alerts Center
              </h6>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle bg-primary">
                    <i class="fas fa-file-alt text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">December 12, 2019</div>
                  <span class="font-weight-bold">A new monthly report is ready to download!</span>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle bg-success">
                    <i class="fas fa-donate text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">December 7, 2019</div>
                  $290.29 has been deposited into your account!
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle bg-warning">
                    <i class="fas fa-exclamation-triangle text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">December 2, 2019</div>
                  Spending Alert: We've noticed unusually high spending for your account.
                </div>
              </a>
              <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
          </li>

       
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-envelope fa-fw"></i>
           
              <span class="badge badge-danger badge-counter">7</span>
            </a>
      
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
              <h6 class="dropdown-header">
                Message Center
              </h6>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                  <div class="status-indicator bg-success"></div>
                </div>
                <div class="font-weight-bold">
                  <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                  <div class="small text-gray-500">Emily Fowler · 58m</div>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                  <div class="status-indicator"></div>
                </div>
                <div>
                  <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                  <div class="small text-gray-500">Jae Chun · 1d</div>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                  <div class="status-indicator bg-warning"></div>
                </div>
                <div>
                  <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                  <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                  <div class="status-indicator bg-success"></div>
                </div>
                <div>
                  <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                  <div class="small text-gray-500">Chicken the Dog · 2w</div>
                </div>
              </a>
              <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
            </div>
          </li> -->

          <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="text-transform:capitalize;"><?php echo $_SESSION["userName"]; ?></span>
              <img class="img-profile rounded-circle" src="../assets/images/profilePic.png" width="60px" height="60px">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">


              <a class="dropdown-item" href="./logout.php">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
              </a>
            </div>
          </li>

        </ul>

      </nav>
</body>

<!-- Bootstrap core JavaScript-->
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>




</html>