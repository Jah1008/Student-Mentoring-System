<?php
session_start();
include('../includes/config.php');

if (isset($_GET['ssn']) && isset($_GET['sem']) && isset($_GET['date_'])) {
    $ssn = $_GET['ssn'];
    $sem = $_GET['sem'];
    $date = $_GET['date_'];

    $query = "SELECT * FROM health WHERE ssn = '$ssn' AND sem = '$sem' AND date_ = '$date'";
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
            'issue' => $_POST['issue'],
            'plan' => $_POST['plan'],
            'progress' => $_POST['progress'],
            'height' => $_POST['height'],
            'weight' => $_POST['weight']
        );

        // Call the MySQL function to update the student's health information
        $updateFunction = "SELECT UpdateStudentHealthInfo('$ssn', '$sem', '$date', '" . $editedData['issue'] . "', 
        '" . $editedData['plan'] . "', '" . $editedData['progress'] . "', '" . $editedData['height'] . "', '" . $editedData['weight'] . "') 
        AS rows_affected";
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
                            <h3>Physical Health</h3>
                        </div>
                        <div class="form-group">
    <label for="issue">Issue</label>
    <input type="text" class="form-control" id="issue" name="issue" value="<?= isset($course_info['issue']) ? $course_info['issue'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="plan">Exercise Plans</label>
    <input type="text" class="form-control" id="plan" name="plan" value="<?= isset($course_info['plan']) ? $course_info['plan'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="progress">Progress</label>
    <input type="text" class="form-control" id="progress" name="progress" value="<?= isset($course_info['progress']) ? $course_info['progress'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="height">Height</label>
    <input type="number" class="form-control" id="height" step="0.01" min="0.00" max="200.00" name="height" value="<?= isset($course_info['height']) ? $course_info['height'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="weight">Weight</label>
    <input type="number" class="form-control" id="weight" step="0.01" min="0.00" max="200.00" name="weight" value="<?= isset($course_info['weight']) ? $course_info['weight'] : 'No Entry' ?>">
</div>






                       






                        <button name="update" class="btn btn-primary">Update Student Information</button>
                    </form>
                </fieldset>
                



            </div>
        </div>

</section>
<?php include('footer.php') ?>