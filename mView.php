<?php
//session_start();
//if(!isset($_SESSION['managerId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Banking</title>
  <style>
   *{
	box-sizing: border-box;
	padding: 0;
	margin: 0;
	font-family:sans-serif;
}

body,html{
	height: 100%;
	background-color: rgb(248, 246, 244);
	font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.nav{
	width: 100%;
	height: 75px;
	background-color: rgb(1, 1, 133);
	line-height: 75px;
	padding: 0px 100px;
	position: fixed;
	z-index: 1;
}

.nav .logo{
	font-size: 30px;
	font-weight: bold;
	letter-spacing: 1px;
	
}

.nav .logo p{
	float: left;
	color: white;
	text-transform: uppercase;
	font-family: sans-serif;
}

.nav ul{
	float: right;
}

.nav ul li{
	display: inline-block;
	list-style: none;
	font-family: sans-serif;
}

.nav ul li a{
	color: white;
	text-decoration: none;
	font-size: 18px;
	text-transform: uppercase;
	padding: 0px 32px;
}

.nav ul li a:hover{
	color:#ced3eb;
	border-bottom: 2px solid #ced3eb;
}

.nav ul li .active{
	color:#ced3eb;
}

.main-content{
	padding: 100px;
}

   </style>
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
</head>
<body>

<div class="nav">
        <div class="logo">
            <p>RID Bank</p>
        </div>
        <ul>
            <li><a href="allAcc.php">All Accounts</a></li>
            <li><a href="mView.php"  class="active">Manager View</a></li>
            <li><a href="newAcc.php">Add new Account</a></li>
            <li><a href="home.html">Logout</a></li>
        </ul>
    </div>   
 
<?php
if (isset($_POST['saveAccount']))
{
  if (!$con->query("insert into login (email,password,type) values ('$_POST[email]','$_POST[password]','cashier')")) {
    echo "<div claass='alert alert-success'>Failed. Error is:".$con->error."</div>";
  }
}
if (isset($_GET['del']) && !empty($_GET['del']))
{
  $con->query("delete from login where id ='$_GET[del]'");
}
  $array = $con->query("select * from login where type='cashier'");
  
 ?>


<div class="main-content">
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
    Manager Details<button class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal">Add new Manager</button>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Email</th>
          <th>Password</th>
          <th>Action</th>
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
              echo "<td><a href='mView.php?del=$row[id]' class='btn btn-danger btn-sm'>Delete</a></td>";
              echo "</tr>";
            }
          }
         ?>
      </tbody>
    </table>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Manager Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="POST">
          Enter Details
         <input class="form-control w-75 mx-auto" type="email" name="email" required placeholder="Email">
         <input class="form-control w-75 mx-auto" type="password" name="password" required placeholder="Password">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="saveAccount" class="btn btn-primary">Save Account</button>
      </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>