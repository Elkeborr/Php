<?php

	if(!empty($_POST)){
		// email en password opvragen
		$email = $_POST['email'];
		$password = $_POST['password'];

		//hash opvragen, op basis van email
		$conn = new PDO("mysql:host=localhost;dbname=project_php;", "root", "root", null);
		

		// check of rehash van password gelijk is aan hash uit db
		$statement = $conn->prepare("SELECT * from users where email = :email");
		$statement->bindParam(":email", $email);
		$result = $statement->execute();

		$user = $statement -> fetch(PDO::FETCH_ASSOC);

		if( password_verify($password, $user['password'])){
		// ja -> login
			session_start();
			$_SESSION['email'] = $user['email'];
			header('Location:index.php');

		}else{
		// nee -> error
			$error = true;
		}

	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  	<meta charset="UTF-8">
  	<title>Login</title>
  	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/login.css">

</head>
<body>
	
	<div class="container">
		<div class="wrap">
		<div class="form--login">
			<form action="" method="post">
				<h2 class="form__title">Sign In</h2>

				<?php if (isset($error)): ?>
				<div class="form__error">
					<p>
						Sorry, we can't log you in with that email address or password. Can you try again?
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

				<div class="box">
				<div class="form__checkbox">
					<input type="checkbox" id="rememberMe">
					<label for="rememberMe" class="label__inline">Remember me</label>
				</div>
				<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
				</div>

				<div class="btn">
						<button class="form__btn">
							Login
						</button>
					</div>






				<div>
					<p>No account yet?<a href="register.php">Sign up here</a></p>
				</div>
			</form>
		
		</div>
		<div class="foto--login"> </div>
	</div>
	</div>
</body>
</html>
