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
					<button class="btn btn-light active" type="submit" name="all_expenditure">show total expenditure</button>
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
	if(isset($_POST['all_expenditure']) ){

		
				
		echo '<div class="container">
				<form method="POST" action="view_all_expenditure.php">
					<input type="date" name="from" >
					<input type="date" name="till" > 
					<input class="btn btn-dark" type="submit" name="search" placeholder="search"> 
				</form>
			</div>
		';


	    $sql="select * from application where status = 'Accepted' order by date_entered ;";
	    $total_cost=0;

	    $result=mysqli_query($Connection,$sql);

			if(mysqli_num_rows($result)>0){
				echo '
				<div class="container">
					<table class="table">
						<thead>
						  <tr>
						    <th>Bill number</th>
						    <th>Amount Reimbursed</th>
						    

						  </tr>
						</thead>
						<tbody>
	  
				';

				while($row=mysqli_fetch_assoc($result)){
					echo '
						
					      <tr>
					        <td>'.$row["application_id"].'</td>
					        <td>'.$row["amount_reimbursed"].'</td>
					     
					      </tr>
						
					';
					$total_cost = $total_cost + $row['amount_reimbursed'];
				}
				echo '
						</tbody>
					</table>
				</div>';
						
				echo "
				<div class='container'>
				<h5>Total cost incurred in reimbursement is:".$total_cost."<h5>
				</div>
				";

			}else{
                echo "
                <div class='container'>
                <h5>No Result Found!</h5>
                </div>
                ";
			}
	    
  	}

  	
  	if(isset($_POST['search'])){
  		$aadhaar = $_SESSION['u_id'];
        $from=$_POST['from'];
        $till=$_POST['till'];

        
	    $sql="select * from application where date_entered between date_format('$from','%y-%m-%d') and date_format('$till', '%y-%m-%d') order by date_entered ;";

	    $total_cost=0;

	    $result=mysqli_query($Connection,$sql);

			if(mysqli_num_rows($result)>0){
				echo '
				<div class="container">
					<table class="table">
						<thead>
						  <tr>
						    <th>Bill number</th>
						    <th>Amount Reimbursed</th>
						    

						  </tr>
						</thead>
						<tbody>
	  
				';

				while($row=mysqli_fetch_assoc($result)){
					echo '
						
					      <tr>
					        <td>'.$row["application_id"].'</td>
					        <td>'.$row["amount_reimbursed"].'</td>
					     
					      </tr>
						
					';
					$total_cost = $total_cost + $row['amount_reimbursed'];
				}
				echo '
						</tbody>
					</table>
				</div>';
						
				echo "
				<div class='container'>
				<h5>Total cost incurred in reimbursement is:".$total_cost."<h5>
				</div>
				";

			}else{
                echo "
                <div class='container'>
                <h5>No Result Found!</h5>
                </div>
                ";
            }
	    
  	}


  	
