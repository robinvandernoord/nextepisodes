<?php

require_once 'includes/main.php';


/*--------------------------------------------------
	Handle visits with a login token. If it is
	valid, log the person in.
---------------------------------------------------*/


if(isset($_GET['tkn'])){

	// Is this a valid login token?
	$user = User::findByToken($_GET['tkn']);

	if($user){

		// Yes! Login the user and redirect to the protected page.

		$user->login();
		redirect('protected.php');
	}

	// Invalid token. Redirect back to the login form.
	redirect('index.php');
}



/*--------------------------------------------------
	Handle logging out of the system. The logout
	link in protected.php leads here.
---------------------------------------------------*/


if(isset($_GET['logout'])){

	$user = new User();

	if($user->loggedIn()){
		$user->logout();
	}

	redirect('index.php');
}


/*--------------------------------------------------
	Don't show the login page to already
	logged-in users.
---------------------------------------------------*/


$user = new User();

if($user->loggedIn()){
	redirect('protected.php');
}



/*--------------------------------------------------
	Handle submitting the login form via AJAX
---------------------------------------------------*/


try{

	if(!empty($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

		// Output a JSON header

		header('Content-type: application/json');

		// Is the email address valid?

		if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			throw new Exception('


');
		}

		// This will throw an exception if the person is above
		// the allowed login attempt limits (see functions.php for more):
		rate_limit($_SERVER['REMOTE_ADDR']);

		// Record this login attempt
		rate_limit_tick($_SERVER['REMOTE_ADDR'], $_POST['email']);

		// Send the message to the user

		$message = '';
		$email = $_POST['email'];
		$subject = 'Your Login Link';

		if(!User::exists($email)){
			$subject = "Thank You For Registering!";
			$message = "Thank you for registering at our site!\n\n";
		}

		// Attempt to login or register the person
		$user = User::loginOrRegister($_POST['email']);


		$message.= "You can login from this URL:\n";
		$message.= get_page_url()."?tkn=".$user->generateToken()."\n\n";

		$message.= "The link is going expire automatically after 10 minutes.";

		$result = send_email($fromEmail, $_POST['email'], $subject, $message);

		if(!$result){
			throw new Exception("There was an error sending your email. Please try again.");
		}

		die(json_encode(array(
			'message' => 'Thank you! We\'ve sent a link to your inbox. Check your spam folder as well.'
		)));
	}
}
catch(Exception $e){

	die(json_encode(array(
		'error'=>1,
		'message' => $e->getMessage()
	)));
}

/*--------------------------------------------------
	Output the login form
---------------------------------------------------*/

?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8"/>
		<title>Next Episodes Login</title>

		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

		<!-- The main CSS file -->
		<link href="assets/css/style.css" rel="stylesheet" />

		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<script>
	function redirect(){
		window.location = "http://robinvandernoord.github.io/nextepisodes/myshows"

	}
	</script>
	<body>

		<form id="login-register" method="post" action="index.php">

			<h1>Login or Register</h1>

			<input style="display:block" type="text" placeholder="your@email.com" name="email" autofocus />
			<p>Enter your email address above and we will send <br />you a login link.</p>
<div id="wrapper" float: right;>
			<button style="float:left" type="submit">Login / Register</button><button style="float: right;" onclick="redirect()">Skip login</button>
</div>


			<span><br><br><br><br><br><br><br><br><br><br><br><br></span>

		</form>



		<!-- JavaScript Includes -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="assets/js/script.js"></script>

	</body>
</html>
