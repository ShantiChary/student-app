<!DOCTYPE html>
<html>
<head>
    <title>Assignment 2 - Student Administration Web App</title>
</head>

<body>
<h1>Add a student record...</h1>

<?php
  session_start();
  if (isset($_SESSION['errormessage'])) {
      echo $_SESSION['errormessage'];
      unset($_SESSION['errormessage']);
  }
?>

	<legend>Add a record</legend>
  <form action="" method="post">
		<fieldset>
      <input type="text" name="id" value="<?php if (isset($_SESSION["id"])) echo $_SESSION["id"]; ?>" />
      <label 	for="id"> - *Student #</label><br />
      <input type="text" name="firstname" value="<?php if (isset($_SESSION["firstname"])) echo $_SESSION["firstname"]; ?>" />
      <label 	for="firstname"> - *First Name</label><br />
      <input type="text" name="lastname" value="<?php if (isset($_SESSION["lastname"])) echo $_SESSION["lastname"]; ?>" />
      <label 	for="lastname"> - *Last Name</label><br />
      <p>* required</p>
      <input type="submit" name="submit" value="Submit">
		</fieldset>
  </form>

</body>
</html>

<?php
include("connect-db.php");

// check if the form has been submitted. If it has, start to process the form and save it to the database
// if (isset($_POST['submit'])){
if( isset($_POST['id']) && isset($_POST['firstname']) && isset($_POST['lastname'])){
    // get form data, making sure it is valid

    $id         = trim($_POST['id']);
    $firstname  = trim($_POST['firstname']);
    $lastname   = trim($_POST['lastname']);

    // check to make sure both fields are entered
    if ($id == '' || $firstname == '' || $lastname == '') {
      // generate error message
      if ($id == '') {
        $_SESSION['errormessage'] = '<p>Please enter Student ID.</p>';
        header("Location: add_student.php");
        die();
      }else {
        $_SESSION["id"]=$id;
      }

      if ($firstname == '') {
        $_SESSION['errormessage'] = '<p>Please enter Student First name.</p>';
        header("Location: add_student.php");
        die();
      }else {
          $_SESSION["firstname"]=$firstname;
      }

      if ($lastname == '') {
        $_SESSION['errormessage'] = '<p>Please enter Student Last name.</p>';
        header("Location: add_student.php");
        die();
      }else{
        $_SESSION["lastname"]=$lastname;
      }
    }else {
      // save the data to the database
      $addquery="INSERT INTO students(id, firstname, lastname) VALUES ('$id','$firstname','$lastname');";
      //insert data to database
      $result = $mysqli->query( $addquery );

      if($result == true){
        header("Location: student_app.php?message=Success! The student: $id $firstname $lastname has been added to the database");
      }else
      {
        header("Location: student_app.php?message=Duplicate Student ID: $id. The record could not be entered into the database.");
      }
     }
    }
?>
