<?php session_start();
	
	require_once('new-connection.php');


?>
<!DOCTYPE html>
<html>
<head>
	<title>The Wall</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">

</head>

	<body>

		<h1>The Wall</h1>
		
		<div class="content">

			<div class="col-md-4 col-md-offset-4 text-center errors">
				
				<?php 
				if(isset($_SESSION['errors'])){
					echo "<h3>Error:</h3>";
					foreach ($_SESSION['errors'] as $error) {
						echo $error . "<br>";
					}
				}
				unset($_SESSION['errors']); 
				?>
			</div>



			<row>
				<div class="col-md-5 col-md-offset-1">
					<h3 id="enter-address">Register</h3>
					<form action="process.php" method="post">
						<fieldset class="form-group">
						    <label for="first_name">First Name:</label>
						    <input type="text" name ="first_name" class="form-control" id="first_name" placeholder="First Name">
						</fieldset>
						<fieldset class="form-group">
						    <label for="last_name">Last Name:</label>
						    <input type="text" name ="last_name" class="form-control" id="last_name" placeholder="Last Name">
						</fieldset>
						<fieldset class="form-group">
						    <label for="email">Email:</label>
						    <input type="text" name ="email" class="form-control" id="email" placeholder="Email">
						</fieldset>
						<fieldset class="form-group">
						    <label for="email">Password:</label>
						    <input type="password" name ="password" class="form-control" id="email">
						</fieldset>
						<input type="hidden" name="action" value="register">
						<button type="submit" class="btn btn-primary">Register</button>
					</form>
				</div>
			</row>

			<row>
				<div class="col-md-5">
					<h3 id="enter-address">Login</h3>
					<form action="process.php" method="post">
						<fieldset class="form-group">
						    <label for="email">Email:</label>
						    <input type="text" name ="email" class="form-control" id="email" placeholder="Email">
						</fieldset>
						<fieldset class="form-group">
						    <label for="email">Password:</label>
						    <input type="password" name ="password" class="form-control" id="email">
						</fieldset>
						<input type="hidden" name="action" value="login">
						<button type="submit" class="btn btn-primary">Login</button>
					</form>
				</div>
			</row>

		</div>
	</body>

</html>