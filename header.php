<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<header>
		<nav>
			<div>
				<form action="includes/login.inc.php" method="post">
					<input type="text" name="username" placeholder="nameuser..">
					<input type="password" name="password" placeholder="password..">
					
					<button type="submit" name="login-submit">login</button>
				</form>
				<a href="signup.php">signup</a>
				<form action="includes/logout.inc.php">
					
					<button type="submit" name="logout-submit">logout</button>
				</form>
			</div>
		</nav>
	</header>

</body>
</html>