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
	if(isset($_POST['all_applications']) ){
		
		echo '

			<div class="container">
				<form method="POST" action="view_all_applications.php">
					<input type="date" name="from" >
					<input type="date" name="till" > 
					<input class="btn btn-dark" type="submit" name="search" placeholder="search"> 
				</form>
			</div>
			<div class="container">
				<form method="POST" action="view_all_applications.php">
					<button class="btn btn-dark" type="submit" name="accept_all">Accept All</button>
				</form>
			</div>
		';

	    $sql="select * from application where status = 'Pending' order by date_entered ;";

	    $result=mysqli_query($Connection,$sql);

			if(mysqli_num_rows($result)>0){
				echo '
				<div class="container">
					<table class="table">
						<thead>
						  <tr>
						    <th>Bill Type</th>
						    <th>Bill Amount</th>
						    <th>Status</th>

						  </tr>
						</thead>
						<tbody>
	  
				';

				while($row=mysqli_fetch_assoc($result)){
					echo '
						<form method="POST" action="detailed_application.php">
					      <tr>
					        <td>'.$row["bill_type"].'</td>
					        <td>'.$row["bill_amount"].'</td>
					        <td>'.$row["status"].'</td>
					        <input name="application_id" type="hidden" value='.$row['application_id'].'></input>
					        <td><button  class="btn btn-dark" type="submit" name="show_details">Show Details</button></td>
					      </tr>
						</form>
					';

					
				
				}
				echo '
						</tbody>
					</table>
				</div>';
			}
		
			else{
                echo '
                	<div class="container">
                		<h5>No Pending Applications</h5>
                	</div>

                ';
			}
	    
  	}



  	if(isset($_POST['search'])){
  		$aadhaar = $_SESSION['u_id'];
        $from=$_POST['from'];
        $till=$_POST['till'];

        echo '
			<div class="container">
				<form method="POST" action="view_all_applications.php">
					<input type="hidden" name="from" value='.$from.'>
					<input type="hidden" name="till" value='.$till.'>
					<button class="btn btn-dark" type="submit" name="accept_all_selected">Accept All selected </button>
				</form>
			</div>
		';
		


	    $sql="select * from application where date_entered between date_format('$from','%y-%m-%d') and date_format('$till', '%y-%m-%d') order by date_entered ;";

	    $result=mysqli_query($Connection,$sql);

			if(mysqli_num_rows($result)>0){
				echo '
				<div class="container">
					<table class="table">
						<thead>
						  <tr>
						    <th>Bill Type</th>
						    <th>Bill Amount</th>
						    <th>Status</th>

						  </tr>
						</thead>
						<tbody>
	  
				';

				while($row=mysqli_fetch_assoc($result)){
					echo '
						<form method="POST" action="detailed_application.php">
					      <tr>
					        <td>'.$row["bill_type"].'</td>
					        <td>'.$row["bill_amount"].'</td>
					        <td>'.$row["status"].'</td>
					        <input name="application_id" type="hidden" value='.$row['application_id'].'></input>
					        <td><button  class="btn btn-dark" type="submit" name="show_details">Show Details</button></td>
					      </tr>
						</form>
					';

					
				
				}
				echo '
						</tbody>
					</table>
				</div>';
			}
			else{
				echo '
					<div class="container">
						<h5>No Result Found</h5>
					</h5>
				';
			}
  	}




  	if(isset($_POST['accept_all'])){
  		$sql="select * from application order by date_entered ;";

	    $result=mysqli_query($Connection,$sql);

			if(mysqli_num_rows($result)){
				while($row=mysqli_fetch_assoc($result)){
					$sql2 = "update  application set status='Accepted' where status='Pending' and application_id=".$row['application_id'].";";
					$result2 =mysqli_query($Connection, $sql2);
					
				}
			}


		echo'
			<div class="container" align="center">
			<h5>All Application Accepted successfully!!<h5>
			<form method="POST" action="view_all_applications.php">
				<button class="btn btn-dark" type="submit" name="all_applications">OK</button>
			</form>
			</div>
		';
		
  	}





  	if(isset($_POST['accept_all_selected'])){
  		$from = $_POST['from'];
  		$till = $_POST['till'];
  		$sql="select * from application where date_entered between date_format('$from','%y-%m-%d') and date_format('$till', '%y-%m-%d') order by date_entered ;";

	    $result=mysqli_query($Connection,$sql);

			if($result){
				while($row=mysqli_fetch_assoc($result)){
					$sql2 = "update  application set status='Accepted' where status='Pending' and application_id=".$row['application_id'].";";
					$result2 =mysqli_query($Connection, $sql2);
					
				}
			}


		echo'
			<div class="container" align="center">
			<h5>Selected Application Accepted successfully!!<h5>
			<form method="POST" action="view_all_applications.php">
				<button class="btn btn-dark" type="submit" name="all_applications">OK</button>
			</form>
			</div>
		';		
  	}


