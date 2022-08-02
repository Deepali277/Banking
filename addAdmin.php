
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel ="stylesheet" type="text/css" href="Admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p>RID Bank</p>
        </div>
        <ul>
            <li><a href="Profile.html" class="active">Profile</a></li>
            <li><a href="#about">View</a></li>
            <li><a href="#contact">Account Balance</a></li>
            <li><a href="login.html">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="wrapper">
            <h1>Admin Admin</h1>
           <br><br>
            <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                <td>Full Name: </td>
                <td><input type="text" name="fullname" placeholder="Enter your full name"></td>
                </tr>

                <tr>
                <td>User Name: </td>
                <td><input type="text" name="username" placeholder="Your username"></td>
                </tr>

                <tr>
                <td>Password: </td>
                <td><input type="password" name="password" placeholder="Your password"></td>
                </tr>

                <tr>
                <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></td>
                </tr>

            </table>
            </form>
        </div>
    </div>

<?php
 if(isset($_POST['submit']))
 {
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);

$sql="INSERT INTO `admin` SET
fullname='$fullname',
username='$username',
password='$password'";

 }
 

?>

    </body>
</html>
