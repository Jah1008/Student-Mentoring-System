<?php
include('../includes/config.php');

if (!isset($_SESSION['mentor_id'])) {
    header('Location: mlogin.php');
    exit();
}

$mentor_id = $_SESSION['mentor_id'];

if (isset($_POST['update'])) {
    // Retrieve and sanitize the edited data from the form
    $editedData = array(
        'fname' => mysqli_real_escape_string($db_conn, $_POST['fname']),
        'lname' => mysqli_real_escape_string($db_conn, $_POST['lname']),
        
        'email' => mysqli_real_escape_string($db_conn, $_POST['email']),
        'phone_number' => mysqli_real_escape_string($db_conn, $_POST['phone_number']),
        'pass' => mysqli_real_escape_string($db_conn, $_POST['pass']),
    );

    // Use a try-except block to handle the database query error
    try {
        // Update the mentor's information in the database
        $updateQuery = "UPDATE accounts SET ";
        foreach ($editedData as $field => $value) {
            $updateQuery .= "$field = '$value', ";
        }
        $updateQuery = rtrim($updateQuery, ', '); // Remove the trailing comma
        $updateQuery .= " WHERE mentor_id = '$mentor_id'";

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
$query = "SELECT * FROM accounts WHERE mentor_id = '$mentor_id'";
$result = mysqli_query($db_conn, $query);
$mentor_info = mysqli_fetch_assoc($result);
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<section class "content">
    <div class="card-body" id="form-container">
        <center>
            <h1 class="card-body bg-yellow">
                WELCOME,
                <?php echo $mentor_info['fname'] . ' ' . $mentor_info['lname']; ?>
            </h1>
        </center>

        <div class="card">
            <div class="card-body" id="form-container">
                <fieldset class="border border-secondary p-3 form-group">
                    <legend class="d-inline w-auto h6">Edit Mentor Information</legend>
                    <form action="" method="post">
                        <!-- Display the mentor's current information in the form fields -->
                        <div class="form-group">
    <label for="fname">First Name</label>
    <input type="text" name="fname" class="form-control" value="<?= isset($mentor_info['fname']) ? $mentor_info['fname'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="lname">Last Name</label>
    <input type="text" name="lname" class="form-control" value="<?= isset($mentor_info['lname']) ? $mentor_info['lname'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="text" name="email" class="form-control" value="<?= isset($mentor_info['email']) ? $mentor_info['email'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="phone_number">Phone Number</label>
    <input type="text" name="phone_number" class="form-control" value="<?= isset($mentor_info['phone_number']) ? $mentor_info['phone_number'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="pass">Password</label>
    <input type="password" name="pass" class="form-control" value="<?= isset($mentor_info['pass']) ? $mentor_info['pass'] : 'No Entry' ?>">
</div>

                        <button name="update" class="btn btn-primary">Update Mentor Information</button>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
