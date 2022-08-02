<?php
//session_start();
//if(!isset($_SESSION['managerId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Banking</title>
  <?php require 'autoloader.php'; ?>
  <?php require 'db.php'; ?>
  <?php require 'function.php'; ?>
  <?php if (isset($_GET['delete'])) 
  {
    if ($con->query("delete from useraccounts where id = '$_GET[id]'"))
    {
      header("location:mindex.php");
    }
  } ?>
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
            <li><a href="login.php">Logout</a></li>
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

    <div class="container">
        <div class="card w-100 text-center shadowBlue">
            <div class="card-header">
                All Staff Accounts <button class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#exampleModal">Add New Account</button>
            </div>
        <div class="card-body">
            <table class="table table-bordered">
            <thead>
                <tr>
                <th>Email</th>
                <th>Password</th>
                <th>Account Type</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($array->num_rows > 0)
                {
                    while ($row = $array->fetch_assoc())
                    {
                    echo "<tr>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['password']."</td>";
                    echo "<td>".$row['type']."</td>";
                    echo "<td><a href='maccounts.php?del=$row[id]' class='btn btn-danger btn-sm'>Delete</a></td>";
                    echo "</tr>";
                    }
                }
                ?>
            </tbody>
            </table>
    </div>
    <div class="card-footer text-muted">
        <?php echo "bankname"; ?>
    </div>
</div>
    </body>
</html>
