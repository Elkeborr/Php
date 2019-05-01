


<form method="POST" action="changeEmail.php">
   Old email: <input type="email" name="oldemail"><br/>
   New email: <input type="email" name="newemail"><br/>
   Repeat new email: <input type="email" name="repeatNewemail"><br/>
   <input type="submit" value="wijzig" name="submit">
</form>



<?php
 if(!empty($_POST)){
		// email en password opvragen
		$oldemail = $_POST['oldemail'];
		$newemail = $_POST['newemail'];

		//hash opvragen, op basis van email
		$conn = new PDO("mysql:host=localhost;dbname=project_php;", "root", "root", null);
		

		// check of rehash van password gelijk is aan hash uit db
		$statement = $conn->prepare("SELECT * FROM users WHERE email='".$newemail."'");
		$result = $statement->execute();

		$user = $statement -> fetch(PDO::FETCH_ASSOC);

		if( password_verify($newemail, $user['email'])){
			$error = true;


		}else{
      session_start();
			$_SESSION['email'] = $newemail;
			header('Location:profiel.php');

        }}
        
        ?>
