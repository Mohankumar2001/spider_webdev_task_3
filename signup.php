<?php
  require "header.php";
?>


<main>
	<h1>signup</h1>
	<form action="includes/signup.inc.php" method="post">
		<input type="text" name="username" placeholder="username">
		<input type="text" name="mail" placeholder="email">
		<input type="password" name="pwd" placeholder="password">
		<input type="password" name="pwd" placeholder="password">
	</form>
</main>


<?php
  require "footer.php";
?>