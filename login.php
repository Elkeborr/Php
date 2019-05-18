<?php
require_once 'bootstrap.php';

User::login();

?>
<!DOCTYPE html>
<html lang="en">
<head>

  	<title>Login</title>
	<?php include_once 'includes/head.inc.php'; ?>

</head>
<body>
	
	<div class="container--login">
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

		

				<div class="btn">
						<button class="form__btn">
							Login
						</button>
					</div>

				<div class="link">
					<p>No account yet? <a href="register.php">Sign up here</a></p>
				</div>
			</form>
		
		</div>
		<div class="foto--login"> </div>
	</div>
	</div>
</body>
</html>
