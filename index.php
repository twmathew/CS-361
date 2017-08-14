<!-- 
Name: Group 7
Class: CS361
Assignment: Project B - Lost then Found Pets
Description: 
-->


<?php
	//Enable error reporting
	ini_set('display_errors', 'On');
	//Connect to database
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "olareyp-db", "hnKeAyuPdelYCB6x", "olareyp-db");
	if($mysqli->connect_errno)
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
?>


<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<html>
	<head>
		<title>Lost then Found Pets</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>


	<body>
		<div class="complete">
			<h1>Lost then Found Pets</h1>
			<h3>Select your User Profile to access your pets.</h3>
			<h3>Or create a User Profile if you don't have one already have one.</h3>
			<!-- Select User Profile FORM -->
			<div>
				<form method="post" action="userPage.php">
					<fieldset>
						<legend>Select User Profile</legend>
						<label>Name: <select name="userID">
							<?php
								//SELECT query to grab user IDs and names for select options.
								if(!($stmt = $mysqli->prepare("SELECT id, name FROM user")))
									echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
								//Execute the query
								if(!$stmt->execute())
									echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
								//Stores query results in variables
								if(!$stmt->bind_result($id, $name))
									echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
								//Generates html for the select options, inserting values and names from query results
								while ($stmt->fetch())
									echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
								
								$stmt->close();	
							?>
						</select></label>


						<label><input class="button" name="filterUser" type="submit" value="Select" /></label>
					</fieldset>


				</form>
			</div>
				
			<!-- USER INSERT FORM -->
			<div>
				<form method="post" action="userPage.php">
					<fieldset>
						<legend>Create User Profile</legend>
						<label>Name: <input type="text" name="userName" placeholder="Your name"/ required></label>
					
						<label>Phone Number: <input type="text" name="userPhone" placeholder="e.g. 555-555-5555"/ required></label>
					
						<label>Email: <input type="text" name="userEmail" placeholder="e.g. you@email.com"/ required></label>
									
						<label>User Photo: <input type="text" name="userPhoto" placeholder="URL to photo of you"/></label>


						<label><input class="button" name="addUser" type="submit" /></label>
					</fieldset>




				</form>
			</div>
		</div>
	</body>
</html>


