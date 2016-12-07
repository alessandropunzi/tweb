<?php if (!isset($_SESSION)) session_start(); 

#funzione per effettuare delle query sul db
function perform_query($query) 
{
    try 
    {
		$db = new PDO("mysql:dbname=imdb;host=127.0.0.1", "root", "282802029595");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  	$rows = $db->query($query);
	  	return $rows;
  	} catch (PDOException $ex) 
  	{
?>
  	<p>Sorry, a database error occurred. Please try again later.</p>
	<p>(Error details: <?= $ex->getMessage() ?>)</p>
 <?php
  	return NULL;
	}
}

#funzione per cercare l'id dell'attore che ha girato un numero di film maggiore e che ha id minore tra quelli con lo stesso nome 
function search_id($firstname, $lastname)
{
	$firstname = trim($firstname);
	$lastname = trim($lastname);
	$query = ("SELECT id FROM actors WHERE first_name LIKE '$firstname%' AND last_name = '$lastname' ORDER BY film_count DESC,id ASC LIMIT 1;");
	$id = perform_query($query);
	foreach($id as $row)
	{
		$id = $row["id"];
	}
	return $id;
}

#funzione per contare il numero di righe risultato della query
function numrows($rows)
{
	return $count = $rows->rowCount();
}

#funzione per stampare il risultato della query 
function print_table($rows) 
{
?>
	<table cellspacing=0>
 	<tr class="evenline"> <td> <strong> # </strong> <td class="centercolumn"> <strong> Title </strong> </td> <td> <strong> Year </strong> </td> </tr>
 	<?php 
 		$i = 1;
		foreach($rows as $row) 
		{
			if($i % 2 != 0)	
			{	
 	?>
 			<tr class="oddline"><td> <?= $i ?> </td> <td class="centercolumn"> <?= $row["name"] ?> </td> <td> <?= $row["year"] ?> </td></tr>
 	<?php
			}else
			{
	?>
 			<tr class="evenline"><td> <?= $i ?> </td> <td class="centercolumn"> <?= $row["name"] ?> </td> <td> <?= $row["year"] ?> </td></tr>
	<?php
			}
			$i = $i + 1;
		}
	?>
	</table>

<?php
}

#funzione che controlla se un utente è loggato,in caso contrario redirige l'utente all'index stampando un messaggio flash
function ensure_logged_in() 
{
	if (!isset($_SESSION["name"])) 
	{
    	redirect("index.php", "You must log in before you can view that page.");
	} 
}

#funzione che redirige l'utente su una pagina stampando un messaggio flash
function redirect($url, $flash_message = NULL) 
{
	if ($flash_message) 
	{
    	$_SESSION["flash"] = $flash_message;
  	}
  	
  	header("Location: $url"); # session_write_close();
	die; 
}

#funzione che controlla che name e password siano corretti
function is_password_correct($name, $password) 
{
	$name = trim($name);
	$password = trim($password);
	$query = ("SELECT password FROM users WHERE username = '$name';");
	$rows = perform_query($query);
	if ($rows) 
	{
	    foreach ($rows as $row) 
	    {
	    	$correct_password = $row["password"];
	      	return $password === $correct_password;
	    }
	}else 
    {
		return FALSE;   # user not found
	} 
}

#funzione per settare un cookie che memorizza informazioni sull'username digitato in fase di login
function username_cookie()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = $_POST["name"];
        setcookie("username",$username);
        if (isset($_COOKIE["username"])) 
        {
            $cookie = $_COOKIE["username"];
        }
	}
    return $cookie;
}
?>



