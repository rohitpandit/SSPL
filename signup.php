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
        <h4 align="center">Admin Signup</h4>
        <br>
        <form action="Models/signup_handle.php" method="POST" >
            <input type="text" name="aadhaar" placeholder="Aadhar Number" required>
            <br><br>
            <input type="password" name="password" placeholder="Password" required>
            <br><br>
            <button class="btn btn-dark" type="submit" name="submit">Sign Up</button>
            <br><br>
            <a href="login.php" style="text-decoration: none; color: black;">Already a member!</a>
        </form>
    </div>
</body>
</html>

