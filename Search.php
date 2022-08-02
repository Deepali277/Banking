<?php
//session_start();
//if(!isset($_SESSION['cashId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
<title>Search Account</title>
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
  <?php $note ="";
    if (isset($_POST['withdrawOther']))
    { 
      $accountNo = $_POST['otherNo'];
      $checkNo = $_POST['checkno'];
      $amount = $_POST['amount'];
      if(setOtherBalance($amount,'debit',$accountNo))
      $note = "<div class='alert alert-success'>successfully transaction done</div>";
      else
      $note = "<div class='alert alert-danger'>Failed</div>";

    }
    if (isset($_POST['withdraw']))
    {
      setBalance($_POST['amount'],'debit',$_POST['accountNo']);
      makeTransactionCashier('withdraw',$_POST['amount'],$_POST['checkno'],$_POST['userId']);
      $note = "<div class='alert alert-success'>successfully transaction done</div>";

    }
    if (isset($_POST['deposit']))
    {
      setBalance($_POST['amount'],'credit',$_POST['accountNo']);
      makeTransactionCashier('deposit',$_POST['amount'],$_POST['checkno'],$_POST['userId']);
      $note = "<div class='alert alert-success'>successfully transaction done</div>";

    }
   ?>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p>RID Bank</p>
        </div>
        <ul>
            <li><a href="Search.php" class="active">Manager Panel</a></li>
            <li><a href="home.html">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
<div class="row w-100" style="padding: 11px">
  <div class="col">
    <div class="card text-center w-50 mx-auto shadowBlue">
  <div class="card-header">
    Account Information
  </div>
  <div class="card-body">
    <p class="card-text"><?php echo $note; ?>
      <form method="POST">
          <div class="alert alert-success w-50 mx-auto">
            <h5>Enter Account Number</h5>
            <input type="text" name="otherNo" class="form-control " placeholder="Enter Account number" required>
            <button type="submit" name="get" class="btn btn-primary btn-bloc btn-sm my-1">Get Account Info</button>
          </div>
      </form>
    </p>
    <?php if (isset($_POST['get'])) 
      {
        $array2 = $con->query("select * from otheraccounts where accountNo = '$_POST[otherNo]'");
        $array3 = $con->query("select * from userAccounts where accountNo = '$_POST[otherNo]'");
        {if ($array2->num_rows > 0) 
          { $row2 = $array2->fetch_assoc();
            echo "
            <div class='row'>
                  <div class='col'>
                  Account No.
                  <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control text-center ' readonly required>
                  Account Holder Name.
                  <input type='text' class='form-control text-center ' value='$row2[holderName]' readonly required>
                  Account Holder Bank Name.
                  <input type='text' class='form-control text-center ' value='$row2[bankName]' readonly required>
                  Bank Balance
                  <input type='text' class='form-control my-1 text-center '  value='Rs.$row2[balance]' readonly required>
                  
                  
                  </div>
                </div>
            ";
          
          }elseif($array3->num_rows > 0) {
           $row2 = $array3->fetch_assoc();
            echo "
            <div class='row'>
                  <div class='col'>
                  
                    Account No.
                    <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control text-center ' readonly required>
                    Account Holder Name.
                    <input type='text' class='form-control text-center' value='$row2[name]' readonly required>
                    Account Holder Bank Name.
                    <input type='text' class='form-control text-center' value='RID Bank' readonly required>Bank Balance
                    <input type='text' class='form-control my-1  text-center'  value='Rs.$row2[balance]' readonly required>
                  
                  </div>
                </div>
            ";
          }
          else
            echo "<div class='alert alert-danger w-50 mx-auto'>Account No. $_POST[otherNo] Does not exist</div>";
        }
  } 
      ?>
  </div>
</div>
  </div>
  
</div>
</body>
</html>