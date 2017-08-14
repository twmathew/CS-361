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
		<title>User Page</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>


	<body>
		<?php
		//Add new user
		if(isset($_POST['addUser']))
		{
			//Query to insert data into the user table.
			if(!($stmt = $mysqli->prepare("INSERT INTO user(name, phoneNumber, email, userPhoto) VALUES (?, ?, ?, ?)")))
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			//Binds values from the post data to query values
			if (!($stmt->bind_param("ssss", $_POST['userName'], $_POST['userPhone'], $_POST['userEmail'], $_POST['userPhoto'])))
				echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			//Execute the query
			if(!$stmt->execute())
				echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
			//else
				//echo "Added " . $stmt->affected_rows . " rows to user.";
			//Generates html code for link returning user to previous page
			//echo "<p><a href='index.php'>Go Back</a></p>";
		
		
			//Get newly-added users's id
			if(!($stmt = $mysqli->prepare("SELECT id FROM user WHERE name = ?")))
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			//Binds values from the post data to query values
			if (!($stmt->bind_param("s", $_POST['userName'])))
				echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			//Execute the query
			if(!$stmt->execute())
				echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
			//Stores query results in variables
			if(!$stmt->bind_result($userIdNew))
				echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			while ($stmt->fetch());






			$_POST['userID'] = $userIdNew;
		}		


		//Delete existing pet
		if(isset($_POST['deletePet']))
		{
			//Query to delete data from the players table.
			if(!($stmt = $mysqli->prepare("DELETE FROM pet WHERE pet.id = ?")))
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			//Binds values from the post data to query values
			if (!($stmt->bind_param("i", $_POST['petId'])))
				echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			//Execute the query
			if(!$stmt->execute())
				echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
			//else
				//echo "Removed " . $stmt->affected_rows . " pet.";
			//Generates html code for link returning user to previous page
			//echo "<p><a href='index.php'>Go Back</a></p>";
		}
		
		//Add new pet
		if(isset($_POST['addPet']))
		{
			//Query to insert data into the pet table.
			if(!($stmt = $mysqli->prepare("INSERT INTO pet(name, animalType, size, weightPounds, breed, color, otherNotes, petPhoto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")))
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			//Binds values from the post data to query values
			if (!($stmt->bind_param("sssissss", $_POST['petName'], $_POST['animalType'], $_POST['size'], $_POST['weightPounds'], $_POST['breed'], $_POST['color'], $_POST['otherNotes'], $_POST['petPhoto'])))
				echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			//Execute the query
			if(!$stmt->execute())
				echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
			//else
				//echo "Added " . $stmt->affected_rows . " rows to pet.";
			//Generates html code for link returning user to previous page
			//echo "<p><a href='index.php'>Go Back</a></p>";


			//Get newly-added pet's id
			if(!($stmt = $mysqli->prepare("SELECT id FROM pet WHERE name = ?")))
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			//Binds values from the post data to query values
			if (!($stmt->bind_param("s", $_POST['petName'])))
				echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			//Execute the query
			if(!$stmt->execute())
				echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
			//Stores query results in variables
			if(!$stmt->bind_result($petIdNew))
				echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			while ($stmt->fetch());
			
			//Assign pet to current user.
			if(!($stmt = $mysqli->prepare("INSERT INTO userPets(uid, pid) VALUES (?, $petIdNew)")))
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			//Binds values from the post data to query values
			if (!($stmt->bind_param("i", $_POST['userID'])))
				echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			//Execute the query
			if(!$stmt->execute())
				echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
			//else
				//echo "Added " . $stmt->affected_rows . " rows to userPets.";
			//Generates html code for link returning user to previous page
			//echo "<p><a href='index.php'>Go Back</a></p>";		




		}
		?>




		<!-- USER TABLE  -->
		<div>
			<table>
				<caption>Your User Profile</caption>
				<tr>
					<th>Name</th>
					<th>Phone Number</th>
					<th>Email</th>
					<th>Photo</th>
				</tr>
				
				<?php
					//SELECT query to grab user IDs and names for select options.
					if(!($stmt = $mysqli->prepare("SELECT name, phoneNumber, email, userPhoto FROM user WHERE id = ?")))
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					//Binds values from the post data to query values
					if (!($stmt->bind_param("s", $_POST['userID'])))
						echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
					//Execute the query
					if(!$stmt->execute())
						echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
					//Stores query results in variables
					if(!$stmt->bind_result($name, $phoneNumber, $email, $UserPhoto))
						echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
					//Generates html table, inserting variable values for td
					while ($stmt->fetch())
						echo "<tr>\n<td>" . $name . "</td>\n<td>" . $phoneNumber . "</td>\n<td>" . $email . "</td>\n<td><img src='" . $UserPhoto . "' style='width:90px;'></td>\n</tr>";
				
					$stmt->close();	
				?>
			</table>
		</div>
		
		<!-- USER's PETS TABLE  -->
		<div>
			<table>
				<caption>Your Pets</caption>
				<tr>
					<th>Name</th>
					<th>Type of Animal</th>
					<th>Size</th>
					<th>Weight (pounds)</th>
					<th>Breed</th>
					<th>Color</th>
					<th>OtherNotes</th>
					<th>Photo</th>
					<th>Last GPS Coords</th>
					<th>Find My Pet</th>
				</tr>
				<?php
					//SELECT query to display data from pet table. 
					if(!($stmt = $mysqli->prepare("SELECT pet.name, pet.animalType, pet.size, pet.weightPounds, pet.breed, pet.color, pet.otherNotes, pet.petPhoto, pet.gpsCoord FROM pet 
													INNER JOIN userPets ON pet.id = userPets.pid
													INNER JOIN user ON userPets.uid = user.id WHERE user.id = ?")))
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					//Binds values from the post data to query values
					if (!($stmt->bind_param("s", $_POST['userID'])))
						echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
					//Execute the query
					if(!$stmt->execute())
						echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
					//Stores query results in variables
					if(!$stmt->bind_result($name, $animalType, $size, $weightPounds, $breed, $color, $otherNotes, $petPhoto, $gpsCoord))
						echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
					//Generates html table, inserting variable values for td
					while ($stmt->fetch())
						echo "<tr>\n<td>" . $name . "</td>\n<td>" . $animalType . "</td>\n<td>" . $size . "</td>\n<td>" . $weightPounds . "</td>\n<td>" . $breed . "</td>\n<td>" . $color . "</td>\n<td>" . $otherNotes . "</td>\n<td><img src='" . $petPhoto . "' style='width:90px;'></td>\n<td>" . $gpsCoord . "</td>\n<td>" . "<input class='button' name='addPet' type='submit' value='Find " . $name . "'/>" . "</td>\n</tr>";
					
					$stmt->close();
				?>


			</table>
		</div>


		<!-- PET INSERT FORM -->
		<div>
			<form method="post" action="userPage.php">
				<fieldset>
					<legend>Add New Pet</legend>
					<label style="display:none;">User: <select name="userID">
					<?php
						echo "<option value=" . $_POST['userID'] . ">" . $_POST['userID'] . "</option>\n";
					?>
					</select></label>
					<label>Name: <input type="text" name="petName" placeholder="e.g. Snuffles"/ required></label>
				
					<label>Type of Animal: <input type="text" name="animalType" placeholder="e.g. Dog or Cat"/ required></label>
				
					<label>Size: <input type="text" name="size" placeholder="e.g. Small, Huge, etc."/></label>
								
					<label>Weight: <input type="text" name="weightPounds" placeholder="e.g. 20 (pounds)"/></label>
					
					<label>Breed: <input type="text" name="breed" placeholder="e.g. Dalmatian"/></label>
					
					<label>Color: <input type="text" name="color" placeholder="e.g. Black"/></label>
					
					<label>Other Notes: <input type="text" name="otherNotes" placeholder="e.g. Scared of cars."/></label>
					
					<label>Photo: <input type="text" name="petPhoto" placeholder="URL to photo of pet"/></label>


					<label><input class="button" name="addPet" type="submit" /></label>
				</fieldset>




			</form>
		</div>






		<!-- PET DELETE FORM -->
		<div>
			<form method="post" action="userPage.php">
				<fieldset>
					<legend>Remove Existing Pet</legend>
						<label style="display:none;">User: <select name="userID">
						<?php
							echo "<option value=" . $_POST['userID'] . ">" . $_POST['userID'] . "</option>\n";
						?>
						</select></label>
						<label>Pet: <select name="petId">
						<?php
							//SELECT query to grab pet IDs and names for select options.
							if(!($stmt = $mysqli->prepare("SELECT pet.id, pet.name FROM pet 
													INNER JOIN userPets ON pet.id = userPets.pid
													INNER JOIN user ON userPets.uid = user.id WHERE user.id = ?")))
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							//Binds values from the post data to query values
							if (!($stmt->bind_param("s", $_POST['userID'])))
								echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
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


					<label><input class="button" name="deletePet" type="submit" /></label>
				</fieldset>


			</form>
		</div>




		<p><a href='index.php'>Change User</a></p>






	</body>


</html>
