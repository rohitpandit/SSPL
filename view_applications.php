<?php
	session_start();
	include_once 'head.php';
	if(!isset($_SESSION['u_id']) or $_SESSION['designation']=='admin'){
    	header('Location:login.php');
    	exit();
    }
?>

<nav class="navbar navbar-default bg-dark">
	  <div class="container-fluid">
	  	
	    <div>
   			<form  class="form-inline" method="POST" action="view_applications.php">
				<button class="btn btn-light active" type="submit" name="view" >View applications</button>
			</form>
	      </div>
	      <div>
	      	<form class="form-inline" method="POST" action="apply_application.php	">
				<button class="btn btn-light" type="submit" name="apply_application" >Apply applications</button>
			</form>
	      </div>
	      <div>
	      	<form class="form-inline" method="POST" action="Models/logout.php">
				<button class="btn btn-light" type="submit" name="logout">logout</button>
			</form>
	      </div>
	    
	  </div>
	</nav>
	<br>
	
<?php

    include_once 'Models/connection.php';
	if(isset($_POST['view']) ){

		
		
		echo '
		<div class="container">
		<form method="POST" action="view_applications.php">
			<input type="date" name="from" >
			<input type="date" name="till" > 
			<input class="btn btn-dark" type="submit" name="search" placeholder="search"> 
		</form>
		</div>
		';

		$aadhaar = $_SESSION['u_id'];



	    $sql="select * from application where aadhaar_no = '$aadhaar' order by date_entered DESC;";

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
						
					      <tr>
					        <td>'.$row["bill_type"].'</td>
					        <td>'.$row["bill_amount"].'</td>
					        <td>'.$row["status"].'</td>
					        
					      </tr>
						
					';

					
				
				}
				echo '
						</tbody>
					</table>
				</div>';
			}
			else{
                echo "No Result Found!";
			}
	    
  	}
  	if(isset($_POST['search'])){
  		$aadhaar = $_SESSION['u_id'];
        $from=$_POST['from'];
        $till=$_POST['till'];

        echo '

			<form method="POST" action="Models/logout.php">
				<button type="submit" name="logout">logout</button>
			</form>
        ';

	    $sql="select * from application where aadhaar_no = '$aadhaar' and date_entered between date_format('$from','%y-%m-%d') and date_format('$till', '%y-%m-%d') order by date_entered DESC;";

	    $result=mysqli_query($Connection,$sql);

			if($result){
				while($row=mysqli_fetch_assoc($result)){
					echo '
						<div >'.$row["date_entered"].'</div>
						<div>'.$row["bill_type"].'</div>
						<div>'.$row["bill_amount"].'</div>
						<div>'.$row["status"].'</div>
						'
					;
					
				}
			}else{
				echo "No Result Found!!";
          
			}
  	}
?>

