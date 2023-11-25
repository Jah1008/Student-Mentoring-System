<?php
session_start();
include('../includes/config.php');

if (isset($_GET['ssn']) && isset($_GET['sem']) && isset($_GET['date_'])) {
    $ssn = $_GET['ssn'];
    $sem = $_GET['sem'];
    $date_ = $_GET['date_'];

    // Fetch the student's current information
    $query = "SELECT * FROM career WHERE ssn = '$ssn' AND sem = '$sem' AND date_ = '$date_'";
    $result = mysqli_query($db_conn, $query);

    if (!$result) {
        echo "Error: Student not found or not authorized to edit this student.";
        exit();
    }

    // Retrieve the student's current information
    $course_info = mysqli_fetch_assoc($result);

    if (isset($_POST['update'])) {
        // Retrieve and sanitize the edited data from the form
        $editedData = array(
            'intern' => mysqli_real_escape_string($db_conn, $_POST['intern']),
            'plan' => mysqli_real_escape_string($db_conn, $_POST['plan']),
            'resume' => mysqli_real_escape_string($db_conn, $_POST['resume']),
            'job' => mysqli_real_escape_string($db_conn, $_POST['job'])
        );

        // Call the MySQL function to update the student information
        $updateFunction = "SELECT UpdateStudentInfo('$ssn', '$sem', '$date_', '" . $editedData['intern'] . "', '" . $editedData['plan'] . "', 
        '" . $editedData['resume'] . "', '" . $editedData['job'] . "') AS rows_affected";
        $result = mysqli_query($db_conn, $updateFunction);
        $rows_affected = mysqli_fetch_assoc($result);

        if ($rows_affected['rows_affected'] > 0) {
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