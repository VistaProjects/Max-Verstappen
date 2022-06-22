<?php
	$servername = "localhost";
	$username = "maxverstappen";
	$password = "CbfyQv2e6x7hTw^f";
	$dbname = "maxverstappen";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

	$result = $conn->query("SELECT * FROM tb_agenda_max");
	$request_meetup = $conn->query("SELECT * FROM tb_agenda_max");
	$totaal = $conn->query("SELECT * FROM tb_request");


	if(!$request_meetup || !totaal || !result)
	{
		echo mysqli_error($conn);
		die();
	}

	$counter = 0;
	while($row = $totaal->fetch_assoc()) {
		$counter++;
	}


	//Frontend
	if(isset($_GET['naam']))
	{
		if ($counter >= 10){
			die("Max 10 slots");
		}
		$naam = $_GET['naam'];
		$achternaam = $_GET['achternaam'];
		$email = $_GET['email'];
		$phone = $_GET['phone'];
		$location = $_GET['locatie'];
		$text = $_GET['text'];
		$date = date("d-m-Y");
		$conn->query("INSERT INTO `tb_request` (`id`, `request_date`, `text`, `email`, `first_name`, `last_name`, `phonenumber`, `location`) VALUES (NULL, '$date', '$text', '$email', '$naam', '$achternaam', '$phone', '$location')");

		header("Location: bestelling.php?naam=" . $naam . '&datum=' . $date);
	}
?>

<!DOCTYPE html>
<html lang="NL">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Max verstappen</title>
	<style>
		body {
			margin: 0;
			padding-top: 0%;
			height: 100%;
			background-color: #000;
		}

		* {
			margin: 0;
			padding: 0px;
		}

		#svg {
			filter: invert(100%)
		}
		.landing-page {
			height: 50%;
			background: linear-gradient(to top, #ff7b0085, #fa91077a), url("max.png") no-repeat top center;
			filter: sepia(50%);
			filter: saturate(2);
			text-align: center;
			line-height: 25vh;
			background-repeat: no-repeat;
			background-position: center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;

		}

		@font-face {
			font-family: myFirstFont;
			src: url(Cabin-Medium.ttf);
		}

		.h1 {
			font-family: myFirstFont;
			font-size: 500%;
			color: rgba(189, 3, 3, 0.726);
			text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
		}

		.h2 {
			font-family: myFirstFont;
			font-size: 500%;
			color: rgb(255, 255, 255);
			text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
		}

		.h3 {
			font-family: myFirstFont;
			font-size: 500%;
			color: royalblue;
			text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
		}

		.main-page {
			text-align: center;
			background: url("MaxVerstappenF1 1.png");
			text-align: center;
			background-repeat: no-repeat;
			background-position: center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}


		.modal-header2 {
			padding: 2px 16px;
			background-color: #2c2c2c;
			color: orange;
			border-color: black;
			border-radius: 5px;
			border-width: 5px;
		}

		/* Modal Body */
		.modal-body2 {
			padding: 2px 16px;
		}

		.modal2{
			bottom: 500px;
		}
		/* Modal Content */
		.modal-content2 {
			color: rgb(255, 255, 255);

			position: relative;
			background: #111B32;
			border: 3px solid #FF0000;
			box-sizing: border-box;
			border-radius: 25px;
			margin: auto;
			padding: 0;
			width: 50%;
			height: auto;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			animation-name: animatetop;
			animation-duration: 0.4s;
		}

		/* Add Animation */
		@keyframes animatetop {
			from {
				opacity: 0
			}

			to {
				opacity: 1
			}
		}

		#mid {
			padding: 12px;
			margin-bottom: -16px;
			font-size: 21px;
			font-weight: 200;
			line-height: 2.1428571435;
			color: aliceblue;

		}

		pre {
			padding: 12px;
			margin-bottom: -16px;
			font-size: 21px;
			font-weight: 200;
			line-height: 1.5;
			color: aliceblue;

		}

		html {
			scroll-behavior: smooth;
		}

		button {
			display: inline-block;
			padding: 0.35em 1.2em;
			border: 0.1em solid #FFFFFF;
			margin: 0 0.3em 0.3em 0;
			border-radius: 0.12em;
			box-sizing: border-box;
			text-decoration: none;
			font-family: 'Roboto', sans-serif;
			font-weight: 300;
			color: #FFFFFF;
			text-align: center;
			transition: all 0.2s;
						color: black;
		}

		.button2 {
			color: black;
			display: inline-block;
			padding: 0.35em 1.2em;
			border: 0.1em solid #FFFFFF;
			margin: 0 0.3em 0.3em 0;
			border-radius: 0.12em;
			box-sizing: border-box;
			text-decoration: none;
			font-family: 'Roboto', sans-serif;
			font-weight: 300;

			text-align: center;
			transition: all 0.2s;
		}

		@media all and (max-width:30em) {
			button {
				display: block;
				margin: 0.4em auto;
			}
		}

		form {
			margin:0;
		}
	</style>
</head>

<body>
	<div class="landing-page">
		<h1 class="h1">Max Verstappen</h1>
		<h2 class="h2">Meet And Greet</h2>
		<h3 class="h3">
			<?php
			while($row = $result->fetch_assoc()) {
				echo(sprintf('%s   ', $row["location_meetup"], $row["location_meetup"]));
			}
			?>
		</h3>
		<a href="#mid"><img border="0" src="arrow.png" width="150" height="93" id="svg"></a>
	</div>
	<div class="main-page"id="mid">
		
		<pre>
Dit is het moment om Max Verstappen te kunnen ontmoeten!
Tijdstip: 10:00 tot en met 16:00
Dagen: 21 maart tot en met 27 maart.
Boek uw ticket nu het nog kan... voor maar 60 euro per dag!</pre>
		<a href="contactpage.html">
			<button>Contact Ons</button>
		</a>
		<a href="https://youtu.be/9zqpikKsWj0">
			<button>Lucky winner</button>
		</a>
		<?php
			echo('<h2 style="text-decoration: underline">Maximaal meet-ups: ' . $counter . ' / 10</h2>');
			if ($counter >= 10){
				$disabled = 'disabled';
			}
			else
			{
				$disabled = '';
			}

		?>
		<div id="appointment_content" class="modal2">
			<div class="modal-content2">
				<h3>Afspraak Plannen</h3>

				<?php
					if ($disabled == 'disabled'){
						echo('<label style="text-decoration: underline">UITVERKOCHT!</label><br>');
					}
					else
					{
						?>
							<div class="modal-body2">
								<form action="index.php">
									<label>Contact informatie:</label><br>
									<input type="text" required="required" name="naam" placeholder="Voornaam"><br>
									<input type="text" required="required" name="achternaam" placeholder="Achternaam"><br>
									<input type="email" required="required" name="email" placeholder="email@example.com"><br>
									<input type="tel" required="required" name="phone" placeholder="06123456789"><br>
									<textarea style="resize: none" rows="6" cols="50" type="text" required="required" name="text" placeholder="Motievatie text"></textarea><br>

									<label>Locatie:</label>
									<select name="locatie" id="locatie">
										<?php
											// output data of each row
											while($row = $request_meetup->fetch_assoc()) {
												echo(sprintf('<option value="%s">%s - %s</option>', $row["location_meetup"], $row["location_meetup"], $row["meetup_date"]));
											}
										echo('</select>');
										echo(sprintf('<input type="submit" value="Submit" class="button2" %s>', $disabled));
										?>
									<br>
								</form>
							</div>
						<?php
					}
				?>
			</div>
		</div>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	</div>
	<pre>© Copyright Max Verstappen BV.</pre>
</body>
</html>