<?php
session_start();
include('../includes/config.php');

// Check if a mentor is logged in
if (!isset($_SESSION['mentor_id'])) {
    header('Location: login.php'); // Redirect to the login page if not logged in
    exit();
}

$mentor_id = $_SESSION['mentor_id'];

// Retrieve all students with the same mentor ID
$query = "SELECT * FROM student_details WHERE mentor_id = '$mentor_id'";
$result = mysqli_query($db_conn, $query);


if (!$result) {
    echo "Error: " . mysqli_error($db_conn);
    exit();
}
?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<section class="content">

<div class="card-body " id="form-container">
    <center>
     
        <h1 class="card-body bg-yellow ">Welcome, Mentor ID: <?php echo $mentor_id; ?></h1>
      </h1>
    </center>
   
      <fieldset class="border border-secondary p-3 form-group">
            <legend class="d-inline w-auto h6">Retrieve Student Information</legend>
 

    <table class="table table-bordered">
        <tr>
            <th>SSN</th>
            <th>First Name</th>
            <th>Last Name</th>
            <!-- Add more table headers for other student details -->
            <th>Actions</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['ssn'] . "</td>";
            echo "<td>" . $row['fname'] . "</td>";
            echo "<td>" . $row['lname'] . "</td>";
            // Add more table cells for other student details
            echo "<td><a href='edit_student.php?ssn=" . $row['ssn'] . "'>Edit</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
      </fieldset>
    
</section>
<?php include('footer.php') ?>

