<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<!-- Content Wrapper. Contains page content -->

<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <?php
      // Database connection and query to fetch the total students
      $student_count_query = "SELECT COUNT(*) AS total_students FROM student_details";
      $student_count_result = mysqli_query($db_conn, $student_count_query);
      $student_count = mysqli_fetch_assoc($student_count_result);

      // Query to fetch the total teachers
      $teacher_count_query = "SELECT COUNT(*) AS total_teachers FROM accounts";
      $teacher_count_result = mysqli_query($db_conn, $teacher_count_query);
      $teacher_count = mysqli_fetch_assoc($teacher_count_result);

      // Query to fetch the total meetings
      $meeting_count_query = "SELECT COUNT(*) AS total_meetings FROM meeting";
      $meeting_count_result = mysqli_query($db_conn, $meeting_count_query);
      $meeting_count = mysqli_fetch_assoc($meeting_count_result);
      ?>
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-graduation-cap"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Students</span>
            <span class="info-box-number">
              <?php echo $student_count['total_students']; ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Mentors</span>
            <span class="info-box-number"><?php echo $teacher_count['total_teachers']; ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Meetings</span>
            <span class="info-box-number"><?php echo $meeting_count['total_meetings']; ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col>

      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->

    <!-- /.row -->
  </div><!--/. container-fluid -->
</section>
<?php include('footer.php') ?>
