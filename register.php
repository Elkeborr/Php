<?php 

//Connectie klasses
include_once("bootstrap.php");

if (!empty($_POST['submit'])){
	// checked of alle velden leeg zijn of niet,als er 1 leeg is kan men niet  registreren
	if ( empty($_POST['email']) || empty($_POST['password']) || empty($_POST['firstname']) 
	|| empty($_POST['lastname'])|| empty($_POST['username'])){
		$error = true;
	}
	else {
		// Gegevens in de classe user steken
		$user = new User ();
		$user->setEmail($_POST['email']);
		$user->setPassword($_POST['password']);
		$user->setFirstName($_POST['firstname']);
		$user->setLastName($_POST['lastname']);
		$user->setUserName($_POST['username']);
	   
		$user->register();

		session_start();
			$_SESSION['userid'] = $user['id'];
			header('Location:index.php');
	}}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/login.css">
	<link rel="stylesheet" href="css/style.css">

    <title>Registreer</title>
</head>
<body>
<div class="container">
		<div class="wrap">
		
		<div class="foto--register"> </div>
		<div class="form--register">
		
	
			<form action="" method="post">
				<h2 form__title>Sign up for an account</h2>

				<?php if (isset($error)): ?>
                <div class="form__error">
					<p> Formulier bevat lege elementen, zorg dat alles ingevuld is</p>
				</div>
				<?php endif; ?>

				<div class="email__error">
			        <p id="email_error"></p>
                </div>

				<div class="form__field">
					<label for="email">Email</label>
					<input type="text" id="email" name="email">
                </div>
                <div class="form__field">
					<label for="firstname">Firstname</label>
					<input type="text" id="firstname" name="firstname">
                </div>
                <div class="form__field">
					<label for="lastname">Lastname</label>
					<input type="text" id="lastname" name="lastname">
                </div>

                <div class="username__error">
			        <p id="username_error"></p>
                </div>
                
                <div class="form__field">
					<label for="username">Username</label>
					<input type="text" id="username" name="username">
				</div>
				<div class="form__field">
					<label for="password">Password</label>
					<input type="password" id="password" name="password">
				</div>

                

				<div class="form__btn">
					<input type="submit" name="submit"value="Sign me up!" >	
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>



<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>

//Email- validation
$("#email").on("keyup", function (e){
	var text = $("#email").val();
	$.ajax({
	    method: "POST",
		url: "ajax/emailval.php",
		data: {text: text},
		dataType: 'json'
		})
  		.done((function (res)  {
		if(res.status == "mistake"){
        $("#email_error").html(res.message);
        }
    }));
    e.preventDefault();
        });
             
        
    

//Username- validation
$("#username").on("keyup", function (e) {
	var name = $("#username").val();
	$.ajax({
	    method: "POST",
		url: "ajax/usernameval.php",
		data: {name: name},
		dataType: 'json'
		})
  		.done((function (res)  {
		if(res.status == "auwtch"){
		$("#username_error").html(res.message);
        }else {
        $("#username_error").html();}
    
		  }));
    e.preventDefault();
        });



</script>

