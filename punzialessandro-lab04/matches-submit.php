<?php include("top.html"); ?>

<?php
/* funzione per controllare se le stringhe contengono almeno una lettera uguale */
	function strCtl($str1, $str2)
	{
		for ($i=0; $i < 4 ; $i++) 
		{ 
			if($str1[$i] == $str2[$i])
			{
				return 1;
			}
		}
		return 0;
	}

/* processamento della richiesta get che ottiene il nome passato attraverso la query string memorizzandola nella variabile name*/

	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$name = $_GET["name"];
	}
?>
	<h1> Matches for <?= $name ?> </h1>
<?php
	
	$text = file("singles.txt");

/* ciclo per cercare la riga del file di testo che corrisponde al nome passato dalla query string */
	for ($i=0; $i < count($text) && strcmp($name, $nam) != 0; $i++) 
	{ 
		str_replace("\n", ",", $text[$i]);
		list($nam, $gen, $age, $pers, $os, $agemin, $agemax, $fgen) = explode(",",$text[$i]);
	}

/* ciclo per cercare la riga di testo dell'utente che corrisponde alle specifiche del match */
	for ($i=0; $i < count($text); $i++) 
	{ 
		str_replace("\n", ",", $text[$i]);
		list($m_nam, $m_gen, $m_age, $m_pers, $m_os, $m_agemin, $m_agemax, $m_fgen) = explode(",",$text[$i]);
				
		if(strcmp($fgen,"B") == 1 || strcmp($fgen, $m_gen) == 1)
		{

			if(((int)$m_age >= (int)$agemin) && ((int)$m_age <= (int)$agemax))
			{
				if(strcmp($os, $m_os) == 0)
				{
					if(strCtl($pers,$m_pers) == 1)
					{
?>
						<div>
							<p class="match"><img class="match" src="http://www.cs.washington.edu/education/courses/cse190m/12sp/homework/4/user.jpg" alt="user profile"> <?= $m_nam ?> </p>
							<ul class="match"> 
								<li> gender: <?= $m_gen ?> </li>
								<li> age: <?= $m_age ?> </li>
								<li> type: <?= $m_pers ?> </li>
								<li> OS: <?= $m_os ?> </li>
							</ul>
						</div>
						
<?php
					}  
				}
			}
		}
	}


?>

<?php include("bottom.html"); ?>