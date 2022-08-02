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
    if ($con->query("delete from useraccounts where id = '$_GET[delete]'"))
    {
      header("location:allAcc.php");
    }
  } 
  ?>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p>RID Bank</p>
        </div>
        <ul>
            <li><a href="allAcc.php" class="active">All Accounts</a></li>
            <li><a href="mView.php">Manager View</a></li>
            <li><a href="newAcc.php">Add new account</a></li>
            <li><a href="home.html">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        
            <div class="container">
                <div class="card w-100 text-center shadowBlue">
                  <div class="card-header">
                    All accounts
                  </div>
                  <div class="card-body">
                   <table class="table table-bordered table-sm">
                  <thead>
                    <tr>
                      <th scope="col">S.No</th>
                      <th scope="col">Name</th>
                      <th scope="col">Account No.</th>
                      <th scope="col">Branch Name</th>
                      <th scope="col">Current Balance</th>
                      <th scope="col">Account type</th>
                      <th scope="col">Contact</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i=0;
                      $array = $con->query("select * from useraccounts,branch where useraccounts.branch = branch.branchId");
                      if ($array->num_rows > 0)
                      {
                        while ($row = $array->fetch_assoc())
                        {$i++;
                    ?>
                      <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['accountNo'] ?></td>
                        <td><?php echo $row['branchName'] ?></td>
                        <td>Rs.<?php echo $row['balance'] ?></td>
                        <td><?php echo $row['accountType'] ?></td>
                        <td><?php echo $row['number'] ?></td>
                        <td>
                          <a href="view.php?id=<?php echo $row['id'] ?>" class='btn btn-success btn-sm'>View</a>
                          <a href="allAcc.php?delete=<?php echo $row['id'] ?>" class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                        
                      </tr>
                    <?php
                        }
                      }
                     ?>
                  </tbody>
                </table>
                </div>
        </div>
    </div>

</body>
</html>