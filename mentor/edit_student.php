<?php
session_start();
include('../includes/config.php');

// Check if a mentor is logged in
if (!isset($_SESSION['mentor_id'])) {
    header('Location: ../mlogin.php'); // Redirect to the login page if not logged in
    exit();
}

$mentor_id = $_SESSION['mentor_id'];

if (isset($_GET['ssn'])) {
    $ssn = $_GET['ssn'];

    // Query the database to retrieve the student's information
    $query = "SELECT * FROM student_details WHERE mentor_id = '$mentor_id' AND ssn = '$ssn'";
    $result = mysqli_query($db_conn, $query);
   
    if (!$result ) {
        echo "Error: Student not found or not authorized to edit this student.";
        exit();
    }


    // Fetch the student's information
    $studentInfo = mysqli_fetch_assoc($result);
    // $studentInfo1 = mysqli_fetch_assoc($result1);
    // $course_info = mysqli_fetch_assoc($result2);


    // Check if the edit form is submitted
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
        );
      



        // Update the student's information in the database
        $updateQuery = "UPDATE student_details SET ";
        foreach ($editedData as $field => $value) {
            $updateQuery .= "$field = '$value', ";
        }
        $updateQuery = rtrim($updateQuery, ', '); // Remove the trailing comma
        $updateQuery .= " WHERE ssn = '$ssn' AND mentor_id = '$mentor_id'";


      









        if (mysqli_query($db_conn, $updateQuery)) {

            $_SESSION['success_msg'] = 'Student information has been updated.';
            header('Location: student_info.php');
            exit();
        } else {
            echo "Error: Unable to update student information.";
        }
    } elseif (isset($_POST['retrieve_academic'])) {
        // Check if the 'sem' input is provided
        if (isset($_POST['sem']) && !empty($_POST['sem']) && isset($_POST['date_']) && !empty($_POST['date_'])) {
            $sem = mysqli_real_escape_string($db_conn, $_POST['sem']);
            $date_=mysqli_real_escape_string($db_conn, $_POST['date_']);

            // Redirect to the edit_academics page with 'ssn' and 'sem' parameters
            header("Location: edit_academic.php?ssn=$ssn&sem=$sem&date_=$date_");
            exit();
        }
    } 
    elseif (isset($_POST['retrieve_project'])) {
        // Check if the 'sem' input is provided
        if (isset($_POST['sem']) && !empty($_POST['sem']) && isset($_POST['date_']) && !empty($_POST['date_'])) {
            $sem = mysqli_real_escape_string($db_conn, $_POST['sem']);
            $date_=mysqli_real_escape_string($db_conn, $_POST['date_']);

            // Redirect to the edit_academics page with 'ssn' and 'sem' parameters
            header("Location: edit_project.php?ssn=$ssn&sem=$sem&date_=$date_");
            exit();
        }
    } 
    elseif (isset($_POST['retrieve_health'])) {
        // Check if the 'sem' input is provided
        if (isset($_POST['sem']) && !empty($_POST['sem']) && isset($_POST['date_']) && !empty($_POST['date_'])) {
            $sem = mysqli_real_escape_string($db_conn, $_POST['sem']);
            $date_=mysqli_real_escape_string($db_conn, $_POST['date_']);

            // Redirect to the edit_academics page with 'ssn' and 'sem' parameters
            header("Location: edit_health.php?ssn=$ssn&sem=$sem&date_=$date_");
            exit();
        }
    } 
    elseif (isset($_POST['retrieve_personal'])) {
        // Check if the 'sem' input is provided
        if (isset($_POST['sem']) && !empty($_POST['sem']) && isset($_POST['date_']) && !empty($_POST['date_'])) {
            $sem = mysqli_real_escape_string($db_conn, $_POST['sem']);
            $date_=mysqli_real_escape_string($db_conn, $_POST['date_']);

            // Redirect to the edit_academics page with 'ssn' and 'sem' parameters
            header("Location: edit_personal.php?ssn=$ssn&sem=$sem&date_=$date_");
            exit();
        }
    } 
    elseif (isset($_POST['retrieve_career'])) {
        // Check if the 'sem' input is provided
        if (isset($_POST['sem']) && !empty($_POST['sem']) && isset($_POST['date_']) && !empty($_POST['date_'])) {
            $sem = mysqli_real_escape_string($db_conn, $_POST['sem']);
            $date_=mysqli_real_escape_string($db_conn, $_POST['date_']);

            // Redirect to the edit_academics page with 'ssn' and 'sem' parameters
            header("Location: edit_career.php?ssn=$ssn&sem=$sem&date_=$date_");
            exit();
        }
    } 
    elseif (isset($_POST['retrieve_issues'])) {
        // Check if the 'sem' input is provided
        if (isset($_POST['sem']) && !empty($_POST['sem']) && isset($_POST['date_']) && !empty($_POST['date_'])) {
            $sem = mysqli_real_escape_string($db_conn, $_POST['sem']);
            $date_=mysqli_real_escape_string($db_conn, $_POST['date_']);

            // Redirect to the edit_academics page with 'ssn' and 'sem' parameters
            header("Location: edit_issue.php?ssn=$ssn&sem=$sem&date_=$date_");
            exit();
        }
    } 


} else {
    echo "Error: SSN parameter not provided.";
    exit();
}
// Check if the edit form is submitted


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
                            <h3>Personal Information</h3>
                        </div>
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname"
                                value="<?= isset($studentInfo['fname']) ? $studentInfo['fname'] : 'No Entry' ?>">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname"
                                value="<?= isset($studentInfo['lname']) ? $studentInfo['lname'] : 'No Entry' ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="<?= isset($studentInfo['email']) ? $studentInfo['email'] : 'No Entry' ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                value="<?= isset($studentInfo['phone_number']) ? $studentInfo['phone_number'] : 'No Entry' ?>">
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" pattern="\d{4}-\d{2}-\d{2}"
                                value="<?= isset($studentInfo['dob']) ? $studentInfo['dob'] : 'No Entry' ?>">
                        </div>
                        <div class="form-group">
                            <label for="father_name">Father's Name</label>
                            <input type="text" class="form-control" id="father_name" name="father_name"
                                value="<?= isset($studentInfo['father_name']) ? $studentInfo['father_name'] : 'No Entry' ?>">
                        </div>
                        <div class="form-group">
                            <label for="father_num">Father's Number</label>
                            <input type="text" class="form-control" id="father_num" name="father_num"
                                value="<?= isset($studentInfo['father_num']) ? $studentInfo['father_num'] : 'No Entry' ?>">
                        </div>
                        <div class="form-group">
                            <label for="mother_name">Mother's Name</label>
                            <input type="text" class="form-control" id="mother_name" name="mother_name"
                                value="<?= isset($studentInfo['mother_name']) ? $studentInfo['mother_name'] : 'No Entry' ?>">
                        </div>
                        <div class="form-group">
                            <label for="mother_num">Mother's Number</label>
                            <input type="text" class="form-control" id="mother_num" name="mother_num"
                                value="<?= isset($studentInfo['mother_num']) ? $studentInfo['mother_num'] : 'No Entry' ?>">
                        </div>

                  







                        <button name="update" class="btn btn-primary">Update Student Information</button>
                    </form>
                </fieldset>
                <fieldset class="border border-secondary p-3 form-group">
                    <legend class="d-inline w-auto h6">Academic Progress</legend>
                    <form action="" method="post">
                        <!-- Other form fields for student information updates -->

                        <div class="form-group">
                            <label for="sem">Semester</label>
                            <input type="text" class="form-control" id="sem" name="sem" placeholder="Enter Semester">
                        </div>
                        <div class="form-group">
                            <label for="date_">Date</label>
                            <input type="date" class="form-control" id="date_" name="date_" placeholder="Enter Date"  pattern="\d{4}-\d{2}-\d{2}">
                        </div>


                        <button name="retrieve_academic" class="btn btn-primary">Retrieve</button>
                    </form>
                </fieldset>

                <fieldset class="border border-secondary p-3 form-group">
                    <legend class="d-inline w-auto h6">Capstone Project</legend>
                    <form action="" method="post">
                        <!-- Other form fields for student information updates -->

                        <div class="form-group">
                            <label for="sem">Semester</label>
                            <input type="text" class="form-control" id="sem" name="sem" placeholder="Enter Semester">
                        </div>
                        <div class="form-group">
                            <label for="date_">Date</label>
                            <input type="date" class="form-control" id="date_" name="date_" placeholder="Enter Date"  pattern="\d{4}-\d{2}-\d{2}">
                        </div>


                        <button name="retrieve_project" class="btn btn-primary">Retrieve</button>
                    </form>
                </fieldset>

                <fieldset class="border border-secondary p-3 form-group">
                    <legend class="d-inline w-auto h6">Physical Health</legend>
                    <form action="" method="post">
                        <!-- Other form fields for student information updates -->

                        <div class="form-group">
                            <label for="sem">Semester</label>
                            <input type="text" class="form-control" id="sem" name="sem" placeholder="Enter Semester">
                        </div>
                        <div class="form-group">
                            <label for="date_">Date</label>
                            <input type="date" class="form-control" id="date_" name="date_" placeholder="Enter Date"  pattern="\d{4}-\d{2}-\d{2}">
                        </div>


                        <button name="retrieve_health" class="btn btn-primary">Retrieve</button>
                    </form>
                </fieldset>
                <fieldset class="border border-secondary p-3 form-group">
                    <legend class="d-inline w-auto h6">Personal Development</legend>
                    <form action="" method="post">
                        <!-- Other form fields for student information updates -->

                        <div class="form-group">
                            <label for="sem">Semester</label>
                            <input type="text" class="form-control" id="sem" name="sem" placeholder="Enter Semester">
                        </div>
                        <div class="form-group">
                            <label for="date_">Date</label>
                            <input type="date" class="form-control" id="date_" name="date_" placeholder="Enter Date"  pattern="\d{4}-\d{2}-\d{2}">
                        </div>


                        <button name="retrieve_personal" class="btn btn-primary">Retrieve</button>
                    </form>
                </fieldset>

                <fieldset class="border border-secondary p-3 form-group">
                    <legend class="d-inline w-auto h6">Career Development</legend>
                    <form action="" method="post">
                        <!-- Other form fields for student information updates -->

                        <div class="form-group">
                            <label for="sem">Semester</label>
                            <input type="text" class="form-control" id="sem" name="sem" placeholder="Enter Semester">
                        </div>
                        <div class="form-group">
                            <label for="date_">Date</label>
                            <input type="date" class="form-control" id="date_" name="date_" placeholder="Enter Date"  pattern="\d{4}-\d{2}-\d{2}">
                        </div>


                        <button name="retrieve_career" class="btn btn-primary">Retrieve</button>
                    </form>
                </fieldset>

                <fieldset class="border border-secondary p-3 form-group">
                    <legend class="d-inline w-auto h6">Student Issues</legend>
                    <form action="" method="post">
                        <!-- Other form fields for student information updates -->

                        <div class="form-group">
                            <label for="sem">Semester</label>
                            <input type="text" class="form-control" id="sem" name="sem" placeholder="Enter Semester">
                        </div>
                        <div class="form-group">
                            <label for="date_">Date</label>
                            <input type="date" class="form-control" id="date_" name="date_" placeholder="Enter Date"  pattern="\d{4}-\d{2}-\d{2}">
                        </div>


                        <button name="retrieve_issues" class="btn btn-primary">Retrieve</button>
                    </form>
                </fieldset>
 

            </div>
        </div>

</section>
<?php include('footer.php') ?>