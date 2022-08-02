<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</head>
<body>
<div class="nav">
        <div class="logo">
            <p>RID Bank</p>
        </div>
        <ul>
            <li><a href="Person.php" class="active">Account</a></li>
            <li><a href="statements.php">Statements</a></li>
            <li><a href="transfer.php">Transaction</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
</div>
    <div class="main-content">
    <?php require 'accounts.php'; ?>
</div>
</body>
</html>