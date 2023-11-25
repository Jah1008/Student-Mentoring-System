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
$student_info1 = mysqli_fetch_assoc($result1);
$query2 = "SELECT * FROM meeting WHERE ssn = '$ssn'";
$result2 = mysqli_query($db_conn, $query2);
$student_info2 = mysqli_fetch_assoc($result2);

$query3 = "SELECT * FROM academic WHERE ssn = '$ssn'";
$result3 = mysqli_query($db_conn, $query3);
$student_info3 = mysqli_fetch_assoc($result3);


$query4 = "SELECT * FROM project WHERE ssn = '$ssn'";
$result4 = mysqli_query($db_conn, $query4);
$student_info4 = mysqli_fetch_assoc($result4);



$query5 = "SELECT * FROM per_dev WHERE ssn = '$ssn'";
$result5 = mysqli_query($db_conn, $query5);
$student_info5 = mysqli_fetch_assoc($result5);

$query6 = "SELECT * FROM health WHERE ssn = '$ssn'";
$result6 = mysqli_query($db_conn, $query6);
$student_info6 = mysqli_fetch_assoc($result6);

$query7 = "SELECT * FROM career WHERE ssn = '$ssn'";
$result7 = mysqli_query($db_conn, $query7);
$student_info7 = mysqli_fetch_assoc($result7);

$query8 = "SELECT * FROM issue WHERE ssn = '$ssn'";
$result8 = mysqli_query($db_conn, $query8);
$student_info8 = mysqli_fetch_assoc($result8);

?>

<!DOCTYPE html>
<html>

<head>
  <title>Student Dashboard</title>
</head>

<body>
  <div class="card-body " id="form-container">
    <center>
      <h1 class="card-body bg-green ">
        WELCOME,
        <?php echo $student_info['fname'] ; ?>
        <?php echo $student_info['lname'] ; ?>

      </h1>
    </center>
    <div class="card-tools">





      <div class="card">
        <div class="card-body" id="form-container">
          <table class="table table-bordered">
            <thead>STUDENT INFORMATION
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
                <th>Mother's phone Number</th>


              </tr>
              <tr>

                <td>
                  <?php echo $student_info['ssn']; ?>
                </td>
                <td>
                  <?php echo $student_info['fname']; ?>
                </td>
                <td>
                  <?php echo $student_info['lname']; ?>
                </td>
                <td>
                  <?php echo $student_info['mentor_id']; ?>
                </td>
                <td>
                  <?php echo $student_info['dept_id']; ?>
                </td>
                <td>
                  <?php echo $student_info['email']; ?>
                </td>
                <td>
                  <?php echo $student_info['phone_number']; ?>
                </td>
                <td>
                  <?php echo $student_info['dob']; ?>
                </td>
                <td>
                  <?php echo $student_info['father_name']; ?>
                </td>
                <td>
                  <?php echo $student_info['father_num']; ?>
                </td>
                <td>
                  <?php echo $student_info['mother_name']; ?>
                </td>
                <td>
                  <?php echo $student_info['mother_num']; ?>
                </td>


              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <!-- ======================================================================================================================================== -->


      <div class="card">
        <div class="card-body" id="form-container">
          <table class="table table-bordered">
            <thead>COURSE ENROLLED
              <tr>
                <th>Enroll Id.</th>
                <th>SSN</th>
                <th>Course Id.</th>


                <th>Semester</th>



              </tr>

              <tr>
                <td>
                  <?php echo $student_info1['enroll_id']; ?>
                </td>
                <td>
                  <?php echo $student_info1['ssn']; ?>
                </td>

                <td>
                  <?php echo $student_info1['course_id']; ?>
                </td>
                <td>
                  <?php echo $student_info1['sem']; ?>
                </td>

              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>

      <!-- ========================================================================================================================== -->
      <div class="card">
        <div class="card-body" id="form-container">
          <table class="table table-bordered">
            <thead>MEETINGS

              <tr>
                <th>Meeting Id.</th>

                <th>SSN</th>
                <th>Mentor Id</th>

                <th>Semester</th>
                <th>Location</th>
                <th>Date</th>
                <th>Time</th>

              </tr>


              <tr>
                <td>
                  <?php echo $student_info2['meet_id']; ?>
                </td>
                <td>
                  <?php echo $student_info2['ssn']; ?>
                </td>

                <td>
                  <?php echo $student_info2['mentor_id']; ?>
                </td>
                <td>
                  <?php echo $student_info2['sem']; ?>
                </td>
                <td>
                  <?php echo $student_info2['loc']; ?>
                </td>
                <td>
                  <?php echo $student_info2['date_']; ?>
                </td>
                <td>
                  <?php echo $student_info2['time_']; ?>
                </td>



              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <!-- ========================================================================================================================== -->
      <div class="card">
        <div class="card-body" id="form-container">
          <table class="table table-bordered">
            <thead>ACADEMIC PROGRESS

              <tr>
                <th>Semester</th>

                <th>SSN</th>

                <th>Date</th>
                <th>GPA</th>
                <th>Credits Completed</th>

                <th>Credits Remaining</th>




              </tr>


              <tr>
                <td>
                  <?php echo $student_info3['sem']; ?>
                </td>

                <td>
                  <?php echo $student_info3['ssn']; ?>
                </td>
                <td>
                  <?php echo $student_info3['date_']; ?>
                </td>
                <td>
                  <?php echo $student_info3['gpa']; ?>
                </td>

                <td>
                  <?php echo $student_info3['credits_com']; ?>
                </td>

                <td>
                  <?php echo $student_info3['credits_rem']; ?>
                </td>



              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>

      <!-- =============================================================================================================================== -->
      <div class="card">
        <div class="card-body" id="form-container">
          <table class="table table-bordered">
            <thead>CAPSTONE PROJECT

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


              <tr>
                <td>
                  <?php echo $student_info4['sem']; ?>
                </td>

                <td>
                  <?php echo $student_info4['ssn']; ?>
                </td>
                <td>
                  <?php echo $student_info4['project_id']; ?>
                </td>
                <td>
                  <?php echo $student_info4['date_']; ?>
                </td>


                <td>
                  <?php echo $student_info4['title']; ?>
                </td>

                <td>
                  <?php echo $student_info4['group_num']; ?>
                </td>

                <td>
                  <?php echo $student_info4['status']; ?>
                </td>

                <td>
                  <?php echo $student_info4['guide']; ?>
                </td>



              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>

      <!-- ======================================================================================================== -->


      <div class="card">
        <div class="card-body" id="form-container">
          <table class="table table-bordered">
            <thead>PERSONAL DEVELOPMENT

              <tr>
                <th>Semester</th>

                <th>SSN</th>

                <th>Date</th>
                <th>Event Participated</th>
                <th>Awards and Achievements</th>

                <th>Hobbies and Interests</th>
                <th>Personal Goals</th>



              </tr>


              <tr>
                <td>
                  <?php echo $student_info5['sem']; ?>
                </td>

                <td>
                  <?php echo $student_info5['ssn']; ?>
                </td>
              
                <td>
                  <?php echo $student_info5['date_']; ?>
                </td>
                <td>
                  <?php echo $student_info5['event_part']; ?>
                </td>

                <td>
                  <?php echo $student_info5['award']; ?>
                </td>

                <td>
                  <?php echo $student_info5['hobby']; ?>
                </td>

                <td>
                  <?php echo $student_info5['goal']; ?>
                </td>

              


              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
<!-- ======================================================================================================================================== -->






<div class="card">
        <div class="card-body" id="form-container">
          <table class="table table-bordered">
            <thead>PHYSICAL HEALTH

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


              <tr>
                <td>
                  <?php echo $student_info6['sem']; ?>
                </td>

                <td>
                  <?php echo $student_info6['ssn']; ?>
                </td>
              
                <td>
                  <?php echo $student_info6['date_']; ?>
                </td>
                <td>
                  <?php echo $student_info6['issue']; ?>
                </td>

                <td>
                  <?php echo $student_info6['plan']; ?>
                </td>

                <td>
                  <?php echo $student_info6['progress']; ?>
                </td>

                <td>
                  <?php echo $student_info6['height']; ?>
                </td>
                <td>
                  <?php echo $student_info6['weight']; ?>
                </td>
              


              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <!-- ==================================================================================================================== -->



      <div class="card">
        <div class="card-body" id="form-container">
          <table class="table table-bordered">
            <thead>CAREER DEVELOPMENT

            <tr>
                  <th>Semester</th>

                  <th>SSN</th>
                  
                  <th>Date</th>
                  <th>Internships</th>
                  <th>Career Plans</th>

                  <th>Resume Link</th>
                  <th>Job Offers</th>

                  
              
                </tr>


              <tr>
                <td>
                  <?php echo $student_info7['sem']; ?>
                </td>

                <td>
                  <?php echo $student_info7['ssn']; ?>
                </td>
              
                <td>
                  <?php echo $student_info7['date_']; ?>
                </td>
                <td>
                  <?php echo $student_info7['intern']; ?>
                </td>

                <td>
                  <?php echo $student_info7['resume']; ?>
                </td>

                <td>
                  <?php echo $student_info7['job']; ?>
                </td>

              


              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <!-- ============================================================================================================================ -->

      <div class="card">
        <div class="card-body" id="form-container">
          <table class="table table-bordered">
            <thead>STUDENT ISSUES

            <tr>
                  <th>Semester</th>

                  <th>SSN</th>
                  
                  <th>Date</th>
                  <th>Time</th>
                  <th>Issues</th>

                  <th>Solution Provided</th>
                  <th>Advice Given</th>

                  
              
                </tr>

              <tr>
                <td>
                  <?php echo $student_info8['sem']; ?>
                </td>

                <td>
                  <?php echo $student_info8['ssn']; ?>
                </td>
              
                <td>
                  <?php echo $student_info8['date_']; ?>
                </td>
                <td>
                  <?php echo $student_info8['time_']; ?>
                </td>

                <td>
                  <?php echo $student_info8['issues']; ?>
                </td>

                <td>
                  <?php echo $student_info8['solution_provided']; ?>
                </td>
                <td>
                  <?php echo $student_info8['advice_given']; ?>
                </td>

              


              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <div class="card">
        <div class="card-body  bg-green" id="form-container" >


       
        <a href="../logout.php" class="nav-link" title="logout">Logout<i class="fa fa-sig-out-alt"></i></a>
      



        </div>
</div>
</div>

</body>

</html>