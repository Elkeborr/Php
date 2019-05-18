<?php

//Connectie klasses
include_once 'bootstrap.php';

if (!empty($_POST['submit'])) {
    // checked of alle velden leeg zijn of niet,als er 1 leeg is kan men niet  registreren
    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['firstname'])
    || empty($_POST['lastname']) || empty($_POST['username'])) {
        $error = true;
        if (!empty($_SESSION['error']['message'])) {
            $error = $_SESSION['error']['message'];
            unset($_SESSION['error']);
        }
    } else {
        // Gegevens in de classe user steken
        $user = new  User();
        $user->setEmail(htmlspecialchars($_POST['email']));
        $user->setPassword(htmlspecialchars($_POST['password']));
        $user->setFirstName(htmlspecialchars($_POST['firstname']));
        $user->setLastName(htmlspecialchars($_POST['lastname']));
        $user->setUserName(htmlspecialchars($_POST['username']));

        if ($user->register()) {
            $_SESSION['email'] = $email;
            header('Location:index.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'includes/head.inc.php'; ?>
    <title>Register</title>
</head>
<body>
<div class="container--login">
		<div class="wrap">
		
		<div class="foto--register"> </div>
		<div class="form--register">
		
	
			<form action="" method="post">
				<h2 form__title>Sign up for an account</h2>

				<?php if (isset($error)): ?>
                <div class="form__error">
					<p> Something is missing in the form, pleas fill everything in </p>
				</div>
				<?php endif; ?>

				<div class="email__error">
			        <p id="email_error"></p>
                </div>

				<div class="form__field">
					<label for="email">Email</label>
					<input type="text" id="email" name="email" value="<?php if (isset($_POST['email'])) {
    echo htmlspecialchars($_POST['email']);
}?>">
                </div>
                <div class="form__field">
					<label for="firstname">Firstname</label>
					<input type="text" id="firstname" name="firstname" value="<?php if (isset($_POST['firstname'])) {
    echo htmlspecialchars($_POST['firstname']);
}?>">
                </div>
                <div class="form__field">
					<label for="lastname">Lastname</label>
					<input type="text" id="lastname" name="lastname"value="<?php if (isset($_POST['lastname'])) {
    echo htmlspecialchars($_POST['lastname']);
}?>">
                </div>

                <div class="username__error">
			        <p id="username_error"></p>
                </div>
                
                <div class="form__field">
					<label for="username">Username</label>
					<input type="text" id="username" name="username" value="<?php if (isset($_POST['username'])) {
    echo htmlspecialchars($_POST['username']);
}?>">
				</div>
				<div class="form__field">
					<label for="password">Password</label>
					<input type="password" id="password" name="password">
				</div>

                

				<div class="form__btn">
					<input type="submit" name="submit" value="Sign me up!" >	
				</div>
			</form>
			<div class="link"> 
			<p> <a href="login.php"> Back to login</a></p>
</div>
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
        } else if (res.status == "copy"){
			$("#email_error").html(res.message);
		}else if (res.status == "success"){
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

