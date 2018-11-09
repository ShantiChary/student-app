<!DOCTYPE html>
<html>
<head>
  <title>Assignment 2 - Student Administration Web App</title>
  <!-- <link type="text/css" href="http://bcitcomp.ca/twd/css/style.css" rel="stylesheet" /> -->
</head>
<body>
  <h1>Students:</h1>
  <!-- <p><a href="add_student.php">Add a new record</a></p> -->

<?php
/*
student_app.PHP
Displays all data from 'students' table
*/
session_start();

if(!empty($_GET['message'])) {
$message = $_GET['message'];
 echo '<p class="message"> '.$message.'</p>';
}

// connect to the database
include('connect-db.php');

//create sort order
$sortOrder = "id";
if (isset($_GET['choice'])) {
  $sortOrder = $_GET['choice'];
}

$sortOrder = $mysqli->real_escape_string($sortOrder);

// get results from database
$query 	= "SELECT primary_key, id, firstname, lastname FROM students ORDER BY " . $sortOrder . ";";
$result = $mysqli->query( $query );

$rowColors = Array('#e5a3ad','#fff');
$nRow = 0;

// loop through results of database query, displaying them in the table
echo "<table>";
echo '<p style="margin-left: 260px";><a href="add_student.php">Add a Student</a><p>';
echo "<tr> <th>ID</th> <th>First Name</th> <th>Last Name</th> <th></th> <th></th></tr>";
while( $row = $result->fetch_assoc() ){
    echo '<tr style="background-color:'.$rowColors[$nRow++ % count($rowColors)].';">';
        // echo "<td>".$row["primary_key"]."</td>";
    echo "<td>".$row["id"]."</td>";
	  echo "<td>".$row["firstname"]."</td>";
	  echo "<td>".$row["lastname"]."</td>";
    echo "<td><a href='update_student.php?primary_key=".$row['primary_key']."&id=" . $row['id'] . "&firstname=" . $row['firstname'] . "&lastname=" . $row['lastname'] . "'>Update</a></td>";
    echo '<td><a href="delete_student.php?id='.$row['id'] . "&firstname=" . $row['firstname'] . "&lastname=" . $row['lastname'] .'">Delete</a></td>';
 	echo "</tr>";
}
echo "</table>";

session_destroy();
$mysqli->close();
?>

</body>
</html>
