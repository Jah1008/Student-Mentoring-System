<?php include('../includes/config.php') ?>

<?php
if (isset($_POST['submit'])) {
    $sem = $_POST['sem'];
  
  $ssn= $_POST['ssn'];
  
 
 
  $date_ = $_POST['date_'];
  $event_part= $_POST['event_part'];
  $award=$_POST['award'];
  $hobby=$_POST['hobby'];
  $goal=$_POST['goal'];
 

  $result1="INSERT INTO per_dev ( `sem`, `ssn`,`date_`,`event_part`,`award`,`hobby`,`goal`)
   VALUES ('$sem','$ssn','$date_','$event_part','$award','$hobby','$goal')";
  try {
    // Attempt to insert or update the data
    // Replace the following line with your actual database query
    // Example: mysqli_query($db_conn, $insert_query);
  
    $result = mysqli_query($db_conn,  $result1);
  
    if ($result1) {
        $_SESSION['success_msg'] = 'Data has been successfully inserted';
        header('location: personal_d.php');
        exit;
    
       
    } else {
      $_SESSION['success_msg'] = 'Data cannot be updated.';
      header('location: personal_d.php?action=add-new');
      exit;
     
  
    }
  } catch (Exception $e) {
    if ($e->getCode() === 1452  || $e->getCode() === 1062 ) {
        // MySQL error code 1452 corresponds to a foreign key constraint violation
        // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
        $_SESSION['success_msg'] = 'Data entered is invalid';
        header('location: personal_d.php?action=add-new');
        exit;
     
    } else {
        $errorMessage = 'An error occurred: ' . $e->getMessage();
    }
  }


}

?>
<!-- ========================================================================================== -->


<?php
// Initialize variables
$sem_to_retrieve = '';
$ssn_to_retrieve = '';
$date_to_retrieve = ''; // New variable for retrieving date
$course_info = [];
$update_error = '';

// Handle the form submission to retrieve course information
if (isset($_POST['retrieve'])) {
    $sem_to_retrieve = $_POST['sem_to_retrieve'];
    $ssn_to_retrieve = $_POST['ssn_to_retrieve'];
    $date_to_retrieve = $_POST['date_to_retrieve']; // Retrieve date
    $retrieve_query = mysqli_query($db_conn, "SELECT * FROM per_dev WHERE ssn = '$ssn_to_retrieve' AND sem = '$sem_to_retrieve' AND date_ = '$date_to_retrieve'");
    $course_info = mysqli_fetch_assoc($retrieve_query);
    if (empty( $course_info)) {
      $_SESSION['success_msg'] = "PLease check Student   '$ssn_to_retrieve'  of  sem  '$sem_to_retrieve' with date '$date_to_retrieve' is unavailable !!";
         
        
     }
  
}

// Handle the form submission to update course information
if (isset($_POST['update'])) {
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
          // Attempt to insert or update the dat
          // Replace the following line with your actual database query
          // Example: mysqli_query($db_conn, $insert_query);
          $result = mysqli_query($db_conn, $update_query);
      
          if ($result) {
              $_SESSION['success_msg'] = 'Data has been successfully inserted/updated.';
              header('location: personal_d.php');
             
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

    // if (mysqli_query($db_conn, $update_query)) {
    //     $_SESSION['success_msg'] = 'Update  has been successful';
    // } else {
    //     $update_error = 'Failed to update. Please try again.';
    // }
}
?>







<!-- ================================================================================================================================================== -->

<?php
// Delete record based on SSN, Semester, and Date
if (isset($_POST['delete'])) {
    $sem = $_POST['sem_to_delete'];
    $ssn = $_POST['ssn_to_delete'];
    $date = $_POST['date_to_delete'];


    $check_query = mysqli_query($db_conn, "SELECT * FROM per_dev WHERE sem = '$sem' AND ssn = '$ssn' AND date_ = '$date'");

    if (mysqli_num_rows($check_query) > 0) {
        // Record with SSN, Semester, and Date exists, proceed with deletion
        mysqli_query($db_conn, "DELETE FROM per_dev WHERE sem = '$sem' AND ssn = '$ssn' AND date_ = '$date'");
        $_SESSION['success_msg'] = "Record with Semester $sem, SSN $ssn, and Date $date has been successfully deleted.";
    } else {
        // Record with SSN, Semester, and Date does not exist
        $_SESSION['error_msg'] = "Record with Semester $sem, SSN $ssn, and Date $date does not exist.";
    }
}
?>



<!-- Rest of your HTML and PHP code (as provided previously) -->






<!-- HTML Form to Retrieve Course Information -->

<!-- Include your footer or other HTML content -->





<!-- ================================================================================================================================================== -->

<?php include('header.php') ?>

<?php include('sidebar.php') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Student Personal Development  </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Student Personal Development </li>
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
            Add New Issue
          </h3>
        </div>
        <div class="card-body">

        <!-- ============================================??????????????????????????????????????????????????........... -->

          <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-group">
              <label for="category">Semester</label>
              <input type="text" name="sem" placeholder="Semester" required class="form-control">
            </div>


            <div class="form-group">
              <label for="name">SSN</label>
              <input type="text" name="ssn" placeholder="SSN" required class="form-control">
            </div>
            <div class="form-group">

               
            
            <div class="form-group">
              <label for="duration">Date</label>
              <input type="date" name="date_" id="duration" class="form-control" placeholder="Date"
                required>
            </div>
            <div class="form-group">
              <label for="duration">Event Participated</label>
              <input type="text" name="event_part" id="duration" class="form-control" placeholder="Event Participated"
                required>
            </div>
            <div class="form-group">
              <label for="duration">Awards and Achievements</label>
              <input type="text" name="award" id="duration" class="form-control" placeholder="Awards and Achievements"
                required>
            </div>
            <div class="form-group">
              <label for="duration">Hobbies and Interests</label>
              <input type="text" name="hobby" id="duration" class="form-control" placeholder="Hobbies and Interests"
                required>
            </div>
            <div class="form-group">
              <label for="duration">Personal Goals</label>
              <input type="text" name="goal" id="duration" class="form-control" placeholder="Personal Goals"
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
           Student Personal Development
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
                  <th>Semester</th>

                  <th>SSN</th>
                  
                  <th>Date</th>
                  <th>Event Participated</th>
                  <th>Awards and Achievements</th>

                  <th>Hobbies and Interests</th>
                  <th>Personal Goals</th>

                  
              
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 1;
                $curse_query = mysqli_query($db_conn, 'SELECT * FROM per_dev');
                while ($course = mysqli_fetch_object($curse_query)) { ?>
                  <tr>
                  <td>
                      <?= $course->sem ?>
                    </td>
                    <td>
                      <?= $course->ssn ?>
                    </td>
                    <td>
                      <?= $course->date_?>
                    </td>
                    <td>
                      <?= $course->event_part?>
                    </td>
                    <td>
                      <?= $course->award ?>
                    </td>

                    
                    <td>
                  <?= $course->hobby?>
                </td>
                    
                    <td>
                      <?= $course->goal ?>
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
            <form action="" method="post">
                <fieldset class="border border-secondary p-3 form-group">
                    <legend class="d-inline w-auto h6">Retrieve Information</legend>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="sem_to_retrieve">Enter Semester to Retrieve:</label>
                                <input type="text" class="form-control" id="sem_to_retrieve" placeholder="Semester" name="sem_to_retrieve">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="ssn_to_retrieve">Enter SSN to Retrieve:</label>
                                <input type="text" class="form-control" id="ssn_to_retrieve" placeholder="SSN" name="ssn_to_retrieve">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="date_to_retrieve">Enter Date to Retrieve:</label>
                                <input type="date" class="form-control" id="date_to_retrieve" name="date_to_retrieve">
                            </div>
                        </div>
                    </div>
                </fieldset>
               


                <button name="retrieve" class="btn btn-primary">Retrieve Information</button>
            </form>
        </div>
    </div>

    <?php if (!empty($course_info)) { ?>
        <div class="card">
            <div class "card-body" id="form-container">
                <form action="" method="post">
                    <fieldset class="border border-secondary p-3 form-group">
                        <legend class="d-inline w-auto h6">Update Information</legend>
                        <input type="hidden" name="ssn" value="<?= $ssn_to_retrieve ?>">
                        <input type="hidden" name="sem" value="<?= $sem_to_retrieve ?>">
                        
                        <!-- Include other input fields for updating -->

                        <div class="form-group">
                            <label for="date_">Date</label>
                            <input type="date" class="form-control" id="date_" name="date_" value="<?= $course_info['date_'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="event_part">Event Participated</label>
                            <input type="text" class="form-control" id="event_part" name="event_part" step="1" value="<?= $course_info['event_part'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="award">Awards and Achievements</label>
                            <input type="text" class="form-control" id="award" name="award" value="<?= $course_info['award'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="hobby">Hobbies and Interests</label>
                            <input type="text" class="form-control" id="hobby"  name="hobby" value="<?= $course_info['hobby'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="goal">Personal Goals</label>
                            <input type="text" class="form-control" id="goal" name="goal" value="<?= $course_info['goal'] ?>">
                        </div>
                        
                        <button name="update" class="btn btn-primary">Update Information</button>
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
</section>

<!-- Include your header and other HTML content here -->


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
                    <legend class="d-inline w-auto h6">Delete  Record</legend>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="sem">Semester:</label>
                                <input type="text" class="form-control" id="sem" placeholder="Semester" name="sem_to_delete">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="ssn">SSN:</label>
                                <input type="text" class="form-control" id="ssn" placeholder="SSN" name="ssn_to_delete">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="date" class="form-control" id="date" name="date_to_delete">
                            </div>
                        </div>
                    </div>
                    <button name="delete" class="btn btn-danger">Delete Record</button>
                </fieldset>
            </form>
        </div>
    </div>
</section>

<!-- Rest of your HTML and PHP code (as provided previously) -->














</section>
<!-- /.content -->
<?php include('footer.php') ?>