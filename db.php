<?php 
    $con = new mysqli('localhost','root','','mybank');
    $ar = $con->query("select * from `userAccounts`,`branch` where `userAccounts`.`id` = 1 AND `userAccounts`.`branch` = `branch`.`branchId`");
    $userData = $ar->fetch_assoc();
?>
