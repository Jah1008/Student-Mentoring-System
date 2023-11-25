<?php include('../includes/config.php') ?>

<?php
if (isset($_POST['submit'])) {
  $enroll_id = $_POST['eid'];
  $ssn= $_POST['ssn'];
  $course_id = $_POST['id'];
  $sem= $_POST['sem'];
  
 

  
  $result1=  "INSERT INTO enroll_course (`enroll_id`,`ssn`,`course_id`,`sem`) VALUES ('$enroll_id','$ssn','$course_id','$sem')";

  try {
    // Attempt to insert or update the data
    // Replace the following line with your actual database query
    // Example: mysqli_query($db_conn, $insert_query);
  
    $result = mysqli_query($db_conn,  $result1);
  
    if ($result1) {
        $_SESSION['success_msg'] = 'Data has been successfully inserted';
        header('location:  course_enrollment.php');
        exit;
    
       
    } else {
      $_SESSION['success_msg'] = 'Data cannot be updated.';
      header('location:  course_enrollment.php?action=add-new');
      exit;
     
  
    }
  } catch (Exception $e) {
    if ($e->getCode() === 1452  || $e->getCode() === 1062 ) {
        // MySQL error code 1452 corresponds to a foreign key constraint violation
        // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
        $_SESSION['success_msg'] = 'Data entered is invalid';
        header('location:  course_enrollment.php?action=add-new');
        exit;
     
    } else {
        $errorMessage = 'An error occurred: ' . $e->getMessage();
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
    $retrieve_query = mysqli_query($db_conn, "SELECT * FROM enroll_course WHERE enroll_id = '$course_id_to_retrieve'");
    $course_info = mysqli_fetch_assoc($retrieve_query);
    if (empty( $course_info)) {
      $_SESSION['success_msg'] = "PLease check enroll id  '$course_id_to_retrieve' is invalid !!";
         }
    
}

// Handle the form submission to update course information
if (isset($_POST['update'])) {
    $enroll_id = $_POST['eid'];
    $ssn= $_POST['ssn'];
    $course_id = $_POST['id'];
    $sem= $_POST['sem'];

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
      header('location: course_enrollment.php');
     
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
    //     $_SESSION['success_msg'] = 'Course information has been successfully updated.';
    // } else {
    //     $update_error = 'Failed to update course information. Please try again.';
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


  $check_query = mysqli_query($db_conn, "SELECT * FROM enroll_course WHERE enroll_id = '$ssn_to_delete'");

  if (mysqli_num_rows($check_query) > 0) {
    // Student with SSN exists, proceed with deletion
    mysqli_query($db_conn, "DELETE FROM enroll_course WHERE enroll_id= '$ssn_to_delete'");

    $_SESSION['success_msg'] = "Course with Enroll Id  $ssn_to_delete has been successfully deleted.";
  } else {
    // Student with SSN does not exist
    $_SESSION['error_msg'] = "Course with Enroll Id  $ssn_to_delete does not exist.";
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
        <h1 class="m-0 text-dark">Manage Student's Enrollment</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Courses</li>
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
            Add New Course
          </h3>
        </div>
        <div class="card-body">

          <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
              <label for="category">Enroll Id</label>
              <input type="text" name="eid" placeholder="Enroll Id" required class="form-control">
            </div>
            <div class="form-group">
              <label for="category">SSN</label>
              <input type="text" name="ssn" placeholder="SSN" required class="form-control">
            </div>

            <div class="form-group">
              <label for="category">Course Id</label>
              <input type="text" name="id" placeholder="Course Id" required class="form-control">
            </div>


            <div class="form-group">
              <label for="category">Semester</label>
              <input type="text" name="sem" placeholder="Semester" required class="form-control">
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
            Courses
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
                <th>Enroll Id.</th> 
                <th>SSN</th>
                  <th>Course Id.</th>

                 
                  <th>Semester</th>

                 
              
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 1;
                $curse_query = mysqli_query($db_conn, 'SELECT * FROM enroll_course');
                while ($course = mysqli_fetch_object($curse_query)) { ?>
                  <tr>


                  <td>
                      <?= $course->enroll_id ?>
                    </td>
                    <td>
                      <?= $course->ssn ?>
                    </td>
                    <td>
                      <?= $course->course_id ?>
                    </td>
                    <td>
                      <?= $course->sem ?>
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
        <legend class="d-inline w-auto h6">Retrieve Course Information</legend>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="course_id_to_retrieve">Enter Course ID to Retrieve:</label>
                    <input type="text" class="form-control" id="course_id_to_retrieve" placeholder="Enroll  ID" name="course_id_to_retrieve">
                </div>
            </div>
        </div>
        <button name="retrieve" class="btn btn-primary">Retrieve Course Information</button>
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
                    <legend class="d-inline w-auto h6">Update Enrollment Information</legend>
                    <input type="hidden" name="eid" value="<?= $course_id_to_retrieve ?>">


                    <div class="form-group">

                <label for="dept_id">SSN</label>
                <input type="text" class="form-control" id="ssn" placeholder="SSN" name="ssn" value="<?= $course_info['ssn'] ?>">
              </div>
                    <div class="form-group">
                        <label for="course_name">Course Id</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $course_info['course_id'] ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="no_of_credits">Semester</label>
                        <input type="text" class="form-control" id="sem" name="sem" value="<?= $course_info['sem'] ?>">
                    </div>
                    <button name="update" class="btn btn-primary">Update Course Information</button>
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
                    <legend class="d-inline w-auto h6">Delete Enrollment</legend>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="ssn_to_delete">Enter Enroll Id to Delete:</label>
                                <input type="text" class="form-control" id="ssn_to_delete" placeholder="Enrollment Id" name="ssn_to_delete">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <button name="delete" class="btn btn-danger">Delete Enrollment</button>
            </form>
        </div>
    </div>
</section>
















</section>
<!-- /.content -->
<?php include('footer.php') ?>