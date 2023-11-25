<?php
// session_start();
include('../includes/config.php');
include('header.php');
include ('sidebar.php');

if (!isset($_SESSION['mentor_id'])) {
  header('Location: mlogin.php');
  exit();
}

$mentor_id = $_SESSION['mentor_id'];

// Fetch the student's information
$query = "SELECT * FROM accounts WHERE mentor_id = '$mentor_id'";
$result = mysqli_query($db_conn, $query);
$student_info = mysqli_fetch_assoc($result);

?>


  <!-- Content Wrapper. Contains page content -->
  
    <!-- /.content-header -->

    
     <!-- Main content -->
     <section class="content">
     <div class="card-body " id="form-container">
    <center>
      <h1 class="card-body bg-yellow ">
        WELCOME,
        <?php echo $student_info['fname'] . ' ' . $student_info['lname']; ?>
      </h1>
    </center>
     
    <div class="card-tools">
      <!-- Student Information -->
      <div class="card">
        <div class="card-body" id="form-container">
        <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">Mentor Information</legend>
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>Mentor Id.</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Department Id</th>
              <th>Email</th>
              <th>Phone Number</th>

            </tr>
              <tr>
                <td><?php echo isset($student_info['mentor_id']) ? $student_info['mentor_id'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['fname']) ? $student_info['fname'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['lname']) ? $student_info['lname'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['dept_id']) ? $student_info['dept_id'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['email']) ? $student_info['email'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['phone_number']) ? $student_info['phone_number'] : 'No Entry'; ?></td>
               
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </fieldset>
       
      <div class="card-body" id="form-container">
        <a href="user_accounts.php" class="btn btn-primary">Edit Mentor Information</a>
      </div>
        
        </div>
      </div>
      
     
    </div>
  </div>
    </section>
<?php include('footer.php') ?>
