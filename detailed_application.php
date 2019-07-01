<?php
	session_start();
	include_once 'head.php';
    include_once 'Models/connection.php';
	if(!isset($_SESSION['u_id']) or $_SESSION['designation']!='admin'){
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
					<button class="btn btn-light " type="submit" name="all_users">show all user</button>
				</form>
			</div>
			<div>
				<form class="form-inline" action="view_all_applications.php" method="POST">
					<button class="btn btn-light active" type="submit" name="all_applications">show all pending applications</button>
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



	<?php
	if(isset($_POST['show_details']) ){
		$appli_id = $_POST['application_id'];
		$sql = "select * from application where application_id='$appli_id'";
		$result=mysqli_query($Connection, $sql);
		if($result){
			$row=mysqli_fetch_assoc($result);
			$sql2 = "select * from user where aadhaar_no = ".$row['aadhaar_no'].";";
			$result2= mysqli_query($Connection, $sql2);
			if($result2){
				$row2=mysqli_fetch_assoc($result2);

				echo "
				<div class='container'>
					<h5>Applicant's Aadhaar number: ".$row['aadhaar_no']."<h5>
					
					<h5>Bill Amount:".$row['bill_amount']."<h5>
					
					<h5>Designation:".$row2['designation']."<h5>
				</div>
				<div class='container'>
					<form method='POST' action='detailed_application.php'>
						<input type='hidden' name='application_id' value=".$appli_id.">
						<button class='btn btn-dark' type='submit' name='accept'>Accept</button>
					</form>
					<form method='POST' action='detailed_application.php'>
						<input type='hidden' name='application_id' value=".$appli_id.">
						<button class='btn btn-dark' type='submit' name='reject'>Reject</button>
					</form>
				</div>
				<embed src='file: ///opt/lampp/htdocs/SSPL/pdfs/".$row['aadhaar_no']."/application_no".$appli_id.".pdf'
				style='height: 50%; width: 50%;'>
				";
			}


		}
		
	}

	if(isset($_POST['accept'])){
		$application_id=$_POST['application_id'];
		$sql="update  application set status='Accepted' where status='Pending' and application_id='$application_id';";
		$result=mysqli_query($Connection,$sql);
		
		echo'
			<div class="container" align="center">
			<h5>Application Accepted successfully!!<h5>
			<form method="POST" action="view_all_applications.php">
				<button class="btn btn-dark" type="submit" name="all_applications">OK</button>
			</form>
			</div>
		';
	}

	if(isset($_POST['reject'])){
		$application_id=$_POST['application_id'];
		$sql="update application set status='Rejected' where status='Pending' and application_id='$application_id'";
		$result=mysqli_query($Connection,$sql);
		

		echo"
			<div class='container' align='center'>
			<h5>Application Rejected successfully!!<h5>
			<form method='POST' action='view_all_applications.php'>
				<button class='btn btn-dark' type='submit' name='all_applications'>OK</button>
			</form>
			</div>
		";
	}
	