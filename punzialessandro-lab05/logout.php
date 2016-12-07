<?php 
    #FINE SESSIONE
	include_once("common.php");
	session_destroy();
	session_regenerate_id(TRUE); #flush della sessione precedente
	session_start();
	redirect("index.php", "Logout successful."); #Logout effettuato con successo, redirezione all'index.
?>