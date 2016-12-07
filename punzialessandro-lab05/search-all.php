<?php
	include_once("common.php"); 
	ensure_logged_in(); #controllo che l'utente sia loggato
	include("top.php");

	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$firstname = $_GET["firstname"];
		$lastname = $_GET["lastname"];
	}
        #query per cercare i film dell'attore digitato dall'utente
		$id = search_id($firstname, $lastname);
		$query = "SELECT name,year 
				  FROM actors JOIN roles ON actors.id = actor_id JOIN movies ON movie_id = movies.id  
				  WHERE actors.id='$id' 
				  ORDER BY year DESC, name ASC;";
		$rows = perform_query($query);
?>

<h1>Result for <?= $firstname ?> <?= $lastname ?> </h1>

<?php 

		if (numrows($rows) > 0) #se la query restituisce qualche riga stampo i risultati altrimenti stampo un messaggio d'errore
		{
?>
<p id="films"> All Films </p>

<?php
		print_table($rows); #stampo i risultati della query

		}else
		{
?>
			<p>Actor <?= $firstname ?> <?= $lastname ?> not found.</p>
<?php
		}

include("bottom.html"); 

?>