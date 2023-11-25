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
$query = "SELECT * FROM student_details WHERE ssn = '$ssn'";
$result = mysqli_query($db_conn, $query);
$student_info = mysqli_fetch_assoc($result);

$query1 = "SELECT * FROM enroll_course WHERE ssn = '$ssn'";
$result1 = mysqli_query($db_conn, $query1);
// $student_info1 = mysqli_fetch_assoc($result1);

$query2 = "SELECT * FROM meeting WHERE ssn = '$ssn'";
$result2 = mysqli_query($db_conn, $query2);
// $student_info2 = mysqli_fetch_assoc($result2);

$query3 = "SELECT * FROM academic WHERE ssn = '$ssn'";
$result3 = mysqli_query($db_conn, $query3);
// $student_info3 = mysqli_fetch_assoc($result3);

$query4 = "SELECT * FROM project WHERE ssn = '$ssn'";
$result4 = mysqli_query($db_conn, $query4);
// $student_info4 = mysqli_fetch_assoc($result4);

$query5 = "SELECT * FROM per_dev WHERE ssn = '$ssn'";
$result5 = mysqli_query($db_conn, $query5);
// $student_info5 = mysqli_fetch_assoc($result5);

$query6 = "SELECT * FROM health WHERE ssn = '$ssn'";
$result6 = mysqli_query($db_conn, $query6);
// $student_info6 = mysqli_fetch_assoc($result6);

$query7 = "SELECT * FROM career WHERE ssn = '$ssn'";
$result7 = mysqli_query($db_conn, $query7);
// $student_info7 = mysqli_fetch_assoc($result7);

$query8 = "SELECT * FROM issue WHERE ssn = '$ssn'";
$result8 = mysqli_query($db_conn, $query8);
// $student_info8 = mysqli_fetch_assoc($result8);

?>


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
        <fieldset class="border border-secondary p-20 form-group">
            <legend class="d-inline w-auto h6">Student Information</legend>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>SSN</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mentor Id</th>
                <th>Department Id</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>DOB</th>
                <th>Father's Name</th>
                <th>Father's Phone Number</th>
                <th>Mother's Name</th>
                <th>Mother's Phone Number</th>
              </tr>
         
             
              <tr>
                <td><?php echo isset($student_info['ssn']) ? $student_info['ssn'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['fname']) ? $student_info['fname'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['lname']) ? $student_info['lname'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['mentor_id']) ? $student_info['mentor_id'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['dept_id']) ? $student_info['dept_id'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['email']) ? $student_info['email'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['phone_number']) ? $student_info['phone_number'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['dob']) ? $student_info['dob'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['father_name']) ? $student_info['father_name'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['father_num']) ? $student_info['father_num'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['mother_name']) ? $student_info['mother_name'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info['mother_num']) ? $student_info['mother_num'] : 'No Entry'; ?></td>
              </tr>
              </thead>
              <tbody></tbody>
            
          </table>
        </fieldset>
        </div>
      </div>
      <!-- Course Enrolled -->
      <div class="card">
        <div class="card-body" id="form-container">
        <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6"> Course Enrolled</legend>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Enroll Id.</th>
                <th>SSN</th>
                <th>Course Id.</th>
                <th>Semester</th>
              </tr>
              <?php
              // Iterate through the results and display each record
              while ($student_info1 = mysqli_fetch_assoc($result1)) {
              ?>
              <tr>
                <td><?php echo isset($student_info1['enroll_id']) ? $student_info1['enroll_id'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info1['ssn']) ? $student_info1['ssn'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info1['course_id']) ? $student_info1['course_id'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info1['sem']) ? $student_info1['sem'] : 'No Entry'; ?></td>
              </tr>
            </thead>
            <?php } ?>
            <tbody></tbody>
           
          </table>
        </fieldset>
        </div>
      </div>
      <!-- Meetings -->
      <div class="card">
        <div class="card-body" id="form-container">
        <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">Meetings </legend>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Meeting Id.</th>
                <th>SSN</th>
                <th>Mentor Id</th>
                <th>Semester</th>
                <th>Location</th>
                <th>Date</th>
                <th>Time</th>
              </tr>
              <?php
              // Iterate through the results and display each record
              while ($student_info2 = mysqli_fetch_assoc($result2)) {
              ?>
              <tr>
              <tr>
                <td><?php echo isset($student_info2['meet_id']) ? $student_info2['meet_id'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info2['ssn']) ? $student_info2['ssn'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info2['mentor_id']) ? $student_info2['mentor_id'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info2['sem']) ? $student_info2['sem'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info2['loc']) ? $student_info2['loc'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info2['date_']) ? $student_info2['date_'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info2['time_']) ? $student_info2['time_'] : 'No Entry'; ?></td>
              </tr>
            </thead>
            <?php } ?>
            <tbody>
          </table>
        </fieldset>
        </div>
      </div>
      <!-- Academic Progress -->
      <div class="card">
        <div class="card-body" id="form-container">
        <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">Academic Progress</legend>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Semester</th>
                <th>SSN</th>
                <th>Date</th>
                <th>GPA</th>
                <th>Credits Completed</th>
                <th>Credits Remaining</th>
              </tr>
              <?php
              // Iterate through the results and display each record
              while ($student_info3 = mysqli_fetch_assoc($result3)) {
              ?>
              <tr>
                <td><?php echo isset($student_info3['sem']) ? $student_info3['sem'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info3['ssn']) ? $student_info3['ssn'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info3['date_']) ? $student_info3['date_'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info3['gpa']) ? $student_info3['gpa'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info3['credits_com']) ? $student_info3['credits_com'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info3['credits_rem']) ? $student_info3['credits_rem'] : 'No Entry'; ?></td>
              </tr>
            </thead>
            <?php } ?>
            <tbody></tbody>
          </table>
        </fieldset>
        </div>
      </div>
      <!-- Capstone Project -->
      <div class="card">
        <div class="card-body" id="form-container">
        <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">Capstone Project</legend>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Semester</th>
                <th>SSN</th>
                <th>Project Id</th>
                <th>Date</th>
                <th>Title</th>
                <th>Number of Members</th>
                <th>Status</th>
                <th>Guide</th>
              </tr>
              <?php
              // Iterate through the results and display each record
              while ($student_info4 = mysqli_fetch_assoc($result4)) {
              ?>
              <tr>
                <td><?php echo isset($student_info4['sem']) ? $student_info4['sem'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info4['ssn']) ? $student_info4['ssn'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info4['project_id']) ? $student_info4['project_id'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info4['date_']) ? $student_info4['date_'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info4['title']) ? $student_info4['title'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info4['group_num']) ? $student_info4['group_num'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info4['status']) ? $student_info4['status'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info4['guide']) ? $student_info4['guide'] : 'No Entry'; ?></td>
              </tr>
            </thead>
            <?php } ?>
            <tbody></tbody>
          </table>
        </fieldset>
        </div>
      </div>
      <!-- Personal Development -->
      <div class="card">
        <div class="card-body" id="form-container">
        <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">Personal Development</legend>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Semester</th>
                <th>SSN</th>
                <th>Date</th>
                <th>Event Participated</th>
                <th>Awards and Achievements</th>
                <th>Hobbies and Interests</th>
                <th>Personal Goals</th>
              </tr>
              <?php
              // Iterate through the results and display each record
              while ($student_info5= mysqli_fetch_assoc($result5)) {
              ?>
              <tr>
                <td><?php echo isset($student_info5['sem']) ? $student_info5['sem'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info5['ssn']) ? $student_info5['ssn'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info5['date_']) ? $student_info5['date_'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info5['event_part']) ? $student_info5['event_part'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info5['award']) ? $student_info5['award'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info5['hobby']) ? $student_info5['hobby'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info5['goal']) ? $student_info5['goal'] : 'No Entry'; ?></td>
              </tr>
            </thead>
            <?php } ?>
            <tbody></tbody>
          </table>
        </fieldset>
        </div>
      </div>
      <!-- Physical Health -->
      <div class="card">
        <div class="card-body" id="form-container">
        <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">Physical Health</legend>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Semester</th>
                <th>SSN</th>
                <th>Date</th>
                <th>Issue</th>
                <th>Exercise Plans</th>
                <th>Progress</th>
                <th>Height</th>
                <th>Weight</th>
              </tr>
              <?php
              // Iterate through the results and display each record
              while ($student_info6= mysqli_fetch_assoc($result6)) {
              ?>

              <tr>
                <td><?php echo isset($student_info6['sem']) ? $student_info6['sem'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info6['ssn']) ? $student_info6['ssn'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info6['date_']) ? $student_info6['date_'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info6['issue']) ? $student_info6['issue'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info6['plan']) ? $student_info6['plan'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info6['progress']) ? $student_info6['progress'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info6['height']) ? $student_info6['height'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info6['weight']) ? $student_info6['weight'] : 'No Entry'; ?></td>
              </tr>
            </thead>
            <?php } ?>
            <tbody></tbody>
          </table>
        </fieldset>
        </div>
      </div>
      <!-- Career Development -->
      <div class="card">
        <div class="card-body" id="form-container">
        <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6"> Career Development</legend>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Semester</th>
                <th>SSN</th>
                <th>Date</th>
                <th>Internships</th>
                <th>Career Plans</th>
                <th>Resume Link</th>
                <th>Job Offers</th>
              </tr>
              <?php
              // Iterate through the results and display each record
              while ($student_info7= mysqli_fetch_assoc($result7)) {
              ?>
              <tr>
                <td><?php echo isset($student_info7['sem']) ? $student_info7['sem'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info7['ssn']) ? $student_info7['ssn'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info7['date_']) ? $student_info7['date_'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info7['intern']) ? $student_info7['intern'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info7['plan']) ? $student_info7['plan'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info7['resume']) ? $student_info7['resume'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info7['job']) ? $student_info7['job'] : 'No Entry'; ?></td>
              </tr>
            </thead>
            <?php } ?>
            <tbody></tbody>
          </table>
        
        </div>
      </div>
      </fieldset>
      <!-- Student Issues -->
      <div class="card">
        <div class="card-body" id="form-container">
        <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">  Student Issues </legend>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Semester</th>
                <th>SSN</th>
                <th>Date</th>
                <th>Time</th>
                <th>Issues</th>
                <th>Solution Provided</th>
                <th>Feedback</th>
              </tr>
              <?php
              // Iterate through the results and display each record
              while ($student_info8= mysqli_fetch_assoc($result8)) {
              ?>
              <tr>
                <td><?php echo isset($student_info8['sem']) ? $student_info8['sem'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info8['ssn']) ? $student_info8['ssn'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info8['date_']) ? $student_info8['date_'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info8['time_']) ? $student_info8['time_'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info8['issues']) ? $student_info8['issues'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info8['solution_provided']) ? $student_info8['solution_provided'] : 'No Entry'; ?></td>
                <td><?php echo isset($student_info8['advice_given']) ? $student_info8['advice_given'] : 'No Entry'; ?></td>
              </tr>
            </thead>
            <?php } ?>
            <tbody></tbody>
          </table>
        </fieldset>
        </div>
      </div>
      <div class="card">
      <div class="card-body  bg-yellow" id="form-container">
          <a href="mentor_info.php" class="nav-link" title="Update">Mentor Information<i class="fa fa-sign-out-alt"></i></a>
        </div>
      <div class="card-body  bg-yellow" id="form-container">
          <a href="student_info.php" class="nav-link" title="Update">Update<i class="fa fa-sign-out-alt"></i></a>
        </div>
        <div class="card-body  bg-yellow" id="form-container">
          <a href="../logout.php" class="nav-link" title="logout">Logout<i class="fa fa-sign-out-alt"></i></a>
        </div>
       
      </div>
    
    </div>
  </div>

  
 