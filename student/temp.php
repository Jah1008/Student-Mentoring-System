<?php
include('../includes/config.php');

if (!isset($_SESSION['ssn'])) {
    header('Location: slogin.php');
    exit();
}

$ssn= $_SESSION['ssn'];

if (isset($_POST['update'])) {
    // Retrieve and sanitize the edited data from the form
    $editedData = array(
        'fname' => mysqli_real_escape_string($db_conn, $_POST['fname']),
        'lname' => mysqli_real_escape_string($db_conn, $_POST['lname']),
        
        'email' => mysqli_real_escape_string($db_conn, $_POST['email']),
        'phone_number' => mysqli_real_escape_string($db_conn, $_POST['phone_number']),
        'dob' => mysqli_real_escape_string($db_conn, $_POST['dob']),
        'father_name' => mysqli_real_escape_string($db_conn, $_POST['father_name']),
        'father_num' => mysqli_real_escape_string($db_conn, $_POST['father_num']),
        'mother_name' => mysqli_real_escape_string($db_conn, $_POST['mother_name']),
        'mother_num' => mysqli_real_escape_string($db_conn, $_POST['mother_num']),
        'pass' => mysqli_real_escape_string($db_conn, $_POST['pass']),
    );

    // Use a try-except block to handle the database query error
    try {
        // Update the mentor's information in the database
        $updateQuery = "UPDATE student_details SET ";
        foreach ($editedData as $field => $value) {
            $updateQuery .= "$field = '$value', ";
        }
        $updateQuery = rtrim($updateQuery, ', '); // Remove the trailing comma
        $updateQuery .= " WHERE ssn = '$ssn'";

        if (mysqli_query($db_conn, $updateQuery)) {
            $_SESSION['success_msg'] = 'Your information has been updated.';
            header('Location: dashboard.php');
            exit();
        } else {
          $_SESSION['success_msg'] = 'Data entered is invalid';
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

// Fetch the mentor's current information
$query = "SELECT * FROM student_details WHERE ssn = '$ssn'";
$result = mysqli_query($db_conn, $query);
$student_info = mysqli_fetch_assoc($result);
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<section class "content">
    <div class="card-body" id="form-container">
        <center>
            <h1 class="card-body bg-yellow">
                WELCOME,
                <?php echo $student_info['fname'] . ' ' . $student_info['lname']; ?>
            </h1>
        </center>

        <div class="card">
            <div class="card-body" id="form-container">
                <fieldset class="border border-secondary p-3 form-group">
                    <legend class="d-inline w-auto h6">Edit  Information</legend>
                    <form action="" method="post">
                        <!-- Display the mentor's current information in the form fields -->
                        <div class="form-group">
    <label for="fname">First Name</label>
    <input type="text" class="form-control" id="fname" name="fname" value="<?= isset($student_info['fname']) ? $student_info['fname'] : 'No Entry' ?>">
</div>

<div class="form-group">
    <label for="lname">Last Name</label>
    <input type="text" class="form-control" id="lname" name="lname" value="<?= isset($student_info['lname']) ? $student_info['lname'] : 'No Entry' ?>">
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" required class="form-control" id="email" name="email" value="<?= isset($student_info['email']) ? $student_info['email'] : 'No Entry' ?>">
</div>

<div class="form-group">
    <label for="phone_number">Mobile</label>
    <input type="text" class="form-control" id="phone_number" name="phone_number" pattern="[1-9]{1}[0-9]{9}" value="<?= isset($student_info['phone_number']) ? $student_info['phone_number'] : 'No Entry' ?>">
</div>

<div class="form-group">
    <label for="dob">DOB</label>
    <input type="date" id="dob" name="dob" pattern="\d{4}-\d{2}-\d{2}" value="<?= isset($student_info['dob']) ? $student_info['dob'] : 'No Entry' ?>" required>
</div>

<div class="form-group">
    <label for="father_name">Father's Name</label>
    <input type="text" class="form-control" id="father_name" name="father_name" value="<?= isset($student_info['father_name']) ? $student_info['father_name'] : 'No Entry' ?>">
</div>

<div class="form-group">
    <label for="father_num">Father's Mobile</label>
    <input type="text" class="form-control" id="father_num" pattern="[1-9]{1}[0-9]{9}" name="father_num" value="<?= isset($student_info['father_num']) ? $student_info['father_num'] : 'No Entry' ?>">
</div>

<div class="form-group">
    <label for="mother_name">Mother's Name</label>
    <input type="text" class ="form-control" id="mother_name" name="mother_name" value="<?= isset($student_info['mother_name']) ? $student_info['mother_name'] : 'No Entry' ?>">
</div>

<div class="form-group">
    <label for="mother_num">Mother's Mobile</label>
    <input type="text" class="form-control" id="mother_num" pattern="[1-9]{1}[0-9]{9}" name="mother_num" value="<?= isset($student_info['mother_num']) ? $student_info['mother_num'] : 'No Entry' ?>">
</div>

<div class="form-group">
    <label for="pass">Password</label>
    <input type="password" class="form-control" id="pass" name="pass" value="<?= isset($student_info['pass']) ? $student_info['pass'] : 'No Entry' ?>">
</div>

                        <button name="update" class="btn btn-primary">Update Mentor Information</button>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
