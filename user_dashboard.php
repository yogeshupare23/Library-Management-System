<?php
session_start();
function get_user_issue_book_count()
{
	include 'admin/db_connect.php';
	//$connection = mysqli_connect("localhost","root","");
	//$db = mysqli_select_db($connection,"lms");

	$user_issue_book_count = 0;
	$query = "select count(book_no) as user_issue_book_count from issued_books where student_id = $_SESSION[id]";
	$query_run = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_assoc($query_run)) {
		$user_issue_book_count = $row['user_issue_book_count'];
	}
	return ($user_issue_book_count);
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>User Dashboard</title>
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
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">Library Management System(LMS)</a>
			</div>
			<font style="color: white"><span><strong>Welcome:
						<?php echo $_SESSION['name']; ?>
					</strong></span></font>
			<font style="color: white"><span><strong>Email:
						<?php echo $_SESSION['email']; ?>
					</strong></span></font>
			<ul class="nav navbar-nav navbar-right">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown"><b>My Profile</b></a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="view_profile.php">View Profile</a>

						<a class="dropdown-item" href="change_password.php">Change Password</a>
					</div>
				</li>
				<li class="nav-item"><a class="nav-link" href="logout.php"><b>Logout</b></a></li>
			</ul>
		</div>
	</nav>

	<div class="container-fluid mt-3">
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-danger">
					<marquee><b>Balbhim Art's,Commerce & Science Colleage, Beed.</b> Library opens at 8:00 AM and close
						at
						8:00 PM
					</marquee>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 mt-3">
				<div class="card bg-light">
					<div class="card-header"><strong>Issued Books</strong></div>
					<div class="card-body">
						<p class="card-text">No. of Issued Books:
							<?php echo get_user_issue_book_count(); ?>
						</p>
						<a href="view_issued_book.php" class="btn btn-info" target="_blank">View Issued Books</a>
					</div>
				</div>
			</div>

		</div>
</body>

</html>