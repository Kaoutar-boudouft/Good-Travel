<?php
$user=$_POST['username'];
include_once 'UsersManager.php';
$email=UsersManager::getEmailByUserName($user);
$pass=UsersManager::getPasswordByUserName($user);
shell_exec("pythonfiles\pass.py $user $email $pass");
echo("<h6 style='font-size:12pt' align='center'>a messge with your password was sent to your email</h6>");
?>