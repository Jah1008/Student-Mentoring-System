
<?php
session_start();
include('../includes/config.php');

if (isset($_POST['mentor_id']) && isset($_POST['pass'])) {
    $mentor_id = $_POST['mentor_id'];
    $pass = $_POST['pass'];

    $query = "SELECT * FROM accounts WHERE mentor_id = '$mentor_id' AND pass = '$pass'";
    $result = mysqli_query($db_conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        // Mentor is authenticated, store their mentor_id in a session
        $_SESSION['mentor_id'] = $mentor_id;
        header('Location: dashboard.php');
    } else {
        header('Location: ../404.php');
    }
}
?>
