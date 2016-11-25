<?php include("top.html"); ?>

<form action="signup-submit.php" method="post">
	<fieldset>
		<legend>New User Signup:</legend>

		<!-- campo per inserire il nome  -->
		<label class="left"> Name: </label> <input type="text" name="name" size="16" /> <br>

		<!-- campo per inserire il sesso  -->
		<label class="left"> Gender: </label>
			<input type="radio" name="gender" value="M" /> Male
			<input type="radio" name="gender" value="F" /> Female <br>

		<!-- campo per inserire l'età  -->
		<label class="left"> Age: </label> <input type="text" name="age" size="6" maxlength="2"/> <br> 

		<!-- campo per inserire la personalità  -->
		<label class="left"> Personality type: </label> <input type="text" name="personality" size="6" maxlength="4"/> (<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">Don't know your type?</a>) <br>

		<!-- campo per inserire il sistema operativo utilizzato  -->
		<label class="left"> Favorite OS: </label> 
		<select name="os">
				<option value="Windows"> Windows </option>
				<option value="Macos"> Mac OS X </option>
				<option value="Linux" selected="selected"> Linux </option>
		</select> <br>

		<!-- campo per inserire il range dell'età prefibile -->
		<label class="left"> Seeking age: </label> <input type="text" name="minage" size="6" maxlength="2" value="min" /> to <input type="text" name="maxage" size="6" maxlength="2" value="max" /> <br>

		<!-- campo per inserire il sesso preferibile  -->
		<label class="left"> Favorite Gender: </label> 
		<select name="favgender">
				<option value="male"> Male </option>
				<option value="female"> Female </option>
				<option value="both" selected="selected"> Both </option>
		</select> <br>
		
		<!-- bottone per inviare le informazioni del form con post a signup-submit.php  -->
		<input type="submit" value="Sign Up"> <br>

	</fieldset>
</form> 

<?php include("bottom.html"); ?>