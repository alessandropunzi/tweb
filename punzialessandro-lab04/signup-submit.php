<?php include("top.html"); ?>

<!-- processamento della richiesta post per ottenere le informazioni inviate dal form e inserirle all'interno di variabili  -->
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$name = $_POST["name"];
		$gender = $_POST["gender"];
		$age = $_POST["age"];
		$personality = $_POST["personality"];
		$os = $_POST["os"];
		$minage = $_POST["minage"];
		$maxage = $_POST["maxage"];
		$favgender = $_POST["favgender"];
	}
	
/* scrittura della riga con le variabili separate da virgola al fondo del file */
	$text = "$name,$gender,$age,$personality,$os,$minage,$maxage,$favgender";
	file_put_contents("singles.txt",$text, FILE_APPEND);

?>
	<h1> Thank you! </h1>
	<p> Welcome to NerdLuv, <?= $name ?>!</p>
	<p> Now <a href="matches.php">log in to see your matches! </a></p>

<?php include("bottom.html"); ?>