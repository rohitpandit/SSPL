<?php
	session_start();
	include_once 'head.php';
    include_once 'Models/connection.php';
    if(!isset($_SESSION['u_id']) or $_SESSION['designation']!="admin"){
    	header('Location:login.php');
    	exit();
    }
?>

<body>
	<div class="navbar navbar-default bg-dark">
		<div class="container-fluid">
				    
			<div>
				<form class="form-inline" action="create_user.php" method="POST">
					<button class="btn btn-light" type="submit" name="create_user">Create User</button>
				</form>
			</div>
			<div>
				<form class="form-inline" action="view_all_users.php" method="POST">
					<button class="btn btn-light" type="submit" name="all_users">show all user</button>
				</form>
			</div>
			<div>
				<form class="form-inline" action="view_all_applications.php" method="POST">
					<button class="btn btn-light" type="submit" name="all_applications">show all pending applications</button>
				</form>
			</div>
			<div>
				<form class="form-inline" action="view_all_expenditure.php" method="POST">
					<button class="btn btn-light" type="submit" name="all_expenditure">show total expenditure</button>
				</form>
			</div>
			<div align="right">
				<form class="form-inline" method="POST" action="Models/logout.php">
					<button class="btn btn-light" type="submit" name="logout">logout</button>
				</form>
			</div>
		</div>
	</div>
	<br>

	<div class="container" align="center">
		<h4 >Welcome Admin!</h4>
		<h5>Select form the above menu!</h5>
	</div>
	
</body>
