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
				<form class="form-inline " action="view_all_users.php" method="POST">
					<button class="btn btn-light active" type="submit" name="all_users">show all user</button>
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

	<div class="container">
		<form method="POST" action="view_all_users.php">
			<input type="text" name="aadhaar_no" placeholder="Aadhaar Number">
			<button class="btn btn-dark" type="submit" name="search_user">Search</button>
		</form>
	</div>

	<?php 
		if(isset($_POST['all_users'])){
			$sql="select * from user where designation <> 'admin';";
			$result=mysqli_query($Connection,$sql);
			if($result){
				echo '
				<div class="container">
					<table class="table">
						<thead>
						  <tr>
						    <th>Aadhaar Number</th>
						    <th>Designation</th>
						    <th>Delete</th>
						  </tr>
						</thead>
						<tbody>
	  
				';
				while($row=mysqli_fetch_assoc($result)){
					echo '
						<form method="POST" action="Models/delete_user_handle.php">
					      <tr>
					        <td>'.$row["aadhaar_no"].'</td>
					        <td>'.$row["designation"].'</td>
					        <input name="aadhaar" type="hidden" value='.$row['aadhaar_no'].'></input>
					        <td><button  class="btn btn-dark" type="submit" name="remove">delete user</button></td>
					      </tr>
						</form>
					';
				}
				echo '
						</tbody>
					</table>
				</div>';
			}
		}


		if(isset($_POST['search_user'])){
			$aadhaar = $_POST['aadhaar_no'];
			$sql = "select * from user where aadhaar_no = '$aadhaar';";
			$result=mysqli_query($Connection,$sql);
			if($result){
				echo '
				<div class="container">

					<table class="table">
						<thead>
						  <tr>
						    <th>Aadhaar Number</th>
						    <th>Designation</th>
						    <th>Delete</th>
						  </tr>
						</thead>
						<tbody>
	  
				';
				if(mysqli_num_rows($result)===0){
					echo'
						<div class="container">
							<h5>No user found!<h5>
						</div>
					';

				}

				while($row=mysqli_fetch_assoc($result)){
					echo '
						<form method="POST" action="Models/delete_user_handle.php">
					      <tr>
					        <td>'.$row["aadhaar_no"].'</td>
					        <td>'.$row["designation"].'</td>
					        <input name="aadhaar" type="hidden" value='.$row['aadhaar_no'].'></input>
					        <td><button  class="btn btn-dark" type="submit" name="remove">delete user</button></td>
					      </tr>
						</form>
					';
				}
				echo '
						</tbody>
					</table>
				</div>';
			}
			
		}	
	?>

