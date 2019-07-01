<?php

session_start();


if (isset($_POST['submit'])){

    include_once 'connection.php';

    $uid = $_POST['aadhaar'];
    $pwd = $_POST['password'];

    if(empty($uid) || empty($pwd)){
        header("Location: ../login.php?login=empty");
        exit();
    }
    else{
        //checking for if the entered email is in user
        $sql = "select * from user where aadhaar_no='$uid';";
        $result = mysqli_query($Connection, $sql);
        $resultCheck = mysqli_num_rows($result);


        if($resultCheck <1){
            header("Location: ../login.php?login=error1");
            exit();                
            
        }

        else{
            if($row = mysqli_fetch_assoc($result)){
                $hashedPwdCheck = password_verify($pwd, $row['password']);
                if ($hashedPwdCheck == false){
                    header("Location: ../login.php?login=error2");
                    exit();
                }
                elseif( $hashedPwdCheck == true){
                    $_SESSION['u_id'] = $row['aadhaar_no'];
                    $_SESSION['designation'] = $row['designation'];
                    if($row['designation']=="admin"){
                       header("Location: ../admin_index.php?login=success");

                    }
                    else{
                        header("Location: ../user_index.php?login=success");

                    }
                    exit();
                }
            }
        }

    }
}
else{
    header("Location: ../login.php?login=error");
    exit();
}