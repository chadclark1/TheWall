<?php session_start();
	
	require_once('new-connection.php');

	// var_dump($_POST); die();

	function post_comment(){

		$comment = escape_this_string($_POST['comment']);
		$user = $_SESSION['user_id'];
		$message = $_POST['message-id'];
		$query = "INSERT INTO comments (message_id, user_id, comment, created_at, updated_at) 
     			VALUES ('{$message}', '{$user}', '{$comment}', NOW(), NOW())";

     	// echo $query; die();

     	run_mysql_query($query);
	}

	if(isset($_POST['action']) /*&& $_POST['action'] == "message"*/){

		if(empty($_POST['comment'])){
			
			array_push($_SESSION['errors'], "Please write a comment");
			header('Location: profile.php');

		}

		if (empty($_SESSION['errors'])){

		  	// $_SESSION['first_name'] = $_POST['first_name'];
		  	// $_SESSION['logged_in'] = TRUE;

			post_comment();
			header('Location: profile.php');
		}



	}
?>

