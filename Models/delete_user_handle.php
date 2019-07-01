<?php
	session_start();
	include_once "connection.php";
	if(!isset($_SESSION['u_id']) and $_SESSION['designation']!='admin'){
    	header('Location:login.php');
    	exit();
    }
    
	if(isset($_POST['remove'])){
		$aadhaar=$_POST['aadhaar'];
		$sql="delete from user where aadhaar_no = $aadhaar;";
		$result=mysqli_query($Connection,$sql);
		if($result){
			header("Location: ../admin_index.php");
			exit();
		}
		header("Location: ../admin_index.php?error_in_deletion");
			exit();
		
	}

?>