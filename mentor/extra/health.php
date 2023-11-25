<?php include('../includes/config.php') ?>

<?php
if (isset($_POST['submit'])) {
    $sem = $_POST['sem'];
  
  $ssn= $_POST['ssn'];
  
 
 
  $date_ = $_POST['date_'];
  $issue= $_POST['issue'];
  $plan=$_POST['plan'];
  $progress=$_POST['progress'];
  $height=$_POST['height'];
  $weight=$_POST['weight'];
  mysqli_query($db_conn, "INSERT INTO health ( `sem`, `ssn`,`date_`,`issue`,`plan`,`progress`,`height`,`weight`) VALUES ('$sem','$ssn','$date_','$issue','$plan','$progress','$height','$weight')");
  $_SESSION['success_msg'] = 'Information  has been uploaded successfuly';
  header('Location: health.php');
  exit;



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
    $retrieve_query = mysqli_query($db_conn, "SELECT * FROM health WHERE ssn = '$ssn_to_retrieve' AND sem = '$sem_to_retrieve' AND date_ = '$date_to_retrieve'");
    $course_info = mysqli_fetch_assoc($retrieve_query);
}

// Handle the form submission to update course information
if (isset($_POST['update'])) {
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

    if (mysqli_query($db_conn, $update_query)) {
        $_SESSION['success_msg'] = 'Update  has been successful';
    } else {
        $update_error = 'Failed to update. Please try again.';
    }
}
?>







<!-- ================================================================================================================================================== -->

<?php
// Delete record based on SSN, Semester, and Date
if (isset($_POST['delete'])) {
    $sem = $_POST['sem_to_delete'];
    $ssn = $_POST['ssn_to_delete'];
    $date = $_POST['date_to_delete'];

    // Check if a record with the given SSN, Semester, and Date exists
    $check_query = mysqli_query($db_conn, "SELECT * FROM health WHERE sem = '$sem' AND ssn = '$ssn' AND date_ = '$date'");

    if (mysqli_num_rows($check_query) > 0) {
        // Record with SSN, Semester, and Date exists, proceed with deletion
        mysqli_query($db_conn, "DELETE FROM health WHERE sem = '$sem' AND ssn = '$ssn' AND date_ = '$date'");
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
        <h1 class="m-0 text-dark">Manage Student Physical  Health </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active"> Student Physical  Health  </li>
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
            Add New 
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
              <label for="duration">Issue</label>
              <input type="text" name="issue" id="duration" class="form-control" placeholder="Issue"
                required>
            </div>
            <div class="form-group">
              <label for="duration">Exercise Plans</label>
              <input type="text" name="plan" id="duration" class="form-control" placeholder="Exercise Plans"
                required>
            </div>
            <div class="form-group">
              <label for="duration">Progress</label>
              <input type="text" name="progress" id="duration" class="form-control" placeholder="Progress"
                required>
            </div>
            <div class="form-group">
              <label for="duration"> Height </label>
              <input type="number" name="height" id="duration" step="0.01" min="0.00" max="200.00" class="form-control" placeholder=" Height"
                required>
            </div>
            <div class="form-group">
              <label for="duration"> Weight </label>
              <input type="number" name="weight" id="duration"  step="0.01" min="0.00" max="200.00"  class="form-control" placeholder=" Weight"
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
           Student Physical Health
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
                  <th>Issue</th>
                  <th>Exercise Plans</th>

                  <th>Progress</th>
                  <th>Height</th>
                  <th>Weight</th>
                  
              
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 1;
                $curse_query = mysqli_query($db_conn, 'SELECT * FROM health');
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
                      <?= $course->issue?>
                    </td>
                    <td>
                      <?= $course->plan ?>
                    </td>

                    
                    <td>
                  <?= $course->progress?>
                </td>
                    
                    <td>
                      <?= $course->height?>
                    </td>
                    <td>
                      <?= $course->weight?>
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
                            <label for="issue">Issue</label>
                            <input type="text" class="form-control" id="issue" name="issue" value="<?= $course_info['issue'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="plan">Exercise Plans</label>
                            <input type="text" class="form-control" id="plan" name="plan" value="<?= $course_info['plan'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="progress">Progress</label>
                            <input type="text" class="form-control" id="progress"  name="progress" value="<?= $course_info['progress'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="height">Height</label>
                            <input type="number" class="form-control" id="height" step="0.01" min="0.00" max="200.00"  name="height" value="<?= $course_info['height'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight</label>
                            <input type="number" class="form-control" id="weight" step="0.01" min="0.00" max="200.00"  name="weight" value="<?= $course_info['weight'] ?>">
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