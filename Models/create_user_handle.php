<?php
	session_start();
	include_once '../head.php';
	if(!isset($_SESSION['u_id']) and $_SESSION['designation']!='admin'){
    	header('Location:login.php');
    	exit();
    }

	if(isset($_POST['submit'])){
		
		include_once 'connection.php';

		$aadhaar = $_POST['aadhaar'];
		$designation = $_POST['designation'];
		if(empty($aadhaar) || empty($designation)){
			header('Location:../create_user.php');
			exit();
		}

	    $randomPassword=rand(100000,999999);
  		
    	$hashedPwd = password_hash($randomPassword, PASSWORD_DEFAULT);

	    $sql="insert into user (aadhaar_no, password, designation) values 
	    ('$aadhaar', '$hashedPwd', '$designation');";
	    $result = mysqli_query($Connection, $sql);

	    if($result){
	    	echo "
	    	<div class='container' align='center' style='margin-top:25px;'>
	    		<h2>User created successfully</h2>
	    		<h3>Aadhaar Number: $aadhaar <br> Password Generated: $randomPassword</h3>
	    	
	    	<form action='create_user_handle.php' method='POST'>
	    		<button class='btn btn-dark' type='submit' name='ok'>OK</submit>
	    	</form>
	    	</div>
	    ";	

	     mkdir('../pdfs/'.$aadhaar.'/', 0777, true);

	    }
	    else{
	    	header("Location:../create_user.php?signup_error");
	    	exit();
	    }

	    
  	}

  	if(isset($_POST['ok'])){
  		header('Location:../admin_index.php');
  	}