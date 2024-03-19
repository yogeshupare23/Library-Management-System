<?php
include 'admin/db_connect.php';
session_start();
$user_found = false;
function showLoginStatus($user_found)
{
	if (isset ($_POST['login'])) {
		if (!$user_found) {
			echo '<div class="alert alert-danger mt-2" role="alert">
		Invalid username or password. Please try again.
		</div>';
		} else {
			echo '<div class="alert alert-success mt-2" role="alert">
		Logged in successfully.
		</div>';

		}
	}
}
if (isset ($_POST['login'])) {

	//$db = mysqli_select_db($connection,"lms");
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	//$query = "select email from users where email = '$_POST[email]'";
	$query = "SELECT email,name,id FROM users WHERE email = '$email' and password = '$password'";
	$query_run = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_assoc($query_run)) {
		if ($row['email'] == $email) {
			$count = mysqli_num_rows($query_run);
			if ($count == 1) {
				$_SESSION['name'] = $row['name'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['id'] = $row['id'];
				$_SESSION['role'] = "student";
				header("Location:user_dashboard.php");
			} else {
				$user_found = false;
			}
		} else {
			$user_found = false;
		}
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>LMS</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
	<style type="text/css">
		#side_bar {
			background-color: whitesmoke;
			padding: 50px;
			width: 300px;
			height: 450px;
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-info bg-light">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">Library Management System(LMS)</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li class="nav-item">
					<a class="nav-link" href="admin/index.php">Admin Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php">User Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="signup.php">Register</a>
				</li>
			</ul>
		</div>
	</nav><br>
	<span class="alert alert-info">
		<marquee><b>Balbhim Art's,Commerce & Science Colleage, Beed.</b> Library opens at 8:00 AM and close at 8:00 PM
		</marquee>
	</span><br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-5">
				<div class="card">
					<div class="card-header alert-info">
						Library Timing
					</div>
					<div class="card-body">


						<ul>
							<li>Opening Timing: 8:00 AM</li>
							<li>Closing Timing: 8:00 PM</li>
							<li>(Sunday off)</li>
						</ul>
					</div>
					<div class="card-header alert-info">
						What we provide ?
					</div>
					<div class="card-body">

						<ul>
							<li>Full furniture</li>
							<li>Free Wi-fi</li>
							<li>News Papers</li>
							<li>Discussion Room</li>
							<li>RO Water</li>
							<li>Peacefull Environment</li>
						</ul>
					</div>
				</div>

			</div>
			<div class="col-md-7" id="main_content">
				<div class="card bg-light">
					<div class="card-header alert-success">
						Student Login
					</div>
					<div class="card-body">

						<form action="" method="post">
							<div class="form-group">
								<label for="name">Email ID:</label>
								<input type="email" name="email" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="name">Password:</label>
								<input type="password" name="password" class="form-control" required>
							</div>
							<button type="submit" name="login" class="btn btn-primary">Login</button>
						</form>
						<?php showLoginStatus($user_found); ?>


					</div>
				</div>


			</div>
		</div>
	</div>
</body>

</html>