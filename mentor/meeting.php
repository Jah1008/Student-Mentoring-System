<?php
// session_start();
include('../includes/config.php');
include('header.php');
include ('sidebar.php');

if (!isset($_SESSION['mentor_id'])) {
  header('Location: ../mlogin.php');
  exit();
}

$mentor_id = $_SESSION['mentor_id'];

// Fetch the student's information
$query = "SELECT * FROM meeting WHERE mentor_id = '$mentor_id'";
$result = mysqli_query($db_conn, $query);
// $student_info = mysqli_fetch_assoc($result);

?>


  <!-- Content Wrapper. Contains page content -->
  
    <!-- /.content-header -->

    
     <!-- Main content -->
     <section class="content">
     <div class="card-body " id="form-container">
    
     
    <div class="card-tools">
      <!-- Student Information -->
      <div class="card">
        <div class="card-body" id="form-container">
        <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">Meeting Information</legend>
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>Meeting Id.</th>
              <th>Student SSN</th>
              <th>Mentor_id</th>
              <th>Semester</th>
              <th>Location</th>
              <th>Date</th>
              <th>Time</th>

            </tr>
            <?php
              // Iterate through the results and display each record
              while ($student_info= mysqli_fetch_assoc($result)) {
              ?>
              <tr>
                <td><?php echo isset($student_info['meet_id']) ? $student_info['meet_id'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['ssn']) ? $student_info['ssn'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['mentor_id']) ? $student_info['mentor_id'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['sem']) ? $student_info['sem'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['loc']) ? $student_info['loc'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['date_']) ? $student_info['date_'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['time_']) ? $student_info['time_'] : 'No Entry'; ?></td>
               
              </tr>
            </thead>
            <?php } ?>
            <tbody></tbody>
          </table>
        </fieldset>
       
   
        
        </div>
      </div>
      
     
    </div>
  </div>
    </section>
<?php include('footer.php') ?>
