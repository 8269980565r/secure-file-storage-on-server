<?php
include('db.php');
session_start();
$user_check=$_SESSION['login_user'];
$ses_sql=mysqli_query($db,"select  username,mem_id  from  member  where  username='$user_check'  ");
$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
$loggedin_session=$row['username'];
$password=['password'];
$loggedin_id=$row['mem_id'];
if(!isset($loggedin_session)  ||  $loggedin_session==NULL)
{
echo  "Go  back";
header("Location: index.php");
}
?>