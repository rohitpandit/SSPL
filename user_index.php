<?php

	session_start();
	include_once 'head.php';
    include_once 'Models/connection.php';
    if(!isset($_SESSION['u_id']) or $_SESSION['designation']=='admin'){
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


	<div class="container" align="center">
		<h4 >Welcome User!</h4>
		<h5>Select form the above menu!</h5>
	</div>
	
</body>
</html>
