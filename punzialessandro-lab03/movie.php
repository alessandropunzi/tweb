<!DOCTYPE html>
		<?php

/* getInfo per ottenere il titolo, anno e numero in percentuale della recensione*/
			function getInfo($filmname)
			{
				$lines = file("$filmname/info.txt",FILE_IGNORE_NEW_LINES);
				return $lines;
			}

/* getOverview per estrarre le informazioni da inserire nella sezione General Overview */
			function getOverview($filmname)
			{
				$text = file_get_contents("$filmname/overview.txt");
				$text = str_replace("\n",":",$text);
				$over = explode(":",$text);
				return $over;
			}

/* getReview per estrarre le recensioni dai file di testo*/
			function getReview($filmname)
			{
				$review = glob("$filmname/review*.txt");
				return $review;
			}
		?>
	<head>
		<title>Rancid Tomatoes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="movie.css" type="text/css" rel="stylesheet" />
		<link href="http://courses.cs.washington.edu/courses/cse190m/11sp/homework/2/rotten.gif" type="image/gif" rel="shortcut icon"/>
	</head>

	<body>

		<div id="ban">
			<div id="tomatoes">
				<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/banner.png" alt="Rancid Tomatoes" />
			</div>
		</div>
		<?php


			$movie = $_GET["film"]; /* memorizzo nella variabile movie il nome del film scritto nella query string*/
			list($title, $year, $rating) = getInfo($movie); /* inserisco i campi presenti nel file info.txt all'interno delle variabili titolo,anno, recensione*/
		?>
		<h1> <?= $title ?> (<?= $year ?>) </h1>

		<div id="global">
			<div id="rightbar">
				<div>
				
					<img src="<?= $movie ?>/overview.png" alt="general overview" />
				</div>

				<dl>
					<?php

/* ciclo per inserire le informazioni nella sezione General Overview*/

						$overview = getOverview($movie);
						for ($i=0; $i < count($overview); $i++) 
						{ 
							if($i %2 == 0)
							{
					?>
					<dt> <?= $overview[$i] ?> </dt>
					<?php
							}else
							{
					?>
					<dd> <?= $overview[$i] ?> </dd>
					<?php
							}	
						}
					?>
				</dl>
			</div>
			<div id="leftbar">
				<div id="bar">
					<?php

/* controllo sul rating: se è maggiore di 60 inserisco l'immagine freshbig*/
						if ($rating >= 60)
						{
							$var1 = "http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/freshbig.png";
							$var2 = "Fresh";
						}else
						{
							$var1 = "http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rottenbig.png";
							$var2 = "Rotten";
						}
					?>
					<img id="rotten" src= <?= $var1 ?> alt= <?= $var2 ?> />
					<?= $rating ?>%
				</div>
				<?php
				
/* ciclo per inserire le recensioni quelle pari a sinistra quelle dispari a destra e controllo sulle immagini rotten e fresh*/
					$reviews = getReview($movie);
					$length = count($reviews);
					$div = 2;
					$middle = $length / $div; 
					for ($i=0; $i < $length; $i++) 
					{ 
						$lines = file("$reviews[$i]",FILE_IGNORE_NEW_LINES);
						if(strcmp($lines[1], "ROTTEN") == 0)
						{
							$gif = "http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rotten.gif";
							$alt = "Rotten";
						}else
						{
							$gif = "http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/fresh.gif";
							$alt = "Fresh";
						}
						
						if($i % 2 == 0)
						{
				?>
					<div id="leftalign">
						<p class="quote">
							<img class="img" src= <?= $gif ?> alt= <?= $alt ?> />
							<q> <?= $lines[0] ?> </q>
						</p>
						<p class="critic">
							<img class="img" src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic"/>
							<?= $lines[2] ?> <br />
							<i> <?= $lines[3] ?> </i>
						</p>
					</div>
				<?php
						}else
						{
				?>
					<div id="rightalign">
						<p class="quote">
							<img class="img" src= <?= $gif ?> alt= <?= $alt ?> />
							<q> <?= $lines[0] ?> </p>
						<p class="critic">
							<img class="img" src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic" />
							<?= $lines[2] ?>  <br />
							<i> <?= $lines[3] ?> </i>
						</p>
					</div>
				<?php
						}
					}
				?>

			</div>
			<div id="bottombar">
					<p>(1- <?= $length ?>) of <?= $length ?></p>
			</div>
		</div>
		<div id="validators">
			<a href="ttp://validator.w3.org/check/referer"><img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/w3c-xhtml.png" alt="Validate HTML" /></a> <br />
			<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" /></a>
		</div>
	</body>
</html>
