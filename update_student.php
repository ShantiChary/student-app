<!DOCTYPE html>
<html>
<head>
	<title>Update Process</title>

</head>
<body>

<h2>Update a student record...</h2>

  <?php
    if( isset($_GET['primary_key']) &&
        isset($_GET['id']) &&
        isset($_GET['firstname']) &&
        isset($_GET['lastname'])){
        }
        $primarykey    = $_GET['primary_key'];
        $id            = $_GET['id'];
        $firstname     = $_GET['firstname'];
        $lastname      = $_GET['lastname'];
  ?>

	<legend></legend>
	<form method="post" action="">
    <input type="hidden" name="primary_key" value="<?php if (isset($primarykey)) echo $primarykey; ?>">
		<input type="hidden" name="update" value="update" />
		<fieldset>
		<legend>New data</legend>
			<input 	type="text"
					name="id"
					id="id"
					value="<?php if (isset($id)) echo $id; ?>" />
			<label 	for="id"> - Student #</label><br />
			<input 	type="text"
					name="firstname"
					id="firstname"
					value="<?php if (isset($firstname)) echo $firstname; ?>" />
			<label for="firstname"> - Firstname</label><br />
			<input 	type="text"
					name="lastname"
					id="lastname"
					value="<?php if (isset($lastname)) echo $lastname; ?>" />
			<label for="lastname"> - Lastname</label><br />
		</fieldset>

		<input type="submit" value="Submit" />
	</form>

</body>
</html>

<?php
include("connect-db.php");
session_start();

$primary_key      = "";
$id         = "";
$firstname  = "";
$lastname 	= "";

if(isset($_POST['update']))
{
  $primary_key   = $mysqli->real_escape_string(trim($_POST['primary_key']));
  $id            = $mysqli->real_escape_string(trim($_POST['id']));
  $firstname     = $mysqli->real_escape_string(trim($_POST['firstname']));
  $lastname      = $mysqli->real_escape_string(trim($_POST['lastname']));

    // checking empty fields
    if(empty($id) || empty($firstname) || empty($lastname)) {
        if(empty($id)) {
            echo "<font color='red'>Student ID field is empty.</font><br/>";
        }

        if(empty($firstname)) {
            echo "<font color='red'>Student First Name field is empty.</font><br/>";
        }

        if(empty($lastname)) {
            echo "<font color='red'>Student Last Name field is empty.</font><br/>";
        }

    } else {
        //updating the table
				$updatequery="UPDATE students SET id='$id',firstname='$firstname',lastname='$lastname' WHERE primary_key='$primary_key';";
				//insert data to database
				$result = $mysqli->query( $updatequery );

				if($result == true){
					header("Location: student_app.php?message=Success! Student ID: $id record has been updated.");
				}else
				{
					header("Location: student_app.php?message=Duplicate Student ID: $id. The record has not been updated.");
				}
    }
}

?>
