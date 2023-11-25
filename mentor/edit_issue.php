<?php
session_start();
include('../includes/config.php');



if (isset($_GET['ssn']) && isset($_GET['sem']) && isset($_GET['date_'])) {
    $ssn = $_GET['ssn'];
    $sem = $_GET['sem'];
    $date = $_GET['date_'];

    $query = "SELECT * FROM issue WHERE ssn = '$ssn' AND sem = '$sem' AND date_ = '$date'";
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
            'time_' => $_POST['time_'],
            'issues' => $_POST['issue'],
            'solution_provided' => $_POST['sol'],
            'advice_given' => $_POST['ad']
        );

         // Call the MySQL function to update the student's issue information
    $updateFunction = "SELECT UpdateStudentIssueInfo('$ssn', '$sem', '$date', '" . $editedData['time_'] . "',
     '" . $editedData['issues'] . "', '" . $editedData['solution_provided'] . "', '" . $editedData['advice_given'] . "') AS rows_affected";
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
                            <h3>Student Issues</h3>
                        </div>
                        <div class="form-group">
                            <label for="time_">Timings</label>
                            <input type="time" class="form-control" id="time_" name="time_" step="1"
                                value="<?= isset($course_info['time_']) ? $course_info['time_'] : 'No Entry' ?>">
                        </div>
                        <div class="form-group">
                            <label for="issue">Issues</label>
                            <input type="text" class="form-control" id="issue" name="issue"
                                value="<?= isset($course_info['issues']) ? $course_info['issues'] : 'No Entry' ?>">
                        </div>
                        <div class="form-group">
                            <label for="sol">Solution Provided</label>
                            <input type="text" class="form-control" id="sol" placeholder="Solution provided" name="sol"
                                value="<?= isset($course_info['solution_provided']) ? $course_info['solution_provided'] : 'No Entry' ?>">
                        </div>
                        <div class="form-group">
                            <label for="ad">Feedback</label>
                            <input type="text" class="form-control" id="ad" name="ad"
                                value="<?= isset($course_info['advice_given']) ? $course_info['advice_given'] : 'No Entry' ?>">
                        </div>













                        <button name="update" class="btn btn-primary">Update Student Information</button>
                    </form>
                </fieldset>




            </div>
        </div>

</section>
<?php include('footer.php') ?>