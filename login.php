<?php
	
	die();//=>dispaly_errors?

	if(!empty($_POST)){
		// email en password opvragen
		$email = $_POST['email'];
		$password = $_POST['password'];

		//hash opvragen, op basis van email
		$conn = new PDO("mysql:host=localhost;dbname=netflix;", "root", "root", null);
		

		// check of rehash van password gelijk is aan hash uit db
		$statement = $conn->prepare("SELECT * from users where email = :email");
		$statement->bindParam(":email", $email);
		$result = $statement->execute();

		$user = $result->fetch(PDO::FETCH_ASSOC);



		if( password_verify($password, $user['password'])){
		// ja -> login

			echo "OK!";
			session_start();
			$_SESSION['userid'] = $user['id'];
			header('Location:index.php');

		}else{
		// nee -> error
			echo "Email or password is wrong, try again.";
		}

	}

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>IMDFlix</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="netflixLogin">
		<div class="form form--login">
			<form action="" method="post">
				<h2 form__title>Sign In</h2>

				<?php if (isset($error)): ?>
				<div class="form__error">
					<p>
						Sorry, we can't log you in with that email address and password. Can you try again?
					</p>
				</div>
				<?php endif; ?>

				<div class="form__field">
					<label for="Email">Email</label>
					<input type="text" name="email">
				</div>
				<div class="form__field">
					<label for="Password">Password</label>
					<input type="password" name="password">
				</div>

				<div class="form__field">
					<input type="submit" value="Sign in" class="btn btn--primary">	
					<input type="checkbox" id="rememberMe"><label for="rememberMe" class="label__inline">Remember me</label>
				</div>

				<div>
					<p>No account yet?<a href="register.php">Sign up here</a></p>
				</div>
			</form>
		</div>
	</div>
</body>
</html>