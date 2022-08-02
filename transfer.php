
<?php
  session_start();
//if(!isset($_SESSION['userId'])){ header('location:login.php');}
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
  <?php
    $error = "";
    if (isset($_POST['userLogin']))
    {
      $error = "";
        $user = $_POST['email'];
        $pass = $_POST['password'];
       
        $result = $con->query("select * from userAccounts where email='$user' AND password='$pass'");
        if($result->num_rows>0)
        { 
          session_start();
          $data = $result->fetch_assoc();
          $_SESSION['userId']=$data['id'];
          $_SESSION['user'] = $data;
          header('location:Person.php');
         }
        else
        {
          $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
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
            <li><a href="Person.php" >Accounts</a></li>
            <li><a href="statements.php">Statements</a></li>
            <li><a href="transfer.php" class="active">Transaction</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
  </div>

    <div class="main-content">
<div class="container">
  <div class="card  w-75 mx-auto">
  <div class="card-header text-center">
    Funds Transfer
  </div>
  <div class="card-body">
      <form method="POST">
          <div class="alert alert-success w-50 mx-auto">
            <h5>New Transfer</h5>
            <input type="text" name="otherNo" class="form-control " placeholder="Enter Receiver Account number" required>
            <button type="submit" name="get" class="btn btn-primary btn-bloc btn-sm my-1">Get Account Info</button>
          </div>
      </form>
      <?php if (isset($_POST['get'])) 
      {
        $array2 = $con->query("select * from otheraccounts where accountNo = '$_POST[otherNo]'");
        $array3 = $con->query("select * from userAccounts where accountNo = '$_POST[otherNo]'");
        {
          if ($array2->num_rows > 0) 
          { $row2 = $array2->fetch_assoc();
            echo "<div class='alert alert-success w-50 mx-auto'>
                  <form method='POST'>
                    Account No.
                    <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control ' readonly required>
                    Account Holder Name.
                    <input type='text' class='form-control' value='$row2[holderName]' readonly required>
                    Account Holder Bank Name.
                    <input type='text' class='form-control' value='$row2[bankName]' readonly required>
                    Enter Amount for tranfer.
                    <input type='number' name='amount' class='form-control' min='1' max='$userData[balance]' required>
                    <button type='submit' name='transfer' class='btn btn-primary btn-bloc btn-sm my-1'>Tranfer</button>
                  </form>
                </div>";
          }elseif ($array3->num_rows > 0) {
           $row2 = $array3->fetch_assoc();
            echo "<div class='alert alert-success w-50 mx-auto'>
                  <form method='POST'>
                    Account No.
                    <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control ' readonly required>
                    Account Holder Name.
                    <input type='text' class='form-control' value='$row2[name]' readonly required>
                    Account Holder Bank Name.
                    <input type='text' class='form-control' value='"."RID Bank"."' readonly required>
                    Enter Amount for tranfer.
                    <input type='number' name='amount' class='form-control' min='1' max='$userData[balance]' required>
                    <button type='submit' name='transferSelf' class='btn btn-primary btn-bloc btn-sm my-1'>Tranfer</button>
                  </form>
                </div>";
          }
          else
            echo "<div class='alert alert-danger w-50 mx-auto'>Account No. $_POST[otherNo] Does not exist</div>";
        }
      } 
      ?>
    <br>
    <h5>Transfer History</h5>
    <?php
    if (isset($_POST['transferSelf']))
    {
      $amount = $_POST['amount'];
      setBalance($amount,'debit',$userData['accountNo']);
      setBalance($amount,'credit',$_POST['otherNo']);
      makeTransaction('transfer',$amount,$_POST['otherNo']);
      echo "<script>alert('Transfer Successfull');window.location.href='transfer.php'</script>";
    }
    if (isset($_POST['transfer']))
    {
      $amount = $_POST['amount'];
      setBalance($amount,'debit',$userData['accountNo']);
      makeTransaction('transfer',$amount,$_POST['otherNo']);
      echo "<script>alert('Transfer Successfull');window.location.href='transfer.php'</script>";
    }
      $array = $con->query("select * from transaction where userId = '$userData[id]' AND action = 'transfer' order by date desc");
      if ($array->num_rows > 0) 
      {
         while ($row = $array->fetch_assoc()) 
         {
            if ($row['action'] == 'transfer') 
            {
              echo "<div class='alert alert-warning'>Transfer have been made for  Rs.$row[debit] from your account at $row[date] in  account no.$row[other] </div>";
            }

         }
      }
      else
        echo "<div class='alert alert-info'>You have made no transfer yet.</div>";
    ?>  
  </div>
 
</div>

</div>
</body>
</html>