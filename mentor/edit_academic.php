<?php
session_start();
include('../includes/config.php');

if (isset($_GET['ssn']) && isset($_GET['sem']) && isset($_GET['date_'])) {
    $ssn = $_GET['ssn'];
    $sem = $_GET['sem'];
    $date = $_GET['date_'];

    $query = "SELECT * FROM academic WHERE ssn = '$ssn' AND sem = '$sem' AND date_ = '$date'";
    $result = mysqli_query($db_conn, $query);

    if (!$result) {
        echo "Error: Student not found or not authorized to edit this student.";
        exit();
    }

    // Fetch the student's academic information
    $academicInfo = mysqli_fetch_assoc($result);

    if (isset($_POST['update'])) {
        // Retrieve and sanitize the edited data from the form
        $editedData = array(
            'gpa' => $_POST['gpa'],
            'credits_com' => $_POST['credits_com'],
            'credits_rem' => $_POST['credits_rem'],
        );

        // Call the MySQL function to update the student's academic information
        $updateFunction = "SELECT UpdateStudentAcademicInfo('$ssn', '$sem', '$date', '" . $editedData['gpa'] . "',
         '" . $editedData['credits_com'] . "', '" . $editedData['credits_rem'] . "') AS rows_affected";
        $result = mysqli_query($db_conn, $updateFunction);
        $rows_affected = mysqli_fetch_assoc($result);

        if ($rows_affected['rows_affected'] > 0) {
            $_SESSION['success_msg'] = 'Student information has been updated.';
            header("Location: edit_student.php?ssn=" . $academicInfo['ssn']);
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
                            <h3>Academic</h3>
                        </div>
                       
<div class="form-group">
    <label for="gpa">GPA</label>
    <input type="text" class="form-control" id="gpa" name="gpa" step="0.01" value="<?= isset($academicInfo['gpa']) ? $academicInfo['gpa'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="credits_com">Credits Completed</label>
    <input type="text" class="form-control" id="credits_com" name="credits_com" value="<?= isset($academicInfo['credits_com']) ? $academicInfo['credits_com'] : 'No Entry' ?>">
</div>
<div class="form-group">
    <label for="credits_rem">Credits Remaining</label>
    <input type="text" class="form-control" id="credits_rem" name="credits_rem" value="<?= isset($academicInfo['credits_rem']) ? $academicInfo['credits_rem'] : 'No Entry' ?>">
</div>






                       






                        <button name="update" class="btn btn-primary">Update Student Information</button>
                    </form>
                </fieldset>
                



            </div>
        </div>

</section>
<?php include('footer.php') ?>