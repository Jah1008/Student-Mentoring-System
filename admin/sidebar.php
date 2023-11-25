 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
   
   
      <li class="nav-item">
        <a href="../logout.php" class="nav-link" title="logout">Logout<i class="fa fa-sig-out-alt"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="index3.html" class="brand-link">
    <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8" >
     <span class="brand-text font-weight-light">Admin</span>
    </a> -->
    <a href="dashboard.php" class="brand-link">
    <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin</span>
</a>

   
    

      

      <!-- Sidebar Menu -->
      <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        
           
               <li class="nav-item menu-open">
            <a href="<?=$site_url?>admin/dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               
              </p>
            </a> 
               </li>


               
              


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Accounts 
                <i class="fas fa-angle-left right"></i>
              </p>


            </a>
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=$site_url?>admin/user_accounts.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mentor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$site_url?>admin/fetch.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Events</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="<?=$site_url?>admin/student_info.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Students</p>
                  
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$site_url?>admin/course.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Courses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$site_url?>admin/dept.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Departments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$site_url?>admin/course_enrollment.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Course Enrollment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$site_url?>admin/meeting.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Meeting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$site_url?>admin/student_issue.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Issues</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?=$site_url?>admin/personal_d.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Personal Development </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$site_url?>admin/academic.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Academic Progress </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$site_url?>admin/career.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Career Development </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$site_url?>admin/health.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Physical health </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$site_url?>admin/project.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Capstone Project </p>
                </a>
              </li>
</ul>
</ul>


        
      </nav>
    
    </div>
    <!-- /.sidebar -->
  </aside>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
   
    <!-- /.content -->
 
  <!-- /.content-wrapper -->

 