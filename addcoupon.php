<?php
include_once 'DataAccess.php';
$user=$_POST['user'];
$nbr= DataAccess::miseajour("update users set coupon=1 where UserName='$user'");
?>