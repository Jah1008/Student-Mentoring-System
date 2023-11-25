<?php include('../includes/config.php');

 include("header.php");
 include("sidebar.php") ;
 ?>

<?php
    // Assuming you have the $db_conn variable for your database connection

    if (isset($_POST['submit'])) {
        $event_name = $_POST['event_name'];

        // Fetch and display students who participated in the specified event
        $result = mysqli_query($db_conn, "SELECT ssn, fname, lname
            FROM student_details
            WHERE ssn IN (
                SELECT ssn
                FROM per_dev
                WHERE event_part = '$event_name'
            )");

        if ($result && mysqli_num_rows($result) > 0) {
            echo '<h3>Participants:</h3>';
            echo '<ul>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<li>' . $row['ssn'] . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No participants found for the specified event.</p>';
        }
    }
    ?>
    
<div class="card">
    <div class="card-body">

    <h2>Event Participants</h2>

    <form action="" method="post">
        <label for="event_name">Enter Event Name:</label>
        <input type="text" name="event_name" required>
        <button type="submit" name="submit">Fetch Participants</button>
    </form>

    

</div>
<?php 
include("footer.php") ;
?>
</div>
