<?php
include('session.php');
include('db.php');
?>
<!DOCTYPE  html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta  content='text/html;  charset=UTF-8'  http-equiv='Content-Type'/>
<link  rel="stylesheet"  type="text/css"  href="style.css"  />
<title>file storage</title>
    <style>
        .list-group{
            width:auto;
            position:relative;
            text-align:center;
            width:50%; 
            left:35%;
            font-family:sans-serif;
            font-size:18px;
            font-weight:bolder;
           
            background-color:white;
            color:black;
            box-shadow:3px 3px 7px 0.1px; 
        }
        body{
            font-family: sans-serif;
        }
        #file:hover{
           
            color:green;
        }
        
    </style>
</head>
<body>
<header>
<nav>

</nav>
</header>
<div  id="center">
<div  id="center-set">

<h1  align='center'>Welcome  <?php  echo  $loggedin_session;  ?></h1>
    <div class="container">
    <div class ="row" >
    <div class="col-sm-6">
    <form action="processing.php" method="post" enctype="multipart/form-data">
    Select file to upload
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>
        </div>
        <div class="col-sm-6">
    <ul class="list-group">
        <li class="list-group-item active">Uploaded files</li>
        <?php
        
        
          $sql = "select * from $loggedin_session";
          $result = $db->query($sql);
        $i=0;
          while($rows=mysqli_fetch_array($result)){
             
                  $name = $rows['filename'];
              echo "<a href = 'downloading.php?varname=$name' id ='file' class='list-group-item list-group-item-action'>".$name."</a>";
              
          }
        
        
          ?>
    </ul>
        </div>
    </div>
    </div>

<div  id="contentbox">
<?php
include('db.php');
$sql="SELECT  *  FROM  member  where  mem_id=$loggedin_id";
$result=mysqli_query($db,$sql);
?>
<?php
while($rows=mysqli_fetch_array($result)){
?>
<div  id="signup">
<div  id="signup-st">
<form  action=""  method="POST"  id="signin"  id="reg">
<div  id="reg-head"  class="headrg">Your  Profile</div>
<table  border="0"  align="center"  cellpadding="2"  cellspacing="0">
<tr  id="lg-1">
<td  class="tl-1"><div  align="left"  id="tb-name">Reg  id:</div></td>
<td  class="tl-4"><?php  echo  $rows['mem_id'];  ?></td>
</tr>
<tr  id="lg-1">
<td  class="tl-1"><div  align="left"  id="tb-name">Name:</div></td>
<td  class="tl-4"><?php  echo  $rows['fname'];  ?>  <?php  echo  $rows['lname'];  ?></td>
</tr>
<tr  id="lg-1">
<td  class="tl-1"><div  align="left"  id="tb-name">Email  id:</div></td>
<td  class="tl-4"><?php  echo  $rows['address'];  ?></td>
</tr>
</table>
<div  id="reg-bottom"  class="btmrg">secure file storage using hybrid cryptography</div>
</form>
</div>
</div>
<div  id="login">
<div  id="login-sg">
<div  id="st"><a  href="logout.php"  id="st-btn">Sign  Out</a></div>

</div>
</div>
<?php
//  close  while  loop
}
?>
</div>
</div>
</div>
<?php
//  close  connection;
mysqli_close($db);
?>
<div  id="footer">
<p>secure file storage using hybrid cryptography</p>
</div>
</body>
</html>



