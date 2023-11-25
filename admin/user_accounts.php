<?php include('../includes/config.php') ?>


<!-- ---------------------------------------------------------------------------------------------------------------------------------------------- -->
<?php
$error = '';
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
if (isset($_POST['submit'])) {
    $mentor_id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dept_id = $_POST['dept_id'];
    $email = $_POST['email'];
    $phone_number = $_POST['mobile'];
    $pass=$_POST['pass'];

   

    $result1= "INSERT INTO accounts (`mentor_id`, `fname`, `lname`, `dept_id`, `email`, `phone_number`,`pass`)
     VALUES ('$mentor_id', '$fname', '$lname', '$dept_id', '$email', '$phone_number','$pass')";
    try {
      // Attempt to insert or update the data
      // Replace the following line with your actual database query
      // Example: mysqli_query($db_conn, $insert_query);
    
      $result = mysqli_query($db_conn,  $result1);
    
      if ($result1) {
          $_SESSION['success_msg'] = 'Data has been successfully inserted';
          header('location: user_accounts.php');
          exit;
      
         
      } else {
        $_SESSION['success_msg'] = 'Data cannot be updated.';
        header('location: user_accounts.php?action=add-new');
        exit;
       
    
      }
    } catch (Exception $e) {
      if ($e->getCode() === 1452  || $e->getCode() === 1062 ) {
          // MySQL error code 1452 corresponds to a foreign key constraint violation
          // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
          $_SESSION['success_msg'] = 'Data entered is invalid';
          header('location: user_accounts.php?action=add-new');
          exit;
       
      } else {
        $_SESSION['success_msg'] = 'Data entered is invalid';
      }
    }

   

    // Handle any other errors if necessary
}
?>

<?php


// Initialize variables
$mentor_id_to_retrieve = '';
$update_error = '';

// Handle the form submission to retrieve mentor information
if (isset($_POST['retrieve'])) {
  $mentor_id_to_retrieve = $_POST['mentor_id_to_retrieve'];

  $retrieve_query = mysqli_query($db_conn, "SELECT * FROM accounts WHERE mentor_id = '$mentor_id_to_retrieve'");

  
  $mentor_info = mysqli_fetch_assoc($retrieve_query);

  if (empty($mentor_info)) {
    $_SESSION['success_msg'] = "PLease check mentor   '$mentor_id_to_retrieve' doesn't exist !!";
       
      
   }

}

// Handle the form submission to update mentor information
if (isset($_POST['update'])) {
  $mentor_id = $_POST['mentor_id'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $dept_id = $_POST['dept_id'];
  $email = $_POST['email'];
  $phone_number = $_POST['mobile'];
  $pass=$_POST['pass'];

  $update_query = "UPDATE accounts SET 
                    fname='$fname', lname='$lname', dept_id='$dept_id',email='$email',
                    phone_number='$phone_number',pass='$pass'
                    WHERE mentor_id = '$mentor_id'";

try {
  // Attempt to insert or update the data
  // Replace the following line with your actual database query
  // Example: mysqli_query($db_conn, $insert_query);
  $result = mysqli_query($db_conn, $update_query);

  if ($result) {
      $_SESSION['success_msg'] = 'Data has been successfully updated.';
      header('location: user_accounts.php');
    
      
     
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
  //   $_SESSION['success_msg'] = 'Mentor information has been successfully updated.';
  // } else {
  //   $update_error = 'Failed to update mentor information. Please try again.';
  // }
}


?>

<!-- HTML Form to Retrieve Mentor Information -->


<!-- Include your footer or other HTML content -->

<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
<?php


$error = '';

if (isset($_POST['delete'])) {
  $ssn_to_delete = $_POST['ssn_to_delete'];


  $check_query = mysqli_query($db_conn, "SELECT * FROM accounts WHERE mentor_id = '$ssn_to_delete'");

  if (mysqli_num_rows($check_query) > 0) {
    // Student with SSN exists, proceed with deletion

    
    mysqli_query($db_conn, "DELETE FROM accounts WHERE mentor_id = '$ssn_to_delete'");

    $_SESSION['success_msg'] = "Mentor with  $ssn_to_delete has been successfully deleted.";
  } else {
    // Student with SSN does not exist
    $_SESSION['error_msg'] = "Mentor with id $ssn_to_delete does not exist.";
  }
}

?>


<!-- Content Wrapper. Contains page content -->

<!-- /.content-header -->
<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<!-- Main content -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <div class="d-flex">
          <h1 class="m-0 text-dark">Manage Accounts</h1>
          <!-- <a href="user-account.php?user=<?php echo $_REQUEST['user'] ?>&action=add-new" class="btn btn-primary btn-sm">Add New</a> -->
        </div>


        <!-- <a href="user_accounts.php?user=mentor&action-add-new" class="btn btn-primary btn-sm">Add New </a> -->
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Accounts</a></li>
          <li class="breadcrumb-item active">

          </li>
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

  <div class="card">
    <div class="card-body" id="form-container">

      <?php if (isset($_GET['action']) && $_GET['action']) { ?>
        <!-- <div class="card">
              <div class="card-body" id="form-container"> -->

        <form action="" method="post" enctype="multipart/form-data">
          <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">Mentor Information</legend>
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">

                  <label for="id">Mentor Id</label>
                  <input type="text" class="form-control" id="id" placeholder="Mentor Id" name="id">
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">

                  <label for="fname">First Name</label>
                  <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">

                  <label for="lname">Last Name</label>
                  <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname">
                </div>
              </div>
              <div class="col-lg-12">
              <div class="form-group">

                <label for="dept_id">Department Id</label>
                <input type="text" class="form-control" id="dept_id" placeholder="Department Id" name="dept_id">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" required class="form-control" id="email" placeholder="Email Address" name="email">
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" class="form-control" id="mobile" placeholder="Mobile" name="mobile"  pattern="[1-9]{1}[0-9]{9}">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" id="pass" placeholder="Password" name="pass" minlength="8" required>

              </div>
            </div>


            <!-- Address Fields -->
            <!-- <div class="col-lg-12">
                    <div class="form-group">
                      <label for="">Address</label>
                      <input type="text" class="form-control" placeholder="Address" name="address">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">Country</label>
                      <input type="text" class="form-control" placeholder="Country" name="country">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">State</label>
                      <input type="text" class="form-control" placeholder="State" name="state">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">Pin/Zip Code</label>
                      <input type="text" class="form-control" placeholder="Pin/Zip Code" name="zip">
                    </div>
                  </div> -->
      </div>
      </fieldset>





      <button name="submit" class="btn btn-primary">Submit</button>
      </form>



    <?php } else { ?>
      <!-- <a href="user_accounts.php?user=mentor&action-add-new" class="btn btn-success btn-xs"><i class="fa fa-plus mr-2"></i>Add New</a> -->
      <div class="card-header py-2">
        <h3 class="card-title">
          Mentor
        </h3>
        <div class="card-tools">
          <a href="user_accounts.php?action=add-new" class="btn btn-success btn-xs"><i class="fa fa-plus mr-2"></i>Add
            New</a>
        </div>
      </div>
      <div class="table-responsive bg-brown">

        <table class="table table-bordered ">
          <thead>
            <tr>
              <th>Mentor Id.</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Department Id</th>
              <th>Email</th>
              <th>Phone Number</th>
              <!-- <th>Password</th> -->

            </tr>
          </thead>
          <tbody>
            <?php


            // $user_query='Select * from accounts where type= " '.$_REQUEST['user'].' "';
            $user_query = 'SELECT * FROM accounts';
            // $user_query='Select * from accounts';
            $user_result = mysqli_query($db_conn, $user_query);

            $count = 1;
            while ($users = mysqli_fetch_object($user_result)) {
              // echo $users->email;
              ?>



              <tr>
                <td>
                  <?= $users->mentor_id ?>
                </td>
                <td>
                  <?= $users->fname ?>
                </td>
                <td>
                  <?= $users->lname ?>
                </td>
                <td>
                  <?= $users->dept_id ?>
                </td>
                <td>
                  <?= $users->email ?>
                </td>
                <td>
                  <?= $users->phone_number ?>
                </td>
                

              </tr>
            <?php } ?>
          </tbody>

        </table>

      </div>
    <?php } ?>
  </div>
  </div>


  <section class="content">

    <form action="" method="post">
      <div class="card">
        <div class="card-body" id="form-container">
          <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">Retrieve Mentor Information</legend>
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="mentor_id_to_retrieve">Enter Mentor ID of the Mentor to Retrieve:</label>
                  <input type="text" class="form-control" id="mentor_id_to_retrieve" placeholder="Mentor ID"
                    name="mentor_id_to_retrieve">
                </div>
              </div>
            </div>
            <button name="retrieve" class="btn btn-primary">Retrieve Mentor Information</button>
          </fieldset>

    </form>
    </div>
    </div>

    <!-- Display Retrieved Mentor Information -->
    <?php if (isset($mentor_info)) { ?>
      <div class="card">
        <div class="card-body" id="form-container">
          <form action="" method="post">
            <fieldset class="border border-secondary p-3 form-group">
              <legend class="d-inline w-auto h6">Update Mentor Information</legend>
              <input type="hidden" name="mentor_id" value="<?= $mentor_id_to_retrieve ?>">
              <!-- Include form fields for updating mentor information, pre-filled with existing data -->
              <!-- Example: -->
              <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?= $mentor_info['fname'] ?>">
              </div>

              <div>
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" value="<?= $mentor_info['lname'] ?>">
              </div>
              <div class="form-group">

                <label for="dept_id">Department Id</label>
                <input type="text" class="form-control" id="dept_id" placeholder="Department Id" name="dept_id"    value="<?= $mentor_info['dept_id'] ?>">
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" required class="form-control" id="email" name="email"
                  value="<?= $mentor_info['email'] ?>">
              </div>



              <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" class="form-control" id="mobile" name="mobile"  pattern="[1-9]{1}[0-9]{9}"
                  value="<?= $mentor_info['phone_number'] ?>">

              </div>
             
           
              <!-- Add more fields here for other mentor information -->

              <button name="update" class="btn btn-primary">Update Mentor Information</button>
            </fieldset>
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
            <legend class="d-inline w-auto h6">Delete Mentor</legend>
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="ssn_to_delete">Enter Mentor Id to Delete:</label>
                  <input type="text" class="form-control" id="ssn_to_delete" placeholder="Mentor Id"
                    name="ssn_to_delete">
                </div>
              </div>
            </div>
          </fieldset>
          <button name="delete" class="btn btn-danger">Delete Mentor</button>
        </form>
      </div>
    </div>
  </section>





</section>
<?php include('footer.php') ?>