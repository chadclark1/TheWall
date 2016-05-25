<?php session_start();
	
	require_once('new-connection.php');

	if(!isset($_SESSION['errors'])){
		$_SESSION['errors'] = array();
	}


		// var_dump($_SESSION['errors']);
		// die();


	function register(){

		$first_name = escape_this_string($_POST['first_name']);
		$last_name = escape_this_string($_POST['last_name']);
		$email = escape_this_string($_POST['email']);
		$password = escape_this_string($_POST['password']);
		$salt = bin2hex(openssl_random_pseudo_bytes(22));
		$encrypted_password = md5($password . '' . $salt);
		$query = "INSERT INTO users (first_name, last_name, email, password, salt, created_at, updated_at) 
     		VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$encrypted_password}', '{$salt}', NOW(), NOW())";

     	// echo $query; die();

     	run_mysql_query($query);


	}


	function login(){

		$email = escape_this_string($_POST['email']);
		$password = escape_this_string($_POST['password']);
		$user_query = "SELECT * FROM users WHERE users.email = '{$email}'";
		$user = fetch_record($user_query);
		if(!empty($user))
			 {
				  $encrypted_password = md5($password . '' . $user['salt']);
				  if($user['password'] == $encrypted_password)
				  {
				   //this means we have a successful login!

				  	$_SESSION['user_id'] = $user['id'];
				  	$_SESSION['first_name'] = $user['first_name'];
				  	$_SESSION['logged_in'] = TRUE;
				  	// var_dump($_SESSION['first_name']); die();
				  }
				  else
				  {
				  array_push($_SESSION['errors'], "Invalid email or password (1)");
				  // var_dump($_SESSION['errors']);
					header('Location: index.php');
				  } 
			 }
			 else
			 {
			  //invalid email!
		 	 array_push($_SESSION['errors'], "Invalid email or password (2)");
				header('Location: index.php');
			 }

	}




	if(isset($_POST['action']) && $_POST['action'] == "register"){

		if(empty($_POST['first_name'])){
			
			array_push($_SESSION['errors'], "Please enter your first name");
			header('Location: index.php');
		}
		if(empty($_POST['last_name'])){
			
			array_push($_SESSION['errors'], "Please enter your last name");
			header('Location: index.php');
		}
		if(empty($_POST['email'])){
			
			array_push($_SESSION['errors'], "Please enter your email");
			header('Location: index.php');
		}
		if(empty($_POST['password'])){
			
			array_push($_SESSION['errors'], "Please enter a password");
			header('Location: index.php');
		}

		// var_dump($_POST);

		if (empty($_SESSION['errors'])){

			// $_SESSION['user_id'] = $user['id'];
		 //  	$_SESSION['first_name'] = $_POST['first_name'];
		  	$_SESSION['logged_in'] = TRUE;

			register();

			$email = escape_this_string($_POST['email']);
			$login_query = "SELECT * FROM users WHERE users.email = '{$email}'";
			$login_user = fetch_record($login_query);
			$_SESSION['user_id'] = $login_user['id'];
			$_SESSION['first_name'] = $login_user['first_name'];


			header('Location: profile.php');
		}
	}



	else if(isset($_POST['action']) && $_POST['action'] == "login"){
		
		if(empty($_POST['email'])){
			
			array_push($_SESSION['errors'], "Please enter your email");
			header('Location: index.php');
		}
		if(empty($_POST['password'])){
			
			array_push($_SESSION['errors'], "Please enter a password");
			header('Location: index.php');
		}

		// var_dump($_SESSION['errors']);

		if (empty($_SESSION['errors'])){
			login();
			header('Location: profile.php');
		}

		
	}

	else {
		session_destroy();
		header('Location: index.php');
	}


	/* LOGIN AND REGISTER END */



	/* POST MESSAGE BEGIN */


	function post_message(){

		$message = escape_this_string($_POST['message']);
		$user = $_SESSION['user_id'];
		$query = "INSERT INTO messages (user_id, message, created_at, updated_at) 
     			VALUES ('{$user}', '{$message}', NOW(), NOW())";

     	// echo $query; die();

     	run_mysql_query($query);
	}

	if(isset($_POST['action']) && $_POST['action'] == "message"){

		if(empty($_POST['message'])){
			
			array_push($_SESSION['errors'], "Please write a message");
			header('Location: profile.php');

		}

		if (empty($_SESSION['errors'])){

		  	// $_SESSION['first_name'] = $_POST['first_name'];
		  	// $_SESSION['logged_in'] = TRUE;

			post_message();
			header('Location: profile.php');
		}



	}




?>