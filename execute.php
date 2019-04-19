<?php
session_start();
include('db.php');
$username=$_POST['username'];
 
$result  =  mysqli_query($db,"SELECT  *  FROM  member  WHERE  username='$username'");
$num_rows  =  mysqli_num_rows($result);
 
if  ($num_rows)  {
header("location:  index.php?remarks=failed");
}
else
{
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$address=$_POST['address'];
$username=$_POST['username'];
$password=$_POST['password'];
mysqli_query($db,"INSERT  INTO  member(fname,  lname,  address,username,  password)VALUES('$fname',  '$lname','$address',  '$username',  '$password')");
    
    $output = 'users/'.$username;
         if (!file_exists($output)) {
    mkdir($output ,0744, true);
         }
    $sql = "create table $username (filename varchar(100) NOT NULL,dfour varchar(100))";
             
    $db->query($sql);
header("location:  index.php?remarks=success");
}
?>