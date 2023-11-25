<?php
// session_start();
include('../includes/config.php');


if (isset($_POST['ssn']) && isset($_POST['pass'])) {
    $ssn= $_POST['ssn'];
    $pass= $_POST['pass'];

    // Verify the student's mentor_id
    $query = "SELECT * FROM student_details WHERE ssn = '$ssn' AND pass ='$pass'";
    $result = mysqli_query($db_conn, $query);

   


    
    if ($result && mysqli_num_rows($result) == 1) {
        // Mentor is authenticated, store their mentor_id in a session
        $_SESSION['ssn'] = $ssn;
        header('Location: dashboard.php');
    } else {
    
        // $_SESSION['success_msg'] = 'Invalid Mentor Id';
        // echo 'Invalid Mentor Id';
        header('Location: ../404.php');
    }
}
?>

