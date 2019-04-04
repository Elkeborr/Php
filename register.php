<?php 

//Connectie klasses
include_once("bootstrap.php");


if ( !empty($_POST) ){

		// Gegevens in de classe user steken
		$user = new User ();
		$user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setFirstName($_POST['firstname']);
        $user->setLastName($_POST['lastname']);
        $user->setUserName($_POST['username']);
        $user->setPasswordConformation($_POST['password_confirmation']);

    		
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registreer</title>
</head>
<body>
<div class="form form--login">
            <?php if (isset($error)): ?>
				<div class="form__error">
					<p>
						Sorry, something went wrong! Try again later
					</p>
				</div>
            <?php endif; ?>
                

			<form action="" method="post">
                <h2 form__title>Sign up for an account</h2>
                
                <div class="email__error">
			        <p id="email__error"></p>
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

                <div class="email__error">
			        <p id="username__error"></p>
                </div>
                

                <div class="form__field">
					<label for="username">Username</label>
					<input type="text" id="username" name="username">
				</div>
				<div class="form__field">
					<label for="password">Password</label>
					<input type="password" id="password" name="password">
				</div>

                <div class="form__field">
					<label for="password_confirmation">Confirm your password</label>
					<input type="password" id="password_confirmation" name="password_confirmation">
				</div>

				<div class="form__field">
					<input type="submit" value="Sign me up!" class="btn btn--primary">	
				</div>
			</form>
		</div>
	</div>
</body>
</html>



<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>

//Email- validation
$("#email").on("keyup", (e)=> {
	let text = $("#email").val();
	$.ajax({
	    method: "POST",
		url: "ajax/emailval.php",
		data: {text: text},
		dataType: 'json'
		})
  		.done((res) =>  {
		if(res.status == "Mistake"){
		$("#email_error").html(res.message);
    }
    		
});
		e.preventDefault();

});

//Username- validation
$("#username").on("keyup", (e)=> {
	let text = $("#username").val();
	$.ajax({
	    method: "POST",
		url: "ajax/usernameval.php",
		data: {name: name},
		dataType: 'json'
		})
  		.done((res) =>  {
		if(res.status == "auwtch"){
		$("#username_error").html(res.message);
        }else {
        $("#username_error").html();
    }
    		
});
		e.preventDefault();

});

</script>

