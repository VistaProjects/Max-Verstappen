<?php session_start();

	//DATABASE
	$servername = "localhost";
	$username = "maxverstappen";
	$password = "CbfyQv2e6x7hTw^f";
	$dbname = "maxverstappen";

	$URL = 'backend.php';
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

	$result = $conn->query("SELECT * FROM tb_agenda_max");
	$delete_agenda = $conn->query("SELECT * FROM tb_agenda_max");
	$request_meetup = $conn->query("SELECT * FROM tb_request");
	$remove_meetup = $conn->query("SELECT * FROM tb_request");
	//DATABASE

	$login_username = 'max';
	$login_password = 'verstappen';

	$random1 = 'ajaldjaldkadkljadlkjrgh0rgh0d8hg0d98hg';
	
	$hash = md5($random1.$login_password); 


	if(isset($_GET['logout']))
	{
		unset($_SESSION['login']);
		header("Location: backend.php");
	}

	if (isset($_SESSION['login']) && $_SESSION['login'] == $hash) {?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Backend</title>
		</head>
			<a href="?logout=true">Logout.</a>
			<h1>Back-end</h1>

			<form action="<?php echo($URL); ?>">
				<label>Nieuwe meetup:</label><br><br>
				<input type="text" required="required" name="location" placeholder="Amsterdam"><br><br>
				<input type="text" required="required" name="date" placeholder="31-12-2022" pattern="[0-9]{2}-[0-9]{2}-([0-9]{4})"><br><br>
				<input type="submit" value="Submit">
			</form>
			<hr>
			<br>
			<h1>Delete</h1>
			<form action="<?php echo($URL); ?>">
				<label>Delete meetup location:</label><br><br>
				<select name="delete">
					<?php
						// output data of each row
						while($row = $delete_agenda->fetch_assoc()) {
							echo(sprintf('<option value="%s">%s - %s</option>', $row["id"], $row["location_meetup"], $row["meetup_date"]));
						}
					?>
				</select>
				<input type="submit" value="Delete">
			</form>
			<hr>
			<h1>Lijst</h1>
				<?php
					// output data of each row
					while($row = $remove_meetup->fetch_assoc()) {
						echo(sprintf('
						<form action="%s">
							<pre>Naam: %s %s</pre>
							<pre>Email:%s</pre>
							<pre>Telefoon: %s Locatie: %s</pre>
							<pre>Datum: %s</pre>
							<pre>Motievatie: %s</pre> 
							<button name="remove" type="submit" value="%s">Remove</button><br><br>
						</form><hr>', $URL, $row["first_name"], $row["last_name"], $row["email"], $row["phonenumber"], $row["location"], $row["request_date"], $row["text"], $row["id"]));
					}
				?>
			<br>
		</body>
		</html>
				
	<?php
	}

	else if (isset($_POST['submit'])) {
		
		if ($_POST['password'] == $login_password && $_POST['username'] == $login_username) {
			//IF USERNAME AND PASSWORD ARE CORRECT SET THE LOG-IN SESSION
			$_SESSION["login"] = $hash;
			header("Location: $_SERVER[PHP_SELF]");
		} 
		else 
		{
			//IF PASSWORD IS NOT == PASSWORD GO TO LOGIN PAGE
			display_login_form();
		}
	}	
	else 
	{
		display_login_form();
	}



function display_login_form(){ ?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Login</title>
		</head>
		<body>
			<form action="<?php echo $self; ?>" method='post'>
				<input type="username" name="username" id="username" placeholder= "username"><br><br>
				<input type="password" name="password" id="password" placeholder= "password"><br><br>
				<input type="submit" name="submit" value="submit">
			</form>
		</body>
	</html>
<?php 
} 
	if(isset($_GET['location'])) {
		$location = $_GET['location'];
		$date = $_GET['date'];

		$conn->query("INSERT INTO `tb_agenda_max`(`id`, `location_meetup`, `meetup_date`) VALUES ('', '$location', '$date')");
		header('Location: backend.php');
		// echo("INSERT INTO `tb_agenda_max`(`id`, `location_meetup`, `meetup_date`) VALUES ('', '$location', '$date')");
	}

	if(isset($_GET['delete'])) {
		$id = $_GET['delete'];
		$conn->query("DELETE FROM `tb_agenda_max` WHERE `tb_agenda_max`.`id` = '$id'");
		header('Location: backend.php');
		// echo("DELETE FROM `tb_agenda_max` WHERE `tb_agenda_max`.`location_meetup` = '$id'");
	}

	if(isset($_GET['remove'])) {
		$id = $_GET['remove'];
		$conn->query("DELETE FROM `tb_request` WHERE `tb_request`.`id` = '$id'");
		header('Location: backend.php');
		// echo("DELETE FROM `tb_request` WHERE `tb_request`.`id` = '$id'");
	}
?>