<?php 
    if (isset($_SESSION["name"])) #se esiste già una sessione per quell'utente mostro il logout
    { 
?>
		<form id="logout" action="logout.php" method="post">
            You are logged in as <?= $_SESSION["name"] ?>
            <input type="submit" value="Log out" />
            <input type="hidden" name="logout" value="true" />
        </form>
<?php 
    } else  #se non esiste una sessione per quell'utente mostro il login
    { 
?>
        <form id="login" action="login.php" method="post">
            Name <input type="text" size="14" name="name" />
            Password <input type="password" size="14" name="password" />
            <input type="submit" value="Log in" />
        </form>
<?php 
    } 
?>