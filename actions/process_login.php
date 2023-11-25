<?php
session_start();
include('../includes/config.php');

if (isset($_POST['ssn']) ) {
    $ssn = $_POST['ssn'];
    

    // Verify the student's credentials (you should hash and salt the password in production)
    $query = "SELECT * FROM student_details WHERE ssn = '$ssn' ";
    $result = mysqli_query($db_conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Student is authenticated, store their SSN in a session
        $_SESSION['ssn'] = $ssn;
        header('Location: dashboard.php');
    } else {
        $_SESSION['error_msg'] = 'Invalid SSN or password';
       
    }
}
?>
