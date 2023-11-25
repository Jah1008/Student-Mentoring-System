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
// Handle the form submission to retrieve student information
if (isset($_POST['retrieve'])) {
  $ssn_to_retrieve = $_POST['ssn_to_retrieve'];
  $mentorid = $_POST['mentorid'];
  $retrieve_query = mysqli_query($db_conn, "SELECT * FROM student_details WHERE ssn = '$ssn_to_retrieve' AND mentor_id='$mentorid'");
  $student_info = mysqli_fetch_assoc($retrieve_query);
  if (empty($student_info)) {
    // No results found, so redirect to 404.php
    header('Location: ../404.php');
   
}

  $retrieve_query1 = mysqli_query($db_conn, "SELECT * FROM meeting WHERE ssn = '$ssn_to_retrieve'");
  $student_info1 = mysqli_fetch_assoc($retrieve_query1);













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

  if (mysqli_query($db_conn, $update_query)) {
    $_SESSION['success_msg'] = 'Student information has been successfully updated.';
  } else {
    $update_error = 'Failed to update student information. Please try again.';
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

  if (mysqli_query($db_conn, $update_query)) {
    $_SESSION['success_msg'] = 'Meeting information has been successfully updated.';
  } else {
    $update_error = 'Failed to update Meeting information. Please try again.';
  }
}

// Initialize variables


// Handle the form submission to update course information



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
  $check_query = mysqli_query($db_conn, "SELECT * FROM student_details WHERE ssn = '$ssn_to_delete' AND mentor_id ='$mentor_del' ");

  if (mysqli_num_rows($check_query) > 0) {
    // Student with SSN exists, proceed with deletion
    mysqli_query($db_conn, "DELETE FROM student_details WHERE ssn = '$ssn_to_delete' AND  mentor_id = '$mentor_del' ");

    $_SESSION['success_msg'] = "Student with SSN $ssn_to_delete has been successfully deleted.";
  } else {
    // Student with SSN does not exist
    $_SESSION['error_msg'] = "Student with SSN $ssn_to_delete does not exist.";
  }
}

?>
<!-- =----------------------------------------------------------------------------------------------------------------- -->




<!-- Content Wrapper. Contains page content -->


































<!-- Content Wrapper. Contains page content -->




<!-- Content Wrapper. Contains page content -->




<?php include('header.php') ?>
<?php include('sidebar.php') ?>

















<!-- Content Wrapper. Contains page content -->

<!-- /.content-header -->


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

              <input type="hidden" name="ssn" value="<?= $ssn_to_retrieve ?>">

              <input type="hidden" name="mentor_id" value="<?= $mentorid ?>">


              <fieldset class="border border-secondary p-3 form-group">
                <legend class="d-inline w-auto h6"> Student Information</legend>
                <div class="form-group">
                  <label for="fname">First Name</label>
                  <input type="text" class="form-control" id="fname" name="fname" value="<?= $student_info['fname'] ?>">
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
                  <input type="text" class="form-control" id="father_num" name"father_num"  value="<?= $student_info['father_num'] ?>">
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