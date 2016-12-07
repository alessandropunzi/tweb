<?php
	include_once("common.php"); 
	ensure_logged_in(); #controllo che l'utente sia loggato
	include("top.php");

	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$firstname = $_GET["firstname"];
		$lastname = $_GET["lastname"];
	}
        #query per cercare i film che l'attore digitato ha fatto con Kevin Bacon
		$id = search_id($firstname, $lastname);
		$query = "SELECT name,year 
				  FROM actors AS A1 JOIN roles AS R1 ON A1.id = R1.actor_id JOIN movies ON movie_id = movies.id 
				  JOIN roles AS R2 ON movies.id = R2.movie_id JOIN actors AS A2 ON R2.actor_id=A2.id 
				  WHERE A1.first_name = 'Kevin' AND A1.last_name = 'Bacon' AND A2.id = $id 
				  ORDER BY year DESC,name;";
		$rows = perform_query($query);
?>

<h1>Result for <?= $firstname ?> <?= $lastname ?> </h1>

<?php 

		if (numrows($rows) > 0) #se la query restituisce qualche riga stampo i risultati altrimenti stampo un messaggio d'errore
		{
?>
<p id="films"> Films whith  <?= $name ?> <?= $surname ?> and Kevin Bacon </p>

<?php
		print_table($rows); #stampo i risultati della query

		}else
		{
?>
			<p><?= $firstname ?> <?= $lastname ?> wasn't in any films with Kevin Bacon.</p>
<?php
		}

include("bottom.html"); 

?>