<?php
session_start();
include('../includes/config.php');

if (isset($_GET['ssn']) && isset($_GET['sem']) && isset($_GET['date_'])) {
    $ssn = $_GET['ssn'];
    $sem = $_GET['sem'];
    $date = $_GET['date_'];

    $query = "SELECT * FROM per_dev WHERE ssn = '$ssn' AND sem = '$sem' AND date_ = '$date'";
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
            'event_part' => mysqli_real_escape_string($db_conn, $_POST['event_part']),
            'award' => mysqli_real_escape_string($db_conn, $_POST['award']),
            'hobby' => mysqli_real_escape_string($db_conn, $_POST['hobby']),
            'goal' => mysqli_real_escape_string($db_conn, $_POST['goal']),
        );

        // Call the MySQL function to update the student's personal development information
        $updateFunction = "SELECT updateStudentPersonalDevInfo('$ssn', '$sem', '$date', '" . $editedData['event_part'] . "',
         '" . $editedData['award'] . "', '" . $editedData['hobby'] . "', '" . $editedData['goal'] . "') AS rows_affected";
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
                            <h3>Personal Development</h3>
                        </div>
                        <div class="form-group">
    <label for="event_part">Event Participated</label>
    <input type="text" class="form-control" id="event_part" name="event_part" step="1" value="<?= isset($course_info['event_part']) ? $course_info['event_part'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="award">Awards and Achievements</label>
    <input type="text" class ="form-control" id="award" name="award" value="<?= isset($course_info['award']) ? $course_info['award'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="hobby">Hobbies and Interests</label>
    <input type="text" class="form-control" id="hobby" name="hobby" value="<?= isset($course_info['hobby']) ? $course_info['hobby'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="goal">Personal Goals</label>
    <input type="text" class="form-control" id="goal" name="goal" value="<?= isset($course_info['goal']) ? $course_info['goal'] : 'No Entry' ?>">
</div>






                       






                        <button name="update" class="btn btn-primary">Update Student Information</button>
                    </form>
                </fieldset>
                



            </div>
        </div>

</section>
<?php include('footer.php') ?>