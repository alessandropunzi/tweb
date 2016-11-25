<?php include("top.html"); ?>

<!-- form per cercare il match attraverso il nome dell'utente passando la richiesta a matches-submit.php attrraverso una query string   -->
<form action="matches-submit.php?name= <?= $name ?>" method="get">
	<fieldset class="column">
		<legend> Returning User: </legend>
			<label class="left"> Name: </label> <input type="text" name="name" size="16" /> <br>
		<input type="submit" value="View My Matches"> <br>
	</fieldset>
</form>

<?php include("bottom.html"); ?>