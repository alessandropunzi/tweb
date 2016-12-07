<?php if (!isset($_SESSION)) session_start(); #crea una nuova sessione se non esite già ?>

<!DOCTYPE html>
<html>
	<!-- MFN0634 TWeb Lab05 (Kevin Bacon) -->
	<head>
		<title>My Movie Database (MyMDb)</title>
		<meta charset="utf-8" />
		
		<!-- Links to provided files.  Do not edit or remove these links -->
		<link href="http://www.cs.washington.edu/education/courses/cse190m/12sp/homework/5/favicon.png" type="image/png" rel="shortcut icon" />
		<link href="bacon.css" type="text/css" rel="stylesheet" />
		<script src="http://www.cs.washington.edu/education/courses/cse190m/12sp/homework/5/provided.js" type="text/javascript"></script>

		<!-- Link to your CSS file that you should edit -->
		<link href="bacon.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="frame">
			<div id="banner">
				<a href="index.php"><img src="http://www.cs.washington.edu/education/courses/cse190m/12sp/homework/5/mymdb.png" alt="banner logo" /></a>
				My Movie Database
				<?php
      				include("user.php"); #include i form per il login
    			?>
			</div>

			<div id="main">
				<?php
                    #mostra messaggi flash
    				if (isset($_SESSION["flash"])) 
                    {
  
     				?>
      					<div id="flash"> <?= $_SESSION["flash"] ?> </div>
      			<?php
      					unset($_SESSION["flash"]);
                    }
    			?>
				<!-- your HTML output follows -->
