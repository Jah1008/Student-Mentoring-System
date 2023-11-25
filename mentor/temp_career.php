<?php
session_start();
include('../includes/config.php');

if (isset($_GET['ssn']) && isset($_GET['sem']) && isset($_GET['date_'])) {
    $ssn = $_GET['ssn'];
    $sem = $_GET['sem'];
    $date_= $_GET['date_'];

    $query = "SELECT * FROM  career WHERE  ssn = '$ssn' AND sem='$sem' AND date_='$date_' ";
    $result = mysqli_query($db_conn, $query);
    if (!$result) {
        echo "Error: Student not found or not authorized to edit this student.";
        exit();
    }


    // Fetch the student's information
    $course_info = mysqli_fetch_assoc($result);
    if (isset($_POST['update'])) {
        // Retrieve and sanitize the edited data from the form
          $editedData = array(
        
            'intern' => mysqli_real_escape_string($db_conn, $_POST['intern']),
            'plan' => mysqli_real_escape_string($db_conn, $_POST['plan']),
            'resume' => mysqli_real_escape_string($db_conn, $_POST['resume']),
            'job' => mysqli_real_escape_string($db_conn, $_POST['job'])
            


        );
       
        $updateQuery= "UPDATE career SET ";
        foreach ($editedData as $field => $value) {
            $updateQuery .= "$field = '$value', ";
        }
        $updateQuery = rtrim($updateQuery, ', '); // Remove the trailing comma
        $updateQuery .= " WHERE ssn = '$ssn' AND sem='$sem'  AND  date_='$date_'";
        if (mysqli_query($db_conn, $updateQuery) ) {

            $_SESSION['success_msg'] = 'Student information has been updated.';
            header("Location: edit_student.php?ssn=" . $course_info['ssn']);
            exit();
        } else {
            echo "Error: Unable to update student information.";
        }



} }else {
   
    echo "Error: SSN parameter not provided.";
    exit();
}
?>


<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<section class="content">
    <h1></h1>
    <div class="card-body " id="form-container">
        <center>

            <h1 class="card-body bg-yellow "> SSN:
                <?php echo $ssn; ?>
            </h1>
            </h1>
        </center>


        <div class="card">
            <div class="card-body" id="form-container">
                <fieldset class="border border-secondary p-3 form-group">
                    <legend class="d-inline w-auto h6">Edit Student Information</legend>
                    <form action="" method="post">
                        <!-- Display the student's current information in the form fields -->
                        <div class="card-body" id="form-container">
                            <h3>Career Development</h3>
                        </div>
                        <div class="form-group">
    <label for="intern">Internships</label>
    <input type="text" class="form-control" id="intern" name="intern" step="1" value="<?= isset($course_info['intern']) ? $course_info['intern'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="plan">Career Plans</label>
    <input type="text" class="form-control" id="plan" name="plan" value="<?= isset($course_info['plan']) ? $course_info['plan'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="resume">Resume Link</label>
    <input type="text" class="form-control" id="resume" name="resume" value="<?= isset($course_info['resume']) ? $course_info['resume'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="job">Job Offers</label>
    <input type="text" class="form-control" id="job" name="job" value="<?= isset($course_info['job']) ? $course_info['job'] : 'No Entry' ?>">
</div>






                       






                        <button name="update" class="btn btn-primary">Update Student Information</button>
                    </form>
                </fieldset>
                



            </div>
        </div>

</section>
<?php include('footer.php') ?>


<!-- ==================================================================================================================================== -->
<?php
session_start();
include('../includes/config.php');

function updateStudentCareerInfo($ssn, $sem, $date, $editedData, $db_conn) {
    $updateQuery = "UPDATE career SET ";
    foreach ($editedData as $field => $value) {
        $updateQuery .= "$field = '" . mysqli_real_escape_string($db_conn, $value) . "', ";
    }
    $updateQuery = rtrim($updateQuery, ', '); // Remove the trailing comma
    $updateQuery .= " WHERE ssn = '$ssn' AND sem = '$sem' AND date_ = '$date'";

    if (mysqli_query($db_conn, $updateQuery)) {
        return true; // Update successful
    } else {
        return false; // Update failed
    }
}

if (isset($_GET['ssn']) && isset($_GET['sem']) && isset($_GET['date_'])) {
    $ssn = $_GET['ssn'];
    $sem = $_GET['sem'];
    $date = $_GET['date_'];

    $query = "SELECT * FROM career WHERE ssn = '$ssn' AND sem = '$sem' AND date_ = '$date'";
    $result = mysqli_query($db_conn, $query);
    
    if (!$result) {
        echo "Error: Student not found or not authorized to edit this student.";
        exit();
    }

    // Fetch the student's information
    $course_info = mysqli_fetch_assoc($result);
    
    if (isset($_POST['update'])) {
        // Retrieve and sanitize the edited data from the form
        $editedData = array(
            'intern' => $_POST['intern'],
            'plan' => $_POST['plan'],
            'resume' => $_POST['resume'],
            'job' => $_POST['job']
        );

        if (updateStudentCareerInfo($ssn, $sem, $date, $editedData, $db_conn)) {
            $_SESSION['success_msg'] = 'Student information has been updated.';
            header("Location: edit_student.php?ssn=" . $course_info['ssn']);
            exit();
        } else {
            echo "Error: Unable to update student information.";
        }
    }
} else {
    echo "Error: SSN parameter not provided.";
    exit();
}
?>

<!-- Rest of your HTML and form code remains the same -->

<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<section class="content">
    <h1></h1>
    <div class="card-body " id="form-container">
        <center>

            <h1 class="card-body bg-yellow "> SSN:
                <?php echo $ssn; ?>
            </h1>
            </h1>
        </center>


        <div class="card">
            <div class="card-body" id="form-container">
                <fieldset class="border border-secondary p-3 form-group">
                    <legend class="d-inline w-auto h6">Edit Student Information</legend>
                    <form action="" method="post">
                        <!-- Display the student's current information in the form fields -->
                        <div class="card-body" id="form-container">
                            <h3>Career Development</h3>
                        </div>
                        <div class="form-group">
    <label for="intern">Internships</label>
    <input type="text" class="form-control" id="intern" name="intern" step="1" value="<?= isset($course_info['intern']) ? $course_info['intern'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="plan">Career Plans</label>
    <input type="text" class="form-control" id="plan" name="plan" value="<?= isset($course_info['plan']) ? $course_info['plan'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="resume">Resume Link</label>
    <input type="text" class="form-control" id="resume" name="resume" value="<?= isset($course_info['resume']) ? $course_info['resume'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="job">Job Offers</label>
    <input type="text" class="form-control" id="job" name="job" value="<?= isset($course_info['job']) ? $course_info['job'] : 'No Entry' ?>">
</div>






                       






                        <button name="update" class="btn btn-primary">Update Student Information</button>
                    </form>
                </fieldset>
                



            </div>
        </div>

</section>
<?php include('footer.php') ?>