<?php
    #INIZIO SESSIONE
	include_once("common.php");
    $cookie = username_cookie(); #setto il cookie per l'username
	if (isset($_REQUEST["name"]) && isset($_REQUEST["password"])) 
    {
  		$name = $_REQUEST["name"];
  		$password = $_REQUEST["password"];
        
        if (is_password_correct($name, $password)) #controllo che username e password siano corretti
        {
            if (isset($_SESSION)) #se esiste già una sessione la distruggo e la rigenero
            { 
                session_destroy();
                session_regenerate_id(TRUE);
                session_start();
            }
            $_SESSION["name"] = $name;
            redirect("index.php", "Login successful! Welcome back $cookie!"); #LOGIN SUCCESSFUL
        }else 
        {
            redirect("index.php", "Incorrect user name and/or password"); #ERROR IN LOGIN
        } 
    }
?>
