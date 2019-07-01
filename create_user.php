<?php
    session_start();
  include_once 'head.php';
  if(!isset($_SESSION['u_id']) and $_SESSION['designation']!='admin'){
        header('Location:login.php');
        exit();
    }
?>

<body>

    
    <div class="navbar navbar-default bg-dark">
        <div class="container-fluid">      
            <div>
                <form class="form-inline" action="create_user.php" method="POST">
                    <button class="btn btn-light active" type="submit" name="create_user">Create User</button>
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
                    <button class="btn btn-light" type="submit" name="all_expenditure">show total expenditure</button>
                </form>
            </div>
            <div align="right">
                <form class="form-inline" method="POST" action="Models/logout.php">
                    <button class="btn btn-light" type="submit" name="logout">logout</button>
                </form>
            </div>
        </div>
    </div>


    <div  class="container" align=center>
        <br>
        <form action="Models/create_user_handle.php" method="POST" >

            <input  type="text" name="aadhaar" placeholder="Aadhar Number" >
            <br><br>

            <select name="designation">
                <option>select one option...</option>
                <option value="scientist">Scientist</option>
                <option value="technician">Technician</option>
            <select>
            <br><br>
            <button class="btn btn-dark" type="submit" name="submit">create Account</button>
        </form>
    </div>
        

    </div>
</body>
</html>

