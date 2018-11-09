<!DOCTYPE html>
<html>
<head>
    <title>Assignment 2 - Student Administration Web App</title>
</head>

<body>
<h1>Delete a student record</h1>

<?php
  session_start();
  if (isset($_SESSION['errormessage'])) {
      echo $_SESSION['errormessage'];
      unset($_SESSION['errormessage']);
  }

  $id = $_GET['id'];
  $firstname = $_GET['firstname'];
  $lastname = $_GET['lastname'];
  echo "<p>You are about to delete Student ID: $id $firstname $lastname.</p>";

?>

  <form action="" method="post">
    <div>
      <legend>Delete the record - Are you sure?</legend>
    	<form method="post" action="">
    		<input type="hidden" name="delete" value="delete" />
    		<input 	type="hidden"
    				value=""
    				name="id"
    				  />
    		<input 	type="hidden"
    				value=""
    				name="firstname"
    				  />
    		<input 	type="hidden"
    				value=""
    				name="lastname"
    				  />
    		<input 	type="radio"
    				name="confirm"
    				id="yes"
    				value="yes"
    				checked="checked" />
    		<label for="yes">Yes</label><br />
    		<input 	type="radio"
    				name="confirm"
    				id="no"
    				value="no" />
    		<label for="no">No</label><br />
    		<input type="submit" value="Submit" />
    	</form>
    	</fieldset>

    </div>
  </form>

  <?php

    include("connect-db.php");

      //check the Radio Buttons
    if( isset($_POST['confirm'])  ){
      $confirm= $_POST['confirm'];

      if ($confirm == "yes") {
          if (isset($_GET['id']))
          {
            // get id value
            // $id = $_GET['id'];

            $deletequery="DELETE FROM students WHERE id='$id';";

            $result = $mysqli->query( $deletequery );

            if($result == true){

              header("Location: student_app.php?message=Success! Student: $id has been deleted from the database.");
            }else{
              header("Location: student_app.php?message=Delete query could not be run.");
            }
          }
      }else if ($confirm == "no") {
        if (isset($_GET['id']))
        {
          // get id value
          // $id = $_GET['id'];
          header("Location: student_app.php?message=Student ID: $id has NOT been deleted from the database.");
        }
      }
    }
  ?>
</body>
</html>
