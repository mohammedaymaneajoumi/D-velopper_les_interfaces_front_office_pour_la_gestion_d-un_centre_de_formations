<?php

include "connectDB.php"; //connect db//

session_start(); // start the session//

//from name of the inputs//
if(isset($_POST['btnlogin'])){
	$email = $_POST['email'];
    $password = $_POST['password'];

	$query = "select * FROM apprenant WHERE email_apprenant = '$email' AND mot_de_passe_apprenant = '$password'";
	// execute the SQL query and take 2 parametres//
	$result = mysqli_query($conn, $query);
	//returns an integer retrieve the number of rows returned by a SELECT statement and take result parametres//
	// mysqli_num_rows() should only be used with SELECT statements, as it does not work with INSERT, UPDATE, DELETE//
    if ($result && mysqli_num_rows($result) > 0) {

		 //fetch a single row from the result set returned by a SELECT statement (select * FROM apprenant) //and take result parametres//
		$user = mysqli_fetch_assoc($result);

		// store the user details in the sessions//
		$_SESSION['user_email'] = $user['email_apprenant'];
		$_SESSION['user_pass'] = $user['mot_de_passe_apprenant'];
		//
		$_SESSION['id_apprenant'] = $user['id_apprenant'];


        header('Location: Session-apprenant/index.php'); 
        exit();

    } else {
        $error = "Invalid username or password"; 
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
</head>

<body class="my-login-page">



	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="img/logo.jpg" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<?php 
							//returns a boolean value (true or false) //
							if (isset($error)) { ?>
								<p>
									<?php echo $error; ?>
								</p>
							<?php } ?>
							<form method="POST" class="my-login-validation" novalidate="">
							<!--------------------------------------------------->
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password
										<a href="forgot.html" class="float-right">
											Forgot Password?
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
									<div class="invalid-feedback">
										Password is required
									</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Remember Me</label>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block" name="btnlogin">
										Login
									</button>
								</div>
								<div class="mt-4 text-center">
									Don't have an account? <a href="register.php">Create One</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2017 &mdash; LearnIt.
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
