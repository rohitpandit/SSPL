<?php
	session_start();
	include_once '../head.php';
	include_once 'connection.php';

	if(isset($_POST['submit']) ){
		$file = $_FILES['file'];
		$file_name= $file['name'];
		$file_tmp_name= $file['tmp_name'];
		$file_size= $file['size'];
		$file_error= $file['error'];

		$file_ext= explode('.', $file_name);
		$file_actual_ext = strtolower(end($file_ext));

		$allowed = array('pdf');

		if(in_array($file_actual_ext, $allowed)){
			if($file_error === 0){
				if($file_size < 300000){

						$aadhaar = $_SESSION['u_id'];
						$bill_type = $_POST['bill_type'];
						$bill_amount = $_POST['bill_amount'];
					
					    $sql="insert into application (aadhaar_no, bill_type, bill_amount, date_entered) values 
					    ('$aadhaar', '$bill_type', '$bill_amount',CURTIME());";
					    $result = mysqli_query($Connection, $sql);

					    if($result){
					    	echo "
					    	<div class='container' align='center' style='margin-top:25px;'>
					    		<h2>Applied successfully</h2>

					    	<form action='apply_application_handle.php' method='POST'>
					    		<button class='btn btn-dark' type='submit' name='ok'>OK</submit>
					    	</form>
					    	</div>
					    	";	

					    	$sql = "select * from application where aadhaar_no= $aadhaar order by date_entered DESC";
					    	$result = mysqli_query($Connection, $sql);
					    	if($row=mysqli_fetch_assoc($result)){
					    		
						    	$file_new_name = $row['application_id'].".pdf";
								$file_destination =  "/opt/lampp/htdocs/SSPL/pdfs/".$aadhaar."/application_no".$file_new_name;
								echo $file_destination;
								move_uploaded_file($file_tmp_name, $file_destination);
					    	}
					    	else{
					    		header("Location: ../user_index.php?error5");
					    		exit();
					    	}
					    }
					    else{
					    	header("Location:../user_index.php?error4");
					    	exit();
					    }

					
					
				   	// header("Location:../user_index.php?applied_successfully!");
			    	// exit();
				}
				else{
			    	header("Location:../user_index.php?error3");
			    	exit();				
			    }
			}
			else{
		    	header("Location:../user_index.php?error2");
		    	exit();			
		    }
		}
		else{
	    	header("Location:../user_index.php?error1");
	    	exit();		
	    }   
  	}


  	if(isset($_POST['ok'])){
  		header('Location:../user_index.php?successful!');
  	}

