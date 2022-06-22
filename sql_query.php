<?php
	$servername = "localhost";
	$username = "root";
	$password = "vistasql123";
	$dbname = "maxverstappen";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

	if(isset($_GET['location']))
	{
		$location = $_GET['location'];
		$date = $_GET['date'];

		$conn->query("INSERT INTO `tb_agenda_max`(`id`, `location_meetup`, `meetup_date`) VALUES ('', '$location', '$date')");
		echo("INSERT INTO `tb_agenda_max`(`id`, `location_meetup`, `meetup_date`) VALUES ('', '$location', '$date')");	
	}

	if(isset($_GET['delete']))
	{
		$location = $_GET['delete'];

		$conn->query("DELETE FROM `tb_agenda_max` WHERE `tb_agenda_max`.`location_meetup` = '$location'");
		echo("DELETE FROM `tb_agenda_max` WHERE `tb_agenda_max`.`location_meetup` = '$location'");
	}
?>