<?php

	session_start();
	include_once 'head.php';
    include_once 'Models/connection.php';
    if(!isset($_SESSION['u_id']) and $_SESSION['designation']!='admin'){
    	header('Location:login.php');
    	exit();
    }
?>	
<body>
<nav class="navbar navbar-default bg-dark">
	  <div class="container-fluid">
	  	
	    <div>
   			<form  class="form-inline" method="POST" action="view_applications.php">
				<button class="btn btn-light" type="submit" name="view" >View applications</button>
			</form>
	      </div>
	      <div>
	      	<form class="form-inline" method="POST" action="apply_application.php	">
				<button class="btn btn-light active" type="submit" name="apply_application" >Apply applications</button>
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




	<div class="container">
		<form action="Models/apply_application_handle.php" method="POST" enctype="multipart/form-data">
			<select type="text" name="bill_type">
				<option>Bill type</option>
				<option vlaue="mobile">Mobile</option>
				<option value="landline">Landline</option>
			</select>
			<br><br>
			<input type="text" name="bill_amount" placeholder="Enter the bill amount">
			<br><br>
			<input type="file" name="file" placeholder="upload the bill pdf">
			<br><br>

			<button class="btn btn-dark" type="submit" name="submit">Submit</button>
		</form>
	</div>


</body>



