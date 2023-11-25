<?php
session_start();
include('../includes/config.php');

if (isset($_GET['ssn']) && isset($_GET['sem']) && isset($_GET['date_'])) {
    $ssn = $_GET['ssn'];
    $sem = $_GET['sem'];
    $date = $_GET['date_'];

    // Fetch the student's current information
    $query = "SELECT * FROM project WHERE ssn = '$ssn' AND sem = '$sem' AND date_ = '$date'";
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
            'title' => mysqli_real_escape_string($db_conn, $_POST['title']),
            'group_num' => mysqli_real_escape_string($db_conn, $_POST['group_num']),
            'status' => mysqli_real_escape_string($db_conn, $_POST['status']),
            'guide' => mysqli_real_escape_string($db_conn, $_POST['guide'])
        );

        // Call the MySQL function to update the student's capstone project information
        $updateFunction = "SELECT UpdateStudentProjectInfo('$ssn', '$sem', '$date', '" . $editedData['title'] . "',
         '" . $editedData['group_num'] . "', '" . $editedData['status'] . "', '" . $editedData['guide'] . "') AS rows_affected";
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
                            <h3>Capstone Project</h3>
                        </div>
                        <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="<?= isset($course_info['title']) ? $course_info['title'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="group_num">Number of Members</label>
    <input type="number" class="form-control" id="group_num" min="3" max="4" name="group_num" value="<?= isset($course_info['group_num']) ? $course_info['group_num'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="status">Status</label>
    <input type="text" class="form-control" id="status" name="status" value="<?= isset($course_info['status']) ? $course_info['status'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="guide">Guide</label>
    <input type="text" class="form-control" id="guide" name="guide" value="<?= isset($course_info['guide']) ? $course_info['guide'] : 'No Entry' ?>">
</div>







                       






                        <button name="update" class="btn btn-primary">Update Student Information</button>
                    </form>
                </fieldset>
                



            </div>
        </div>

</section>
<?php include('footer.php') ?>