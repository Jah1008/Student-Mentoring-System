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

 $pass= $_POST['pass'];


  

    $result1= "INSERT INTO  student_details (`ssn`,`fname`,`lname`,`mentor_id`,`dept_id`,`email`,`phone_number`,`dob`,`father_name`,`father_num`,`mother_name`,`mother_num`,`pass`) VALUES ('$ssn','$fname','$lname','$mentor_id','$dept_id','$email','$phone_number','$dob','$father_name','$father_num','$mother_name','$mother_num','$pass')";
    try {
      // Attempt to insert or update the data
      // Replace the following line with your actual database query
      // Example: mysqli_query($db_conn, $insert_query);
    
      $result = mysqli_query($db_conn,  $result1);
    
      if ($result1) {
          $_SESSION['success_msg'] = 'Data has been successfully inserted/updated.';
          header('location: student_info.php');
          exit;
       
        
      
         
      } else {
        $_SESSION['success_msg'] = 'Data cannot be updated.';
       
    
      }
    } catch (Exception $e) {
      if ($e->getCode() === 1452  || $e->getCode() === 1062 ) {
          // MySQL error code 1452 corresponds to a foreign key constraint violation
          // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
          $_SESSION['success_msg'] = 'Data entered is invalid';
          header('location: student_info.php?action=add-new');
          exit;
       
      } else {
        $_SESSION['success_msg'] = "The mentor '$mentor_id' already has 5  students";
      }
    }

   

    // $_SESSION['success_msg'] = 'Student  has been successfully added';
    // header('location: student_info.php');

    // exit;

    // Handle the error, e.g., display or log it
  

}

?>
<!-- =----------------------------------------------------------------------------------------------------------------- -->


<?php


// Initialize variables
$ssn_to_retrieve = '';
$update_error = '';

// Handle the form submission to retrieve student information
if (isset($_POST['retrieve'])) {
  $ssn_to_retrieve = $_POST['ssn_to_retrieve'];

  $retrieve_query = mysqli_query($db_conn, "SELECT * FROM student_details WHERE ssn = '$ssn_to_retrieve'");

  $student_info = mysqli_fetch_assoc($retrieve_query);
  if (empty($student_info)) {
    $_SESSION['success_msg'] = "PLease check  the student  '$ssn_to_retrieve' doesn't exist !!";
       
      
   }

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


  // $check_query = mysqli_query($db_conn, "SELECT * FROM student_details  WHERE email = '$email'");
  // if (mysqli_num_rows($check_query) > 0) {
  //   $_SESSION['success_msg'] = 'Email already exists';
   
  // } else {

  $update_query = "UPDATE student_details SET 
                    fname='$fname', lname='$lname', mentor_id='$mentor_id',dept_id='$dept_id',
                    email='$email', phone_number='$phone_number', dob='$dob',
                    father_name='$father_name', father_num='$father_num',
                    mother_name='$mother_name', mother_num='$mother_num'
                    WHERE ssn = '$ssn'";
  
try {
  // Attempt to insert or update the data
  // Replace the following line with your actual database query
  // Example: mysqli_query($db_conn, $insert_query);
  $result = mysqli_query($db_conn, $update_query);

  if ($result) {
      $_SESSION['success_msg'] = 'Data has been successfully updated.';
      header('location: student_info.php');
  
     
  } else {
    $_SESSION['success_msg'] = 'Data cannot be updated.';
   

  }
} catch (Exception $e) {
  if ($e->getCode() === 1452) {
      // MySQL error code 1452 corresponds to a foreign key constraint violation
      // $errorMessage = 'Foreign key constraint violation: The specified department does not exist.';
      $_SESSION['success_msg'] = 'Data entered is invalid';
      header('location: student_info.php');
      exit;
   
  } else {
      $errorMessage = 'An error occurred: ' . $e->getMessage();
  }
}
  // if (mysqli_query($db_conn, $update_query)) {
  //   $_SESSION['success_msg'] = 'Student information has been successfully updated.';
  // } else {
  //   $update_error = 'Failed to update student information. Please try again.';
  // }
}

// }
?>

<!-- HTML Form to Retrieve Student Information -->


<!-- =----------------------------------------------------------------------------------------------------------------- -->
<?php


$error = '';

if (isset($_POST['delete'])) {
  $ssn_to_delete = $_POST['ssn_to_delete'];

  // Check if a student with this SSN exists
  $check_query = mysqli_query($db_conn, "SELECT * FROM student_details WHERE ssn = '$ssn_to_delete'");

  if (mysqli_num_rows($check_query) > 0) {
    // Student with SSN exists, proceed with deletion

    
    mysqli_query($db_conn, "DELETE FROM student_details WHERE ssn = '$ssn_to_delete'");

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
  <div class="card">
    <div class="card-body" id="form-container">

      <?php if (isset($_REQUEST['action'])) { ?>


        <form action="" method="post" enctype="multipart/form-data">
          <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">Student Information</legend>
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">

                  <label for="ssn">SSN</label>
                  <input type="text" class="form-control" id="ssn" placeholder="SSN" name="ssn">
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

                  <label for="mentor_id">Mentor Id</label>
                  <input type="text" class="form-control" id="mentor_id" placeholder="Mentor Id" name="mentor_id">
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
                  <input type="text" class="form-control" id="mobile" placeholder="Mobile" pattern="[1-9]{1}[0-9]{9}" name="mobile">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label for="dob">DOB</label>
                  <!-- <input type="date" required class="form-control" id="dob"  placeholder="DOB" name="dob"> -->
                  <input type="date" id="date" name="date" pattern="\d{4}-\d{2}-\d{2}" required>
                </div>
              </div>

              
            </div>
          </fieldset>
          
       

          <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">Parents Information</legend>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="father_name">Father's Name</label>
                  <input type="text" class="form-control" id="father_name" placeholder="Father's Name" name="father_name">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="father_num">Father's Mobile</label>
                  <input type="text" class="form-control" id="father_num" placeholder="Father's Mobile" name="father_num"  pattern="[1-9]{1}[0-9]{9}">
                </div>
              </div>
              <div class="col-lg-6">
                <div class=" form-group">
                  <label for="mother_name">Mother's Name</label>
                  <input type="text" class="form-control" id="mother_name" placeholder="Mother's Name" name="mother_name">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="mother_num">Mother's Mobile</label>
                  <input type="text" class="form-control" id="mother_num" placeholder="Mothers's Mobile"  pattern="[1-9]{1}[0-9]{9}"
                    name="mother_num">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="pass">Password</label>
                  <input type="password" class="form-control" id="pass" placeholder="Password"  
                    name="pass">
                </div>
              </div>
              <!-- Address Fields -->

            </div>
          </fieldset>





          <button name="submit" class="btn btn-primary">Submit</button>




        </form>




      <?php } else { ?>





        <div class="card-header py-2">
          <h3 class="card-title">
            Student
          </h3>
          <div class="card-tools">
            <a href="?action=add-new" class="btn btn-success btn-xs"><i class="fa fa-plus mr-2"></i>Add New</a>
          </div>
        </div>
        <div class="table-responsive bg-brown">

          <table class="table table-bordered ">
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
                <th>Mother's phone Number</th>
               
              </tr>
            </thead>
            <tbody>
              <?php


              $user_query = 'SELECT * FROM student_details';
             
              $user_result = mysqli_query($db_conn, $user_query);

              $count = 1;
              while ($users = mysqli_fetch_object($user_result)) {
                // echo $users->email;
                ?>



                <tr>
                  <td>
                    <?= $users->ssn ?>
                  </td>
                  <td>
                    <?= $users->fname ?>
                  </td>
                  <td>
                    <?= $users->lname ?>
                  </td>
                  <td>
                    <?= $users->mentor_id ?>
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
                  <td>
                    <?= $users->dob ?>
                  </td>

                  <td>
                    <?= $users->father_name ?>
                  </td>
                  <td>
                    <?= $users->father_num ?>
                  </td>
                  <td>
                    <?= $users->mother_name ?>
                  </td>
                  <td>
                    <?= $users->mother_num ?>
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
  <div class="card">
      <div class="card-body" id="form-container">
    <form action="" method="post">
      <fieldset class="border border-secondary p-3 form-group">
        <legend class="d-inline w-auto h6">Retrieve Student Information</legend>
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label for="ssn_to_retrieve">Enter SSN of the Student to Retrieve:</label>
              <input type="text" class="form-control" id="ssn_to_retrieve" placeholder="SSN" name="ssn_to_retrieve">
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
              <!-- Include form fields for updating student information, pre-filled with existing data -->
              <!-- Example: -->
              <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?= $student_info['fname'] ?>">
              </div>
              <div class="form-group">

                <label for="lname">Last Name</label>
                <input type="text" class="form-control" id="lname"  name="lname"  value="<?= $student_info['lname'] ?>">
              </div>
              <div class="form-group">

                <label for="mentor_id">Mentor Id</label>
                <input type="text" class="form-control" id="mentor_id" name="mentor_id" value="<?= $student_info['mentor_id'] ?>">
              </div>
              <div class="form-group">

                <label for="dept_id">Department Id</label>
                <input type="text" class="form-control" id="dept_id"  name="dept_id" value="<?= $student_info['dept_id'] ?>">
              </div>
              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" required class="form-control" id="email"  name="email" value="<?= $student_info['email'] ?>">
                </div>
                <div class="form-group">
                  <label for="mobile">Mobile</label>
                  <input type="text" class="form-control" id="mobile"  name="mobile"  pattern="[1-9]{1}[0-9]{9}" value="<?= $student_info['phone_number'] ?>">
                </div>
                <div class="form-group">
                  <label for="dob">DOB</label>
                  <!-- <input type="date" required class="form-control" id="dob"  placeholder="DOB" name="dob"> -->
                  <input type="date" id="date" name="date" pattern="\d{4}-\d{2}-\d{2}" value="<?= $student_info['dob'] ?>" required>
                </div>
                
                <div class="form-group">
                  <label for="father_name">Father's Name</label>
                  <input type="text" class="form-control" id="father_name"  name="father_name" value="<?= $student_info['father_name'] ?>">
                
              </div>
             
                <div class="form-group">
                  <label for="father_num">Father's Mobile</label>
                  <input type="text" class="form-control" id="father_num"   pattern="[1-9]{1}[0-9]{9}" name="father_num" value="<?= $student_info['father_num'] ?>">
                </div>
              
              
                <div class=" form-group">
                  <label for="mother_name">Mother's Name</label>
                  <input type="text" class="form-control" id="mother_name"  name="mother_name" value="<?= $student_info['mother_name'] ?>">
                
              </div>
              
                <div class="form-group">
                  <label for="mother_num">Mother's Mobile</label>
                  <input type="text" class="form-control" id="mother_num"   pattern="[1-9]{1}[0-9]{9}" name="mother_num" value="<?= $student_info['mother_num'] ?>">
                </div>


              <!-- Add more fields here for other student information -->

              <button name="update" class="btn btn-primary">Update Student Information</button>
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