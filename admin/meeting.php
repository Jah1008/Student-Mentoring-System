<?php include('../includes/config.php') ?>

<?php
if (isset($_POST['submit'])) {

  $meet_id = $_POST['id'];
  $ssn= $_POST['ssn'];
  $mentor_id = $_POST['mid'];
  $sem = $_POST['sem'];
  $loc = $_POST['loc'];
  $date_ = $_POST['date_'];
  $time_= $_POST['time_'];
 

  $result1= "INSERT INTO meeting (`meet_id`, `ssn`,`mentor_id`, `sem`,`loc`,`date_`,`time_`)
   VALUES ('$meet_id','$ssn','$mentor_id','$sem','$loc','$date_','$time_')";
  try {
    // Attempt to insert or update the data
    // Replace the following line with your actual database query
    // Example: mysqli_query($db_conn, $insert_query);
  
    $result = mysqli_query($db_conn,  $result1);
 

  
    if ($result1) {
        $_SESSION['success_msg'] = 'Data has been successfully inserted';
        header('location: meeting.php');
        exit;
    
       
    } else {
      $_SESSION['success_msg'] = 'Data cannot be updated.';
      header('location: meeting.php?action=add-new');
      exit;
     
  
    }
  } catch (Exception $e) {
    if ($e->getCode() === 1452  || $e->getCode() === 1062 ) {
        // MySQL error code 1452 corresponds to a foreign key constraint violation
        // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
        $_SESSION['success_msg'] = 'Data entered is invalid';
        header('location: meeting.php?action=add-new');
        exit;
     
    } else {
      $_SESSION['success_msg'] = " There are  already 5  meetings scheduled for Mentor :'$mentor_id' today ";
        // $errorMessage = 'An error occurred: ' . $e->getMessage();
    }
  }


}

?>
<!-- ================================================================================================================================================== -->





<?php


// Initialize variables
$course_id_to_retrieve = '';
$course_info = [];
$update_error = '';

// Handle the form submission to retrieve course information
if (isset($_POST['retrieve'])) {
    $course_id_to_retrieve = $_POST['course_id_to_retrieve'];
    $retrieve_query = mysqli_query($db_conn, "SELECT * FROM meeting WHERE meet_id = '$course_id_to_retrieve'");
    $course_info = mysqli_fetch_assoc($retrieve_query);
    if (empty( $course_info)) {
      $_SESSION['success_msg'] = "PLease check meeting id '$course_id_to_retrieve'  is invalid !!";
         
        
     }
}

// Handle the form submission to update course information
if (isset($_POST['update'])) {
    $meet_id = $_POST['id'];
  $ssn= $_POST['ssn'];
  $mentor_id = $_POST['mid'];
  $sem = $_POST['sem'];
  $loc = $_POST['loc'];
  $date_ = $_POST['date_'];
  $time_= $_POST['time_'];

    $update_query = "UPDATE meeting SET 
                   
                    ssn='$ssn',
                    mentor_id = '$mentor_id',
                    sem='$sem',
                    loc='$loc',
                    date_='$date_',
                    time_='$time_'
                    WHERE meet_id = '$meet_id'";

try {
  // Attempt to insert or update the data
  // Replace the following line with your actual database query
  // Example: mysqli_query($db_conn, $insert_query);
  $result = mysqli_query($db_conn, $update_query);

  if ($result) {
      $_SESSION['success_msg'] = 'Data has been successfully inserted/updated.';
      header('location: meeting.php');
     
  } else {
    $_SESSION['success_msg'] = 'Data cannot be updated.';

  }
} catch (Exception $e) {
  if ($e->getCode() === 1452) {
      // MySQL error code 1452 corresponds to a foreign key constraint violation
      // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
      $_SESSION['success_msg'] = 'Data entered is invalid';
  } else {
      // $errorMessage = 'An error occurred: ' . $e->getMessage();
      $_SESSION['success_msg'] = " There are already 5  meetings scheduled for Mentor :' '$mentor_id' today ";
  }
}

    // if (mysqli_query($db_conn, $update_query)) {
    //     $_SESSION['success_msg'] = 'Meeting information has been successfully updated.';
    // } else {
    //     $update_error = 'Failed to update Meeting information. Please try again.';
    // }
}
?>

<!-- HTML Form to Retrieve Course Information -->

<!-- Include your footer or other HTML content -->
<!-- ============================================================================================================================================ -->

<?php


$error = '';

if (isset($_POST['delete'])) {
  $ssn_to_delete = $_POST['ssn_to_delete'];

  $check_query = mysqli_query($db_conn, "SELECT * FROM meeting WHERE meet_id = '$ssn_to_delete'");

  if (mysqli_num_rows($check_query) > 0) {
    // Student with SSN exists, proceed with deletion
    
    mysqli_query($db_conn, "DELETE FROM meeting WHERE meet_id= '$ssn_to_delete'");

    $_SESSION['success_msg'] = "Meeting with Meet Id  $ssn_to_delete has been successfully deleted.";
  } else {
    // Student with SSN does not exist
    $_SESSION['error_msg'] = "Meeting with Meet Id   $ssn_to_delete does not exist.";
  }
}

?>




<!-- ================================================================================================================================================== -->

<?php include('header.php') ?>

<?php include('sidebar.php') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Meeting  </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Meeting </li>
        </ol>
      </div><!-- /.col -->
      <?php

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
  <div class="container-fluid">
    <?php
    if (isset($_REQUEST['action'])) { ?>
      <!-- Info boxes -->
      <div class="card">
        <div class="card-header py-2">
          <h3 class="card-title">
            Add New Meeting
          </h3>
        </div>
        <div class="card-body">

          <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-group">
              <label for="category">Meeting  Id</label>
              <input type="text" name="id" placeholder="Meeting Id" required class="form-control">
            </div>


            <div class="form-group">
              <label for="name">SSN</label>
              <input type="text" name="ssn" placeholder="SSN" required class="form-control">
            </div>
            <div class="form-group">

                <label for="dept_id">Mentor Id</label>
                <input type="text" class="form-control" id="mid" placeholder="Mentor Id" name="mid">
              </div>

            <div class="form-group">
              <label for="duration">Semester</label>
              <input type="text" name="sem" id="duration" class="form-control" placeholder="Semester"
                required>
            </div>
            <div class="form-group">
              <label for="duration">Location</label>
              <input type="text" name="loc" id="duration" class="form-control" placeholder="Location"
                required>
            </div>
            <div class="form-group">
              <label for="duration">Date</label>
              <input type="date" name="date_" id="duration" class="form-control" placeholder="Date"
                required>
            </div>
            <div class="form-group">
              <label for="duration">Timings</label>
              <input type="time" name="time_" id="duration" class="form-control" placeholder="Timings"
                required>
            </div>

            <button name="submit" class="btn btn-success">
              Submit
            </button>
          </form>
        </div>
      </div>
      <!-- /.row -->
    <?php } else { ?>
      <!-- Info boxes -->
      <div class="card">
        <div class="card-header py-2">
          <h3 class="card-title">
            Meetings
          </h3>
          <div class="card-tools">
            <a href="?action=add-new" class="btn btn-success btn-xs"><i class="fa fa-plus mr-2"></i>Add New</a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive bg-brown">
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
              </thead>
              <tbody>
                <?php
                $count = 1;
                $curse_query = mysqli_query($db_conn, 'SELECT * FROM meeting');
                while ($course = mysqli_fetch_object($curse_query)) { ?>
                  <tr>
                    <td>
                      <?= $course->meet_id ?>
                    </td>

                    <td>
                      <?= $course->ssn ?>
                    </td>
                    <td>
                  <?= $course->mentor_id?>
                </td>
                    <td>
                      <?= $course->sem ?>
                    </td>
                    <td>
                      <?= $course->loc ?>
                    </td>
                    <td>
                      <?= $course->date_?>
                    </td>
                    <td>
                      <?= $course->time_ ?>
                    </td>
                  </tr>

                <?php } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.row -->
    <?php } ?>
  </div><!--/. container-fluid -->

  
<!-- /.content-header -->

<!-- Main content -->



<section class="content">
  <div class="card">
      <div class="card-body" id="form-container">
<!-- HTML Form to Retrieve Course Information -->
<form action="" method="post">
    <fieldset class="border border-secondary p-3 form-group">
        <legend class="d-inline w-auto h6">Retrieve Meeting Information</legend>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="course_id_to_retrieve">Enter Meeting ID to Retrieve:</label>
                    <input type="text" class="form-control" id="course_id_to_retrieve" placeholder="Meeting  ID" name="course_id_to_retrieve">
                </div>
            </div>
        </div>
        <button name="retrieve" class="btn btn-primary">Retrieve Meeting Information</button>
    </fieldset>
  
</form>
                </div>
                </div>

<!-- Display Retrieved Course Information -->
<?php if (!empty($course_info)) { ?>
    <div class="card">
        <div class="card-body" id="form-container">
            <form action="" method="post">
                <fieldset class="border border-secondary p-3 form-group">
                    <legend class="d-inline w-auto h6">Update Meeting Information</legend>
                    <input type="hidden" name="id" value="<?= $course_id_to_retrieve ?>">

                    <div class="form-group">
                        <label for="course_name">SSN</label>
                        <input type="text" class="form-control" id="ssn" name="ssn" value="<?= $course_info['ssn'] ?>">
                    </div>
                    <div class="form-group">

                <label for="mid">Mentor Id</label>
                <input type="text" class="form-control" id="mid" placeholder="Mentor Id" name="mid"  value="<?= $course_info['mentor_id'] ?>">
              </div>
                    <div class="form-group">
                        <label for="no_of_credits">Semester</label>
                        <input type="text" class="form-control" id="sem" name="sem" value="<?= $course_info['sem'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="no_of_credits">Location</label>
                        <input type="text" class="form-control" id="loc" name="loc" value="<?= $course_info['loc'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="no_of_credits">Date</label>
                        <input type="date" class="form-control" id="date_"  pattern="\d{4}-\d{2}-\d{2}" name="date_" value="<?= $course_info['date_'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="no_of_credits">Timings</label>
                        <input type="time" class="form-control" id="time_" name="time_" step="1" value="<?= $course_info['time_'] ?>">
                    </div>











                    <button name="update" class="btn btn-primary">Update Meeting Information</button>
                </fieldset>
            </form>
        </div>
    </div>
<?php } ?>

<!-- Display Update Error Messages -->
<?php if ($update_error) { ?>
    <div class="alert alert-danger"><?= $update_error ?></div>
<?php } ?>

<!-- Display Success Message -->
<?php if (isset($_SESSION['success_msg'])) { ?>
    <div class="alert alert-success"><?= $_SESSION['success_msg'] ?></div>
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
                    <legend class="d-inline w-auto h6">Delete Meeting</legend>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="ssn_to_delete">Enter Meeting Id to Delete:</label>
                                <input type="text" class="form-control" id="ssn_to_delete" placeholder="Meeting Id" name="ssn_to_delete">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <button name="delete" class="btn btn-danger">Delete Meeting </button>
            </form>
        </div>
    </div>
</section>
















</section>
<!-- /.content -->
<?php include('footer.php') ?>