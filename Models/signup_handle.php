
<?php
session_start();

if(isset($_POST['submit'])){

    include_once 'connection.php';

    $u_id =  $_POST['aadhaar'];
    $password =  $_POST['password'];

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "select * from user where aadhaar_no ='$u_id';";
    $result = mysqli_query($Connection, $sql);
    $checkRows = mysqli_num_rows($result);
    if($checkRows > 0){
        echo "<h1>email already taken!</h1>";
        header("Location: ../signup.php?already registered");
        
        exit();
    }
    else{
    	$designation = "admin";
        $sql = "insert into user (aadhaar_no,  password, designation) 
                    values ('$u_id', '$hashedPwd','$designation');";
        $result = mysqli_query($Connection, $sql);
        if(!result){
        	echo mysqli_error();
        }
        $row = mysqli_fetch_assoc($result);
        $_SESSION['u_id'] = $row['aadhaar_no'];
        $_SESSION['designation'] = $row['designation'];
        header("Location: ../admin_index.php?signup=successful");
        exit();

    }
    
}