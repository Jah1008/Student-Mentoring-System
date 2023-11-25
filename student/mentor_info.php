<?php
// session_start();
include('../includes/config.php');
include('header.php');

if (!isset($_SESSION['ssn'])) {
  header('Location: slogin.php');
  exit();
}

$ssn = $_SESSION['ssn'];

// Fetch the student's information
$query_student = "SELECT * FROM student_details WHERE ssn = '$ssn'";
$result_student = mysqli_query($db_conn, $query_student);
$student_info = mysqli_fetch_assoc($result_student);

// Fetch the mentor's information using a JOIN operation
$query_mentor = "SELECT accounts.*, student_details.mentor_id
                FROM accounts
                JOIN student_details ON accounts.mentor_id = student_details.mentor_id
                WHERE student_details.ssn = '$ssn'";
$result_mentor = mysqli_query($db_conn, $query_mentor);
$mentor_info = mysqli_fetch_assoc($result_mentor);
?>

<div class="card-body " id="form-container">
  <center>
    <h1 class="card-body bg-yellow ">
      WELCOME,
      <?php echo $student_info['fname'] . ' ' . $student_info['lname']; ?>
    </h1>
  </center>

  <!-- Student Information -->
  
  <!-- Mentor Information -->
  <div class="card">
    <div class="card-body" id="form-container">
      <fieldset class="border border-secondary p-20 form-group">
        <legend class="d-inline w-auto h6">Mentor Information</legend>
        <!-- Display mentor information table -->
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Mentor Id</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email Id</th>
              <th>Phone Number</th>
              <!-- Add other mentor information columns as needed -->
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo isset($mentor_info['mentor_id']) ? $mentor_info['mentor_id'] : 'No Entry'; ?></td>
              <td><?php echo isset($mentor_info['fname']) ? $mentor_info['fname'] : 'No Entry'; ?></td>
              <td><?php echo isset($mentor_info['lname']) ? $mentor_info['lname'] : 'No Entry'; ?></td>
              <td><?php echo isset($mentor_info['email']) ? $mentor_info['email'] : 'No Entry'; ?></td>
              <td><?php echo isset($mentor_info['phone_number']) ? $mentor_info['phone_number'] : 'No Entry'; ?></td>
              <!-- Add other mentor information cells as needed -->
            </tr>
          </tbody>
        </table>
      </fieldset>
    </div>
  </div>


</div>
