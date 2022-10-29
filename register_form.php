<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){
    
   $email = mysqli_real_escape_string($conn, $_POST['usermail']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   $select = " SELECT * FROM tb_user WHERE email = '$email' && password = '$pass'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'E-mail exist déjà';
   }else{
      if($pass != $cpass){
         $error[] = 'Mot de passe pas conforme!';
      }else{
         $insert = "INSERT INTO tb_user(email, password) VALUES('$email','$pass')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Inscription</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>

<body>
	<div class="container infinity-container">
		<div class="row">
			<div class="col-md-1 infinity-left-space"></div>
			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 text-center infinity-form">
				<div class="text-center mb-4">
					<h4>Inscription</h4>
				</div>
						<?php
					if(isset($error)){
						foreach($error as $error){
						echo '<span class="error-msg">'.$error.'</span>';
						}
					}
				        ?>
				<form class="px-3" action="" method="POST">
					<div class="form-input">
						<span><i class="fa fa-envelope"></i></span>
						<input type="email" name="usermail" placeholder="Email" tabindex="10" required>
					</div>
					<div class="form-input">
						<span><i class="fa fa-lock"></i></span>
						<input type="password" name="password" placeholder="Mot de passe" required>
					</div>
					<div class="form-input">
						<span><i class="fa fa-lock"></i></span>
						<input type="password" name="cpassword" placeholder="Confirmation du mot de passe" required>
					</div>
					<div class="mb-3">
						<button type="submit" name="submit" class="btn btn-block">inscription</button>
					</div>
					<div class="text-center mb-5" style="color: #777;">Déjà un compte?
						<a class="login-link" href="login_form.php">connexion</a>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>

</html>