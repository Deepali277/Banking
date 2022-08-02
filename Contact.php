<?php
$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$message=$_POST['message'];

$con=new mysqli("localhost","root","","mybank");
if($con->connect_error){
    die("failed to connect:".$con->connect_error);
 } 
else{
$stmt=$con->prepare("INSERT INTO `contact`(`Name`, `Email`, `Phone`, `Message`,`dt`) 
VALUES('$name',' $email', '$phone', '$message',current_timestamp())");

$stmt->execute();
    echo "<script>window.alert('Message sent succesfully done')
    window.open('home.html','_self')</script>"; 
$stmt->close();
$con->close();
}
?>

