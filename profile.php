<?php session_start();
	
	require_once('new-connection.php');

	$message_query = "SELECT *
					FROM messages";

	$message_logs = fetch_all($message_query);

	// var_dump($message_logs);

	$comment_query = "SELECT *
					FROM comments";

	$comment_logs = fetch_all($comment_query);

	// var_dump($comment_logs);


?>

<!DOCTYPE html>
<html>
<head>
	<title>The Wall</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

	<header>
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="#">
		        CodingDojo Wall
		      </a>

		    </div>
		    <div class="logout">
				<a href="index.php" class="navbar-right btn btn-primary">LOG OUT</a>
			</div>
		  </div>
		</nav>
	</header>
	<div class="container">

	Hello <?php echo $_SESSION['first_name'] . " " . "(" .$_SESSION['user_id'] . ")";?>

		<div class="col-md-10 col-md-offset-1 post-message">
			<h3>Post a message:</h3>
					
			<form action="process.php" method="post">
				<fieldset class="form-group">
				    <textarea rows="5" name ="message" class="form-control" id="message" placeholder="Enter message here..."></textarea>
				</fieldset>
				<input type="hidden" name="action" value="message">
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
				
		</div>


		<div class="col-md-8 col-md-offset-2 messages">
			<?php 
				foreach ($message_logs as $key => $value) {
				?>
				<div class="message">
					<div class="message-box">
				<?php 
				$get_user = $value['user_id'];
				$get_user_query = "SELECT *
								FROM users
								WHERE users.id = $get_user";
				$user_logs = fetch_record($get_user_query);
				echo $user_logs['first_name']. " " . $user_logs['last_name'];


				?>
				<h4>Message:</h4>
					<?php	
						$message_id = $value['id'];
						echo $value['message'] . "<br>";

						?>
						<div class="date text-right">
						<?php
						echo $value['created_at']  . "<br>";		
					?>	

						
						</div>
					</div>
							<div class="col-md-10 col-md-offset-2 text-left comments">
								
								
								<?php 
									foreach ($comment_logs as $key => $value) {
										$comment_id = $value['id'];
										$comment_message_id = $value['message_id'];
										if($comment_message_id == $message_id){
									?>
									<div class="comment">
									<?php 
									$get_user = $value['user_id'];
									$get_user_query = "SELECT *
													FROM users
													WHERE users.id = $get_user";
									$user_logs = fetch_record($get_user_query);
									echo $user_logs['first_name']. " " . $user_logs['last_name'];


									?>
									<h5>Comment:</h5>
										<?php	
											
											echo $value['comment'] . "<br>";

											?>
											<div class="date text-right">
											<?php
											echo $value['created_at']  . "<br>";		
										
										?>	
											</div>
										
									</div>
									<?php } ?>
									<?php
									}

								?>
								
							</div>

						<div>
						<h5>Post a comment:</h5>
							<form action="comment-process.php" method="post" class="comment-form">
								<fieldset class="form-group">
								    <textarea rows="3" name ="comment" class="form-control" id="comment" placeholder="Enter comment here..."></textarea>
								</fieldset>
								<input type="hidden" name="message-id" value="<?php echo $message_id?>">
								<input type="hidden" name="action" value="comment">
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</div>




				</div>
				<?php
				}

			?>
		</div>



	</div>


	<?php




	echo "Hello " . $_SESSION['first_name'] . " user ID: " . $_SESSION['user_id'] . "!";

	// unset($_SESSION['user_id']);
	// unset($_SESSION['first_name']);
	// unset($_SESSION['logged_in']);

?>



	
</body>
</html>
<?php 

	// $all_query = "SELECT *
	// 				FROM users";

	// $all_users = fetch_all($all_query);


	// var_dump($all_users);

?>