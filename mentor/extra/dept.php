<?php include('../includes/config.php') ?>

<?php
if (isset($_POST['submit'])) {
  $dept_id= $_POST['id'];
  $dept_name= $_POST['name'];
  $head = $_POST['head'];
  mysqli_query($db_conn, "INSERT INTO dept (`dept_id`, `dept_name`, `head`) VALUES ('$dept_id', '$dept_name', '$head')");
  $_SESSION['success_msg'] = 'Dept has been uploaded successfuly';
  header('Location: dept.php');
  exit;



}

?>
<!-- ================================================================================================================================================== -->





<?php
// Include your config.php and start the session


// Initialize variables
$dept_id_to_retrieve = '';
$dept_info = [];
$update_error = '';

// Handle the form submission to retrieve department information
if (isset($_POST['retrieve'])) {
    $dept_id_to_retrieve = $_POST['dept_id_to_retrieve'];
    $retrieve_query = mysqli_query($db_conn, "SELECT * FROM dept WHERE dept_id = '$dept_id_to_retrieve'");
    $dept_info = mysqli_fetch_assoc($retrieve_query);
}

// Handle the form submission to update department information
if (isset($_POST['update'])) {
    $dept_id = $_POST['dept_id'];
    $dept_name = $_POST['dept_name'];
    $dept_id = $_POST['dept_id'];
    $head = $_POST['head'];

    $update_query = "UPDATE dept SET 
                    dept_name = '$dept_name', 
                    head = '$head'
                    WHERE dept_id = '$dept_id'";

    if (mysqli_query($db_conn, $update_query)) {
        $_SESSION['success_msg'] = 'Department information has been successfully updated.';
    } else {
        $update_error = 'Failed to update department information. Please try again.';
    }
}
?>



<!-- Include your footer or other HTML content -->

<!-- ============================================================================================================================================ -->


<?php


$error = '';

if (isset($_POST['delete'])) {
  $ssn_to_delete = $_POST['ssn_to_delete'];

  // Check if a student with this SSN exists
  $check_query = mysqli_query($db_conn, "SELECT * FROM dept WHERE dept_id = '$ssn_to_delete'");

  if (mysqli_num_rows($check_query) > 0) {
    // Student with SSN exists, proceed with deletion
    mysqli_query($db_conn, "DELETE FROM dept WHERE dept_id= '$ssn_to_delete'");

    $_SESSION['success_msg'] = "Department with Department Id  $ssn_to_delete has been successfully deleted.";
  } else {
    // Student with SSN does not exist
    $_SESSION['error_msg'] = "Department with Department Id  $ssn_to_delete does not exist.";
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
        <h1 class="m-0 text-dark">Manage Department </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Departments</li>
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
            Add New Department
          </h3>
        </div>
        <div class="card-body">

          <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-group">
              <label for="category">Department Id</label>
              <input type="text" name="id" placeholder="Department Id" required class="form-control">
            </div>


            <div class="form-group">
              <label for="name">Department Name</label>
              <input type="text" name="name" placeholder="Department Name" required class="form-control">
            </div>

            <div class="form-group">
              <label for="duration">Head</label>
              <input type="text" name="head" id="duration" class="form-control" placeholder="Head of Department"
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
            Department
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
                  <th>Department Id.</th>

                  <th>Name</th>

                  <th>Head</th>
              
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 1;
                $curse_query = mysqli_query($db_conn, 'SELECT * FROM dept');
                while ($dept = mysqli_fetch_object($curse_query)) { ?>
                  <tr>
                    <td>
                      <?= $dept->dept_id ?>
                    </td>

                    <td>
                      <?= $dept->dept_name ?>
                    </td>

                    <td>
                      <?= $dept->head ?>
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




<!-- HTML Form to Retrieve Department Information -->

<section class="content">
  <div class="card">
      <div class="card-body" id="form-container">
<form action="" method="post">
    <fieldset class="border border-secondary p-3 form-group">
        <legend class="d-inline w-auto h6">Retrieve Department Information</legend>
        <div class="row">
            <div class="col-lg-12">
                <div class form-group">
                    <label for="dept_id_to_retrieve">Enter Department ID to Retrieve:</label>
                    <input type="text" class="form-control" id="dept_id_to_retrieve" placeholder="Department ID" name="dept_id_to_retrieve">
                </div>
            </div>
        </div>
    </fieldset>
    <button name="retrieve" class="btn btn-primary">Retrieve Department Information</button>
</form>
                </div>
                </div>

<!-- Display Retrieved Department Information -->
<?php if (!empty($dept_info)) { ?>
    <div class="card">
        <div class="card-body" id="form-container">
            <form action="" method="post">
                <fieldset class="border border-secondary p-3 form-group">
                    <legend class="d-inline w-auto h6">Update Department Information</legend>
                    <input type="hidden" name="dept_id" value="<?= $dept_id_to_retrieve ?>">
                    <div class="form-group">
                        <label for="dept_name">Department Name</label>
                        <input type="text" class="form-control" id="dept_name" name="dept_name" value="<?= $dept_info['dept_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="head">Head</label>
                        <input type="text" class="form-control" id="head" name="head" value="<?= $dept_info['head'] ?>">
                    </div>
                    <button name="update" class="btn btn-primary">Update Department Information</button>
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
                    <legend class="d-inline w-auto h6">Delete Department</legend>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="ssn_to_delete">Enter Department Id to Delete:</label>
                                <input type="text" class="form-control" id="ssn_to_delete" placeholder="Department Id" name="ssn_to_delete">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <button name="delete" class="btn btn-danger">Delete Department</button>
            </form>
        </div>
    </div>
</section>












</section>
<!-- /.content -->
<?php include('footer.php') ?>