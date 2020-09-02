<body>
<div class="container-scroller">
<!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo text-white" href="index.html">PRAXIS NATION</a>
          <a class="sidebar-brand brand-logo-mini text-white" href="index.html">
          	P N
          </a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="assets/images/adminlogo.png" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">
                 <?php 
                 echo $_SESSION['teacher_name'];  ?>
               </h5>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="institutionprofile.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="institutionprofile.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                  </div>
                </a>
              
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="teacherindex.php">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          
          <li class="nav-item menu-items">
            <a class="nav-link" href="syllabus.php">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Syllabus</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="schedule.php">
              <span class="menu-icon">
                <i class="mdi mdi-chart-bar"></i>
              </span>
              <span class="menu-title">Schedule</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="studentdetail.php">
              <span class="menu-icon">
                <i class="mdi mdi-table-large"></i>
              </span>
              <span class="menu-title">Student Details</span>
            </a>
          </li>
       <li class="nav-item menu-items">
            <a class="nav-link" href="microlessonplan.php">
              <span class="menu-icon">
                <i class="mdi mdi-contacts"></i>
              </span>
              <span class="menu-title">Micro Lesson Plans</span>
            </a>
          </li>
           <li class="nav-item menu-items">
            <a class="nav-link" href="classreport.php">
              <span class="menu-icon">
                <i class="mdi mdi-chart-arc"></i>
              </span>
              <span class="menu-title">Class Report</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">Resources</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="assignment.php">Assignment</a></li>
                <li class="nav-item"> <a class="nav-link" href="uploadvideo.php">Upload Video</a></li>
                <li class="nav-item"> <a class="nav-link" href="material.php">Study Material</a></li>
              </ul>
            </div>
          </li>
          
     <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-security"></i>
              </span>
              <span class="menu-title">Support</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="studentquery.php">Student Queries </a></li>
               <!-- <li class="nav-item"> <a class="nav-link" href="support.php">Support </a></li> -->
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">

        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini text-white" href="index.html">P N</a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            
            <ul class="navbar-nav navbar-nav-right">
              
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email"></i>
                  <span class="count bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0">Student Doubts</h6>
                  <div class="dropdown-divider"></div>
                  <?php 

    $query = "SELECT * FROM student_query order by query_id DESC LIMIT 04";
    $query_run = mysqli_query($connection, $query);
    $check_course = mysqli_num_rows($query_run)>0;
    if($check_course){
      while($row = mysqli_fetch_array($query_run)){
         $topic_id = $row['student_id'];
        $topic = "SELECT * FROM student where student_id = $topic_id ";
         $topic_run = mysqli_query($connection, $topic);
        ?>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="assets/images/adminlogo.png" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1"><?php foreach($topic_run as $topic_row){ echo $topic_row['student_name'];} ?> asked a query.</p></p>
                      <p class="text-muted mb-0"></p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                   <?php
      }
    }

    ?>
                  <a href="studentquery.php">
                  <p class="p-3 mb-0 text-center">View all</p>
              </a>
                </div>
              </li>
            <!--  <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                  <span class="count bg-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-calendar text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1"></p>
                      <p class="text-muted ellipsis mb-0">XYZ requested a demo.</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1"></p>
                      <p class="text-muted ellipsis mb-0"> ABC wants to contact you.</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all notifications</p>
                </div>
              </li> -->
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="assets/images/adminlogo.png" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name">
                 <?php 
                 echo $_SESSION['teacher_name'];  ?>
               </p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profile</h6>
                  <div class="dropdown-divider"></div>
                  <a href="logout.php" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Log out</p>
                    </div>
                  </a>
            </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
      

        <div class="main-panel">
          <div class="content-wrapper">