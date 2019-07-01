<?php

	include_once 'head.php';

?>

<body>
    <div class="container">
        <div class="jumbotron">
            <h2 align="center">
               <b> SSPL Phone Bill Reimbursement System</b>
            </h2>
        </div>
    </div>
    <div  class="container" align=center>
        <h4>Enter the login credentials</h4>
        <br>
		<form action="Models/login_handle.php" method="POST">
			<input type="text" name="aadhaar" placeholder="Aadhaar Number">
			<br><br>
			<input type="password" name="password" placeholder="Password">
			<br><br>
			<button class="btn btn-dark" type="submit" name="submit">Login</button>
			<br><br>
		</form>    
    </div>
</body>
</html>



