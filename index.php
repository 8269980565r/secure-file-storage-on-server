<?php
include("db.php");
include  "logincheck.php";
?>
<!DOCTYPE  html>
<html>
<head>
<meta  content='text/html;  charset=UTF-8'  http-equiv='Content-Type'/>
<link  rel="stylesheet"  type="text/css"  href="style.css"  />
<title>file storage</title>
</head>
<body>
<header>
</header>
<div  id="center">
<div  id="center-set">
<p  align='center'  style="font-weight:bold;  font-size:20px;  font-family:Segoe  Print;  color:#3498DB;">-written  by  Rajat yadav</p>
<div  id="signup">
<div  id="signup-st">
 <div  align="center">
<?php  
     $remarks  =  isset($_GET['remarks'])  ?  $_GET['remarks']  :  '';
     if  ($remarks==null  and  $remarks=="")
{
   echo  '<div  id="reg-head"  class="headrg">Register  Here</div>';
       }
     if  ($remarks=='success')
{
   echo  '<div  id="reg-head"  class="headrg">Registration  Success</div>';
         
       }
     if  ($remarks=='failed')
{
   echo  '<div  id="reg-head-fail"  class="headrg">Registration  Failed!,  Username  exists</div>';
       }
?>
       </div>
<form  name="reg"  action="execute.php"  onsubmit="return  validateForm()"  method="post"  id="reg">
<table  border="0"  align="center"  cellpadding="2"  cellspacing="0">
  
   <tr>
       <td  class="t-1"><div  align="left"  id="tb-name">First&nbsp;Name:</div></td>
       <td  width="171"><input  type="text"  name="fname"    id="tb-box"/></td>
   </tr>
   <tr>
       <td  class="t-1"><div  align="left"  id="tb-name">Last&nbsp;Name:</div></td>
       <td><input  type="text"  name="lname"  id="tb-box"/></td>
   </tr>
     <tr>
       <td  class="t-1"><div  align="left"  id="tb-name">Email:</div></td>
       <td><input  type="text"  id="tb-box"  name="address"  /></td>
   </tr>
 <tr>
       <td  class="t-1"><div  align="left"  id="tb-name">Username:</div></td>
       <td><input  type="text"  id="tb-box"  name="username"  /></td>
   </tr>
 <tr>
       <td  class="t-1"><div  align="left"  id="tb-name">Password:</div></td>
       <td><input  id="tb-box"  type="password"  name="password"  /></td>
   </tr>
</table>
       <div  id="st"><input  name="submit"  type="submit"  value="Submit"  id="st-btn"/></div>
</form>
<div  id="reg-bottom"  class="btmrg">Secure file storage</div>
</div>
</div>
 
<div  id="login">
<div  id="login-st">
<form  action=""  method="POST"  id="signin"  id="reg">
   <?php
   $remarks  =  isset($_GET['remark_login'])  ?  $_GET['remark_login']  :  '';
     if  ($remarks==null  and  $remarks=="")
{
   echo  '<div  id="reg-head"  class="headrg">Login  Here</div>';
       }
     if  ($remarks=='failed')
{
   echo  '<div  id="reg-head-fail"  class="headrg">Login  Failed!,  Invalid  Credentials</div>';
       }
?>
<table  border="0"  align="center"  cellpadding="2"  cellspacing="0">
 <tr  id="lg-1">
       <td  class="tl-1"><div  align="left"  id="tb-name">Username:</div></td>
       <td><input  type="text"  id="tb-box"  name="username"  /></td>
   </tr>
 <tr  id="lg-1">
       <td  class="tl-1"><div  align="left"  id="tb-name">Password:</div></td>
       <td><input  id="tb-box"  type="text"  name="password"  /></td>
   </tr>
</table>
       <div  id="st"><input  name="submit"  type="submit"  value="Login"  id="st-btn"/></div>
</form>
<div  id="reg-bottom"  class="btmrg">Secure file storage</div>
</div>
</div>
</div>
</div>
<div  id="footer">
 <p>Secure file storage</p>
 </div>
</body>
</html>