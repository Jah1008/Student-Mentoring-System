<?php include('../includes/config.php') ?>



<!-- =----------------------------------------------------------------------------------------------------------------- -->



<?php


$error = '';
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
if (isset($_POST['submit'])) {




  $ssn = $_POST['ssn'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $mentor_id = $_POST['mentor_id'];
  $dept_id = $_POST['dept_id'];
  $email = $_POST['email'];
  $phone_number = $_POST['mobile'];
  $dob = $_POST['date'];
  // $gender   = $_POST['gender'];

  $father_name = $_POST['father_name'];
  $father_num = $_POST['father_num'];
  $mother_name = $_POST['mother_name'];
  $mother_num = $_POST['mother_num'];

  $check_query = mysqli_query($db_conn, "SELECT * FROM student_details WHERE email = '$email'");
  if (mysqli_num_rows($check_query) > 0) {
    $_SESSION['success_msg'] = 'Email already exists';
  } else {

    mysqli_query($db_conn, "INSERT INTO  student_details (`ssn`,`fname`,`lname`,`mentor_id`,`dept_id`,`email`,`phone_number`,`dob`,`father_name`,`father_num`,`mother_name`,`mother_num`) VALUES ('$ssn','$fname','$lname','$mentor_id','$dept_id','$email','$phone_number','$dob','$father_name','$father_num','$mother_name','$mother_num')");

    $_SESSION['success_msg'] = 'Student  has been successfully added';
    header('location: student_info.php');

    exit;

    // Handle the error, e.g., display or log it
  }

}

?>
<!-- =----------------------------------------------------------------------------------------------------------------- -->


<?php


// Initialize variables
$ssn_to_retrieve = '';
$update_error = '';
$mentorid = '';
$errorMessage = ''; 
// Handle the form submission to retrieve student information
if (isset($_POST['retrieve'])) {
  $ssn_to_retrieve = $_POST['ssn_to_retrieve'];
  $mentorid = $_POST['mentorid'];
  $retrieve_query = mysqli_query($db_conn, "SELECT * FROM student_details WHERE ssn = '$ssn_to_retrieve' AND mentor_id='$mentorid'");
  $student_info = mysqli_fetch_assoc($retrieve_query);
  if (empty($student_info)) {
 $_SESSION['success_msg'] = "  PLease check either the SSN '$ssn_to_retrieve' or Mentor Id  '$mentorid' is incorrect !!";
    
   
}

  $retrieve_query1 = mysqli_query($db_conn, "SELECT * FROM meeting WHERE ssn = '$ssn_to_retrieve'");
  $student_info1 = mysqli_fetch_assoc($retrieve_query1);



  $retrieve_query1 = mysqli_query($db_conn, "SELECT * FROM meeting WHERE ssn = '$ssn_to_retrieve'");
  $student_info1 = mysqli_fetch_assoc($retrieve_query1);

  $retrieve_query2 = mysqli_query($db_conn, "SELECT * FROM enroll_course WHERE ssn = '$ssn_to_retrieve'");
  $student_info2 = mysqli_fetch_assoc($retrieve_query2);

  $retrieve_query3 = mysqli_query($db_conn, "SELECT * FROM academic WHERE ssn = '$ssn_to_retrieve'");
  $student_info3 = mysqli_fetch_assoc($retrieve_query3);

  $retrieve_query4 = mysqli_query($db_conn, "SELECT * FROM project WHERE ssn = '$ssn_to_retrieve'");
  $student_info4 = mysqli_fetch_assoc($retrieve_query4);

  $retrieve_query5 = mysqli_query($db_conn, "SELECT * FROM per_dev WHERE ssn = '$ssn_to_retrieve'");
  $student_info5 = mysqli_fetch_assoc($retrieve_query5);



  $retrieve_query6 = mysqli_query($db_conn, "SELECT * FROM health WHERE ssn = '$ssn_to_retrieve'");
  $student_info6 = mysqli_fetch_assoc($retrieve_query6);

  $retrieve_query7 = mysqli_query($db_conn, "SELECT * FROM career WHERE ssn = '$ssn_to_retrieve'");
  $student_info7 = mysqli_fetch_assoc($retrieve_query7);


  $retrieve_query8 = mysqli_query($db_conn, "SELECT * FROM issue  WHERE ssn = '$ssn_to_retrieve'");
  $student_info8 = mysqli_fetch_assoc($retrieve_query8);











}

// Handle the form submission to update student information
if (isset($_POST['update'])) {
  $ssn = $_POST['ssn'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $mentor_id = $_POST['mentor_id'];
  $dept_id = $_POST['dept_id'];
  $email = $_POST['email'];
  $phone_number = $_POST['mobile'];
  $dob = $_POST['date'];
  $father_name = $_POST['father_name'];
  $father_num = $_POST['father_num'];
  $mother_name = $_POST['mother_name'];
  $mother_num = $_POST['mother_num'];


  $update_query = "UPDATE student_details SET 
                    fname='$fname', lname='$lname',dept_id='$dept_id',
                    email='$email', phone_number='$phone_number', dob='$dob',
                    father_name='$father_name', father_num='$father_num',
                    mother_name='$mother_name', mother_num='$mother_num'
                    WHERE ssn = '$ssn' AND mentor_id='$mentor_id'";
   try {
    // Attempt to insert or update the data
    // Replace the following line with your actual database query
    // Example: mysqli_query($db_conn, $insert_query);
    $result = mysqli_query($db_conn, $update_query);

    if ($result) {
        $_SESSION['success_msg'] = 'Data has been successfully inserted/updated.';
        header('location: student_info.php');
       
    } else {
      $_SESSION['success_msg'] = 'Data cannot be updated.';

    }
} catch (Exception $e) {
    if ($e->getCode() === 1452) {
        // MySQL error code 1452 corresponds to a foreign key constraint violation
        // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
        $_SESSION['success_msg'] = 'Data entered is invalid';
    } else {
        $errorMessage = 'An error occurred: ' . $e->getMessage();
    }
}
}




if (isset($_POST['update1'])) {
  $meet_id = $_POST['id'];
  $ssn = $_POST['ssn'];
  $mentor_id = $_POST['mid'];
  $sem = $_POST['sem'];
  $loc = $_POST['loc'];
  $date_ = $_POST['date_'];
  $time_ = $_POST['time_'];

  $update_query = "UPDATE meeting SET 
                   
                    ssn='$ssn',
                    mentor_id = '$mentor_id',
                    sem='$sem',
                    loc='$loc',
                    date_='$date_',
                    time_='$time_'
                    WHERE ssn= '$ssn'";



  try {
    // Attempt to insert or update the data
    // Replace the following line with your actual database query
    // Example: mysqli_query($db_conn, $insert_query);
    $result = mysqli_query($db_conn, $update_query);

    if ($result) {
        $_SESSION['success_msg'] = 'Data has been successfully inserted/updated.';
        header('location: student_info.php');
       
    } else {
      $_SESSION['success_msg'] = 'Data cannot be updated.';

    }
} catch (Exception $e) {
    if ($e->getCode() === 1452) {
        // MySQL error code 1452 corresponds to a foreign key constraint violation
        // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
        $_SESSION['success_msg'] = 'Data entered is invalid';
    } else {
        $errorMessage = 'An error occurred: ' . $e->getMessage();
    }
}
}

if (isset($_POST['update2'])) {
  $enroll_id = $_POST['eid'];
  $ssn = $_POST['ssn'];
  $course_id = $_POST['id'];
  $sem = $_POST['sem'];

  $update_query = "UPDATE enroll_course SET 
                 enroll_id='$enroll_id',
                  ssn='$ssn',
                  course_id = '$course_id', 
                  
                  sem='$sem'
                  WHERE enroll_id = '$enroll_id'";

try {
  // Attempt to insert or update the data
  // Replace the following line with your actual database query
  // Example: mysqli_query($db_conn, $insert_query);
  $result = mysqli_query($db_conn, $update_query);

  if ($result) {
      $_SESSION['success_msg'] = 'Data has been successfully inserted/updated.';
      header('location: student_info.php');
     
  } else {
    $_SESSION['success_msg'] = 'Data cannot be updated.';

  }
} catch (Exception $e) {
  if ($e->getCode() === 1452) {
      // MySQL error code 1452 corresponds to a foreign key constraint violation
      // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
      $_SESSION['success_msg'] = 'Data entered is invalid';
  } else {
      $errorMessage = 'An error occurred: ' . $e->getMessage();
  }
}
}
if (isset($_POST['update3'])) {
  $ssn = $_POST['ssn'];
  $sem = $_POST['sem'];
  $date_ = $_POST['date_'];
  $gpa = $_POST['gpa'];
  $credits_com = $_POST['credits_com'];
  $credits_rem = $_POST['credits_rem'];
 

  $update_query = "UPDATE academic SET 
      date_ = '$date_',
      gpa = '$gpa',
      credits_com = '$credits_com',
      credits_rem = '$credits_rem'
     
      WHERE ssn = '$ssn' AND sem = '$sem'";



try {
  // Attempt to insert or update the data
  // Replace the following line with your actual database query
  // Example: mysqli_query($db_conn, $insert_query);
  $result = mysqli_query($db_conn, $update_query);

  if ($result) {
      $_SESSION['success_msg'] = 'Data has been successfully inserted/updated.';
      header('location: student_info.php');
     
  } else {
    $_SESSION['success_msg'] = 'Data cannot be updated.';

  }
} catch (Exception $e) {
  if ($e->getCode() === 1452) {
      // MySQL error code 1452 corresponds to a foreign key constraint violation
      // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
      $_SESSION['success_msg'] = 'Data entered is invalid';
  } else {
      $errorMessage = 'An error occurred: ' . $e->getMessage();
  }
}
}
if (isset($_POST['update4'])) {
  $sem = $_POST['sem'];

  $ssn= $_POST['ssn'];
  
 $project_id= $_POST['project_id'];
 
  $date_ = $_POST['date_'];
  $title= $_POST['title'];
  $group_num=$_POST['group_num'];
  $status=$_POST['status'];
  $guide=$_POST['guide'];

  $update_query = "UPDATE project SET 
     
      date_ = '$date_',
      title = '$title',
      group_num= '$group_num',
      status = '$status',
      guide = '$guide'
    
      WHERE ssn = '$ssn' AND sem = '$sem' AND  project_id='$project_id' ";


try {
  // Attempt to insert or update the data
  // Replace the following line with your actual database query
  // Example: mysqli_query($db_conn, $insert_query);
  $result = mysqli_query($db_conn, $update_query);

  if ($result) {
      $_SESSION['success_msg'] = 'Data has been successfully inserted/updated.';
      header('location: student_info.php');
     
  } else {
    $_SESSION['success_msg'] = 'Data cannot be updated.';

  }
} catch (Exception $e) {
  if ($e->getCode() === 1452) {
      // MySQL error code 1452 corresponds to a foreign key constraint violation
      // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
      $_SESSION['success_msg'] = 'Data entered is invalid';
  } else {
      $errorMessage = 'An error occurred: ' . $e->getMessage();
  }
}
}
if (isset($_POST['update5'])) {
  $ssn = $_POST['ssn'];
  $sem = $_POST['sem'];
  $date_ = $_POST['date_'];
  $event_part = $_POST['event_part'];
  $award = $_POST['award'];
  $hobby = $_POST['hobby'];
  $goal = $_POST['goal'];

  $update_query = "UPDATE per_dev SET 
      date_ = '$date_',
      event_part = '$event_part',
      award = '$award',
      hobby = '$hobby',
      goal = '$goal'
      WHERE ssn = '$ssn' AND sem = '$sem'";
try {
  // Attempt to insert or update the data
  // Replace the following line with your actual database query
  // Example: mysqli_query($db_conn, $insert_query);
  $result = mysqli_query($db_conn, $update_query);

  if ($result) {
      $_SESSION['success_msg'] = 'Data has been successfully inserted/updated.';
      header('location: student_info.php');
     
  } else {
    $_SESSION['success_msg'] = 'Data cannot be updated.';

  }
} catch (Exception $e) {
  if ($e->getCode() === 1452) {
      // MySQL error code 1452 corresponds to a foreign key constraint violation
      // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
      $_SESSION['success_msg'] = 'Data entered is invalid';
  } else {
      $errorMessage = 'An error occurred: ' . $e->getMessage();
  }
}
}
if (isset($_POST['update6'])) {
  $sem = $_POST['sem'];

  $ssn= $_POST['ssn'];
  
 
 
  $date_ = $_POST['date_'];
  $issue= $_POST['issue'];
  $plan=$_POST['plan'];
  $progress=$_POST['progress'];
  $height=$_POST['height'];
  $weight=$_POST['weight'];

  $update_query = "UPDATE health SET 
      date_ = '$date_',
      issue = '$issue',
      plan = '$plan',
      progress = '$progress',
      height = '$height',
      weight = '$weight'
      WHERE ssn = '$ssn' AND sem = '$sem'";

try {
  // Attempt to insert or update the data
  // Replace the following line with your actual database query
  // Example: mysqli_query($db_conn, $insert_query);
  $result = mysqli_query($db_conn, $update_query);

  if ($result) {
      $_SESSION['success_msg'] = 'Data has been successfully inserted/updated.';
      header('location: student_info.php');
     
  } else {
    $_SESSION['success_msg'] = 'Data cannot be updated.';

  }
} catch (Exception $e) {
  if ($e->getCode() === 1452) {
      // MySQL error code 1452 corresponds to a foreign key constraint violation
      // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
      $_SESSION['success_msg'] = 'Data entered is invalid';
  } else {
      $errorMessage = 'An error occurred: ' . $e->getMessage();
  }
}
}
if (isset($_POST['update7'])) {
  $sem = $_POST['sem'];
  
  $ssn= $_POST['ssn'];
  
 
 
  $date_ = $_POST['date_'];
  $intern= $_POST['intern'];
  $plan=$_POST['plan'];
  $resume=$_POST['resume'];
  $job=$_POST['job'];

    $update_query = "UPDATE career SET 
        date_ = '$date_',
        intern = '$intern',
        plan = '$plan',
        resume = '$resume',
        job = '$job'
        WHERE ssn = '$ssn' AND sem = '$sem'";

try {
  // Attempt to insert or update the data
  // Replace the following line with your actual database query
  // Example: mysqli_query($db_conn, $insert_query);
  $result = mysqli_query($db_conn, $update_query);

  if ($result) {
      $_SESSION['success_msg'] = 'Data has been successfully inserted/updated.';
      header('location: student_info.php');
     
  } else {
    $_SESSION['success_msg'] = 'Data cannot be updated.';

  }
} catch (Exception $e) {
  if ($e->getCode() === 1452) {
      // MySQL error code 1452 corresponds to a foreign key constraint violation
      // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
      $_SESSION['success_msg'] = 'Data entered is invalid';
  } else {
      $errorMessage = 'An error occurred: ' . $e->getMessage();
  }
}
}

if (isset($_POST['update8'])) {
  $ssn = $_POST['ssn'];
  $sem = $_POST['sem'];
  $date_ = $_POST['date_'];
  $time_ = $_POST['time_'];
  $issues = $_POST['issue'];
  $solution_provided = $_POST['sol'];
  $advice_given = $_POST['ad'];

  $update_query = "UPDATE issue SET 
      date_ = '$date_',
      time_ = '$time_',
      issues = '$issues',
      solution_provided = '$solution_provided',
      advice_given = '$advice_given'
      WHERE ssn = '$ssn' AND sem = '$sem'";
try {
  // Attempt to insert or update the data
  // Replace the following line with your actual database query
  // Example: mysqli_query($db_conn, $insert_query);
  $result = mysqli_query($db_conn, $update_query);

  if ($result) {
      $_SESSION['success_msg'] = 'Data has been successfully inserted/updated.';
      header('location: student_info.php');
     
  } else {
    $_SESSION['success_msg'] = 'Data cannot be updated.';

  }
} catch (Exception $e) {
  if ($e->getCode() === 1452) {
      // MySQL error code 1452 corresponds to a foreign key constraint violation
      // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
      $_SESSION['success_msg'] = 'Data entered is invalid';
  } else {
      $errorMessage = 'An error occurred: ' . $e->getMessage();
  }
}
}



?>


<!-- HTML Form to Retrieve Student Information -->


<!-- =----------------------------------------------------------------------------------------------------------------- -->
<?php


$error = '';
$ssn_to_delete = '';
$mentor_del = '';
if (isset($_POST['delete'])) {
  $ssn_to_delete = $_POST['ssn_to_delete'];
  $mentor_del = $_POST['mentor_del'];

  // Check if a student with this SSN exists
  // $check_query = mysqli_query($db_conn, "SELECT * FROM student_details WHERE ssn = '$ssn_to_delete' AND mentor_id ='$mentor_del' ");

  // if (mysqli_num_rows($check_query) > 0) {
  //   // Student with SSN exists, proceed with deletion
  //   mysqli_query($db_conn, "DELETE FROM student_details WHERE ssn = '$ssn_to_delete' AND  mentor_id = '$mentor_del' ");

  //   $_SESSION['success_msg'] = "Student with SSN $ssn_to_delete has been successfully deleted.";
  // } else {
  //   // Student with SSN does not exist
  //   $_SESSION['error_msg'] = "Student with SSN $ssn_to_delete does not exist.";
  // }
  // unset(  $_SESSION['error_msg']);
  // unset(  $_SESSION['success_msg']);
 if (!empty($student_info))
 {
  mysqli_query($db_conn, "DELETE FROM student_details WHERE ssn = '$ssn_to_delete' AND  mentor_id = '$mentor_del' ");

    $_SESSION['success_msg'] = "Student with SSN $ssn_to_delete has been successfully deleted.";
 }
 else{
  $_SESSION['success_msg'] = "  PLease check either the SSN ' $ssn_to_delete' or Mentor Id  '$mentor_del' is incorrect !!";
 }
}


?>
<!-- =----------------------------------------------------------------------------------------------------------------- -->


<?php include('header.php') ?>
<?php include('sidebar.php') ?>



<!-- Main content -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <div class="d-flex">
          <h1 class="m-0 text-dark">Manage Accounts</h1>


        </div>

      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Accounts</a></li>
          <!-- <li class="breadcrumb-item active"><?php echo ucfirst($_REQUEST['user']) ?></li> -->
        </ol>
      </div><!-- /.col -->


      <?php
      // $_SESSION['success_msg'] = 'User has been succefuly registered';
      // print_r($_SESSION);
      if (isset($_SESSION['success_msg'])) { ?>
        <div class="col-12">
          <small class="text-success" style="font-size:16px">
            <?= $_SESSION['success_msg'] ?>
          </small>
        </div>
        <?php
        unset($_SESSION['success_msg']);
      }
      ?>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->



<section class="content">
  <!-- <div class="container-fluid"> -->


  <section class="content">
 
    <div class="card">
      <div class="card-body" id="form-container">
        <form action="" method="post">
          <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">Retrieve Student Information</legend>
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="mentorid">Enter Mentor Id:</label>
                  <input type="text" class="form-control" id="mentorid" placeholder="Mentor Id" name="mentorid">
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="ssn_to_retrieve">Enter SSN of the Student to Retrieve:</label>
                    <input type="text" class="form-control" id="ssn_to_retrieve" placeholder="SSN"
                      name="ssn_to_retrieve">
                  </div>
                </div>
              </div>
              <button name="retrieve" class="btn btn-primary">Retrieve Student Information</button>
          </fieldset>

        </form>
      </div>
    </div>

    <!-- Display Retrieved Student Information -->
    <?php if (isset($student_info)) { ?>
      <div class="card">
        <div class="card-body" id="form-container">
          <form action="" method="post">
            <fieldset class="border border-secondary p-3 form-group">
              <legend class="d-inline w-auto h6">Update Student Information</legend>

              <input type="hidden" name="ssn" value="<?= $ssn_to_retrieve ?>">n

              <input type="hidden" name="mentor_id" value="<?= $mentorid ?>">


              <fieldset class="border border-secondary p-3 form-group">
                <legend class="d-inline w-auto h6"> Student Information</legend>
                <div class="form-group">
                  <label for="fname">First Name</label>
                  <input type="text" class="form-control" id="fname" name="fname" value="<?php echo isset($student_info['fname']) ? $student_info['fname'] : 'No Entry'; ?>">
                </div>
                <div class="form-group">

                  <label for="lname">Last Name</label>
                  <input type="text" class="form-control" id="lname" name ="lname" value="<?= $student_info['lname'] ?>">
                </div>
                <!-- <div class="form-group">

                <label for="mentor_id">Mentor Id</label>
                <input type="text" class="form-control" id="mentor_id" placeholder="Mentor Id" name="mentor_id">
              </div> -->
                <div class="form-group">

                  <label for="dept_id">Department Id</label>
                  <input type="text" class="form-control" id="dept_id" name ="dept_id" value="<?= $student_info['dept_id'] ?>">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" required class="form-control" id="email" name ="email" value="<?= $student_info['email'] ?>">
                </div>
                <div class="form-group">
                  <label for="mobile">Mobile</label>
                  <input type="text" class="form-control" id="mobile"    name ="mobile"      value="<?= $student_info['phone_number'] ?>">
                </div>
                <div class="form-group">
                  <label for="dob">DOB</label>
                  <!-- <input type="date" required class="form-control" id="dob"  placeholder="DOB" name="dob"> -->
                  <input type="date" id="date" name="date" pattern="\d{4}-\d{2}-\d{2}"
                    value="<?= $student_info['dob'] ?>" required>
                </div>

                <div class="form-group">
                  <label for="father_name">Father's Name</label>
                  <input type="text" class="form-control" id="father_name" name="father_name" value="<?= $student_info['father_name'] ?>">

                </div>

                <div class="form-group">
                  <label for="father_num">Father's Mobile</label>
                  <input type="text" class="form-control" id="father_num" name="father_num"  value="<?= $student_info['father_num'] ?>">
                </div>


                <div class=" form-group">
                  <label for="mother_name">Mother's Name</label>
                  <input type="text" class="form-control" id="mother_name" name="mother_name" value="<?= $student_info['mother_name'] ?>">

                </div>

                <div class="form-group">
                  <label for="mother_num">Mother's Mobile</label>
                  <input type="text" class="form-control" id="mother_num" name="mother_num" value="<?= $student_info['mother_num'] ?>">
                </div>
                <button name="update" class="btn btn-primary">Update Student Information</button>

              </fieldset>




             <fieldset class="border border-secondary p-3 form-group">
                <legend class="d-inline w-auto h6"> Meeting Information</legend>
                <div class="form-group">
                  <label for="course_name">SSN</label>
                  <input type="text" class="form-control" id="ssn" name="ssn" value="<?= $student_info1['ssn'] ?>">
                </div>
                <div class="form-group">

                  <label for="mid">Mentor Id</label>
                  <input type="text" class="form-control" id="mid" placeholder="Mentor Id" name="mid"
                    value="<?= $student_info1['mentor_id'] ?>">
                </div>
                <div class="form-group">
                  <label for="no_of_credits">Semester</label>
                  <input type="text" class="form-control" id="sem" name="sem" value="<?= $student_info1['sem'] ?>">
                </div>

                <div class="form-group">
                  <label for="no_of_credits">Location</label>
                  <input type="text" class="form-control" id="loc" name="loc" value="<?= $student_info1['loc'] ?>">
                </div>
                <div class="form-group">
                  <label for="no_of_credits">Date</label>
                  <input type="date" class="form-control" id="date_" pattern="\d{4}-\d{2}-\d{2}" name="date_"
                    value="<?= $student_info1['date_'] ?>">
                </div>
                <div class="form-group">
                  <label for="no_of_credits">Timings</label>
                  <input type="time" class="form-control" id="time_" name="time_" step="1"
                    value="<?= $student_info1['time_'] ?>">
                </div>

                <button name="update1" class="btn btn-primary">Update Meeting Information</button>
              </fieldset> 

              <fieldset class="border border-secondary p-3 form-group">
                <legend class="d-inline w-auto h6"> Cousre Enrollment Information</legend>


                <div class="form-group">

                  <label for="dept_id">SSN</label>
                  <input type="text" class="form-control" id="ssn" placeholder="SSN" name="ssn"
                    value="<?= $student_info2['ssn'] ?>">
                </div>
                <div class="form-group">
                  <label for="course_name">Course Id</label>
                  <input type="text" class="form-control" id="id" name="id" value="<?= $student_info2['course_id'] ?>">
                </div>

                <div class="form-group">
                  <label for="no_of_credits">Semester</label>
                  <input type="text" class="form-control" id="sem" name="sem" value="<?= $student_info2['sem'] ?>">
                </div>
                <button name="update2" class="btn btn-primary">Update Course Information</button>

                  </fieldset> 
                  
               <fieldset class="border border-secondary p-3 form-group">
                <legend class="d-inline w-auto h6"> Academic Progress Information</legend>


                <div class="form-group">
                            <label for="date_">Date</label>
                            <input type="date" class="form-control" id="date_" name="date_" value="<?= $student_info3['date_'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="gpa">GPA</label>
                            <input type="text" class="form-control" id="gpa" name="gpa" step="1" value="<?= $student_info3['gpa'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="credits_com">Credits Completed</label>
                            <input type="text" class="form-control" id="credits_com" name="credits_com" value="<?= $student_info3['credits_com'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="credits_rem">Credits Remaining</label>
                            <input type="text" class="form-control" id="credits_rem"  name="credits_rem" value="<?= $student_info3['credits_rem'] ?>">
                        </div>

                        
                        <button name="update3" class="btn btn-primary">Update Information</button>



              </fieldset> -


              <fieldset class="border border-secondary p-3 form-group">
                        <legend class="d-inline w-auto h6">Capstone Project</legend>
                      
 
                        <!-- Include other input fields for updating -->
                      
                        <div class="form-group">
                            <label for="date_">Date</label>
                            <input type="date" class="form-control" id="date_" name="date_" value="<?= $student_info4['date_'] ?>">
                        </div>
                       
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?=$student_info4['title'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="group_num">Number of Members</label>
                            <input type="number" class="form-control" id="group_num"  min="3" max="4"  name="group_num" value="<?= $student_info4['group_num'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="status">Statust</label>
                            <input type="text" class="form-control" id="status"  name="status" value="<?=$student_info4['status'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="guide">Guide</label>
                            <input type="text" class="form-control" id="guide" name="guide" value="<?= $student_info4['guide'] ?>">
                        </div>
                        
                        
                        <button name="update4" class="btn btn-primary">Update Information</button>
                    </fieldset>

                    <fieldset class="border border-secondary p-3 form-group">
                        <legend class="d-inline w-auto h6">Personal Development</legend>
                       
                        
                        <!-- Include other input fields for updating -->

                        <div class="form-group">
                            <label for="date_">Date</label>
                            <input type="date" class="form-control" id="date_" name="date_" value="<?= $student_info5['date_'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="event_part">Event Participated</label>
                            <input type="text" class="form-control" id="event_part" name="event_part" step="1" value="<?= $student_info5['event_part'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="award">Awards and Achievements</label>
                            <input type="text" class="form-control" id="award" name="award" value="<?=$student_info5['award'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="hobby">Hobbies and Interests</label>
                            <input type="text" class="form-control" id="hobby"  name="hobby" value="<?= $student_info5['hobby'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="goal">Personal Goals</label>
                            <input type="text" class="form-control" id="goal" name="goal" value="<?= $student_info5['goal'] ?>">
                        </div>
                        
                        <button name="update5" class="btn btn-primary">Update Information</button>
                    </fieldset>

                    <fieldset class="border border-secondary p-3 form-group">
                        <legend class="d-inline w-auto h6">Physical Health</legend>
                       
                        
                        <!-- Include other input fields for updating -->

                        <div class="form-group">
                            <label for="date_">Date</label>
                            <input type="date" class="form-control" id="date_" name="date_" value="<?= $student_info6['date_'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="issue">Issue</label>
                            <input type="text" class="form-control" id="issue" name="issue" value="<?= $student_info6['issue'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="plan">Exercise Plans</label>
                            <input type="text" class="form-control" id="plan" name="plan" value="<?= $student_info6['plan'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="progress">Progress</label>
                            <input type="text" class="form-control" id="progress"  name="progress" value="<?=$student_info6['progress'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="height">Height</label>
                            <input type="number" class="form-control" id="height" step="0.01" min="0.00" max="200.00"  name="height" value="<?= $student_info6['height'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight</label>
                            <input type="number" class="form-control" id="weight" step="0.01" min="0.00" max="200.00"  name="weight" value="<?= $student_info6['weight'] ?>">
                        </div>
                        
                        
                        <button name="update6" class="btn btn-primary">Update Information</button>
                    </fieldset>

                    <fieldset class="border border-secondary p-3 form-group">
                        <legend class="d-inline w-auto h6">Career Development</legend>
                      
                        
                        <!-- Include other input fields for updating -->

                        <div class="form-group">
                            <label for="date_">Date</label>
                            <input type="date" class="form-control" id="date_" name="date_" value="<?= $student_info7['date_'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="intern">Internships</label>
                            <input type="text" class="form-control" id="intern" name="intern" step="1" value="<?= $student_info7['intern'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="plan">Career Plans</label>
                            <input type="text" class="form-control" id="plan" name="plan" value="<?= $student_info7['plan'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="resume">Resume Link</label>
                            <input type="text" class="form-control" id="resume"  name="resume" value="<?= $student_info7['resume'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="goal">Job Offers</label>
                            <input type="text" class="form-control" id="job" name="job" value="<?= $student_info7['job'] ?>">
                        </div>
                        
                        <button name="update7" class="btn btn-primary">Update Information</button>
                    </fieldset>

                    <fieldset class="border border-secondary p-3 form-group">
                        <legend class="d-inline w-auto h6">Student Issues</legend>
                       
                        
                        <!-- Include other input fields for updating -->

                        <div class="form-group">
                            <label for="date_">Date</label>
                            <input type="date" class="form-control" id="date_" name="date_" value="<?= $student_info8['date_'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="time_">Timings</label>
                            <input type="time" class="form-control" id="time_" name="time_" step="1" value="<?= $student_info8['time_'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="issue">Issues</label>
                            <input type="text" class="form-control" id="issue" name="issue" value="<?= $student_info8['issues'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="sol">Solution Provided</label>
                            <input type="text" class="form-control" id="sol" placeholder="Solution provided" name="sol" value="<?= $student_info8['solution_provided'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="ad">Advice Given</label>
                            <input type="text" class="form-control" id="ad" name="ad" value="<?= $student_info8['advice_given'] ?>">
                        </div>
                        
                        <button name="update8" class="btn btn-primary">Update Information</button>
                    </fieldset>





             
                  
             


             
















            <!-- </fieldset> -->

          </form>

        </div>
      </div>
    <?php } ?>

    <!-- Display Update Error Messages -->
    <?php if ($update_error) { ?>
      <div class="alert alert-danger">
        <?= $update_error ?>
      </div>
    <?php } ?>

    <!-- Display Success Message -->
    <?php if (isset($_SESSION['success_msg'])) { ?>
      <div class="alert alert-success">
        <?= $_SESSION['success_msg'] ?>
      </div>
    <?php } ?>

    <!-- Include your footer or other HTML content -->
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body" id="form-container">
        <?php if (isset($_SESSION['error_msg'])) { ?>
          <div class="col-12">
            <small class="text-danger" style="font-size:16px">
              <?= $_SESSION['error_msg'] ?>
            </small>
          </div>
          <?php unset($_SESSION['error_msg']);
        } ?>
        <?php if (isset($_SESSION['success_msg'])) { ?>
          <div class="col-12">
            <small class="text-success" style="font-size:16px">
              <?= $_SESSION['success_msg'] ?>
            </small>
          </div>
          <?php unset($_SESSION['success_msg']);
        } ?>

        <form action="" method="post">
          <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">Delete Student</legend>
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="mentor_del">Enter your Mentor Id:</label>
                  <input type="text" class="form-control" id="mentor_del" placeholder="Mentor Id" name="mentor_del">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="ssn_to_delete">Enter SSN of the Student to Delete:</label>
                  <input type="text" class="form-control" id="ssn_to_delete" placeholder="SSN" name="ssn_to_delete">
                </div>
              </div>
            </div>
          </fieldset>
          <button name="delete" class="btn btn-danger">Delete Student</button>
        </form>
      </div>
    </div>
  </section>

</section>

<?php include('footer.php') ?>



<!-- ================================================================================================================ -->
<fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">Edit Student Information</legend>

            <div class="col-lg-4">
                            <div class="form-group">
                                <label for="sem">Enter Semester to Retrieve:</label>
                                <input type="text" class="form-control" id="sem" placeholder="Semester" name="sem_to_retrieve">
                            </div>
            </div>
            <div class="col-lg-4">
                            <div class="form-group">
                                <label for="date_">Enter Date to Retrieve:</label>
                                <input type="date" class="form-control" id="date_" name="date_to_sem_to_retrieve">
                            </div>
                        </div>


                        <div class="card">
      <div class="card-body  bg-blue" id="form-container">
<?php



echo"<a href='edit_academic.php?ssn=" .   $studentInfo['ssn'] . "'>Edit</a>";

?>
</div>
                        </div>

    </fieldset>
<!-- ========================================================================================================== -->