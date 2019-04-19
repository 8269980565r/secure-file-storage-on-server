<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta  content='text/html;  charset=UTF-8'  http-equiv='Content-Type'/>
    <style>
        .btn{
            color:black;
            font-family:sans-serif;
            font-size:17px;
            text-decoration:none;
            font-weight:bolder;
        }
        a:hover{
            text-decoration:none;
            color:black;
        }
    </style>
    
    </head>

</html>

<?php
include('session.php');
include('db.php');

$path = "users/".$loggedin_session;

$filename =  $_GET['varname'];


$file1 = file_get_contents($path."/01".$filename);
$file2 = file_get_contents($path."/02".$filename);
$file3 = file_get_contents($path."/03".$filename);

$sql = "select * from $loggedin_session where filename = '$filename'";

$result = $db->query($sql);
while($rows=mysqli_fetch_array($result)){
    $iv = $rows['dfour'];
}

$password = "myPassword_!";
$aeskey = hash("SHA256", $password, true);

$password = "myDESPassword_!";
$deskey = hash("SHA256", $password, true);

$password = "myAESPassword_!";
$rc6key = hash("SHA256", $password, true);


function fnDecrypt($sValue, $sSecretKey) {
    global $iv;
    return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $sSecretKey, base64_decode($sValue), MCRYPT_MODE_CBC, $iv), "\0\3");
}

$final =  fnDecrypt($file1, $aeskey).fnDecrypt($file2, $deskey).fnDecrypt($file3, $rc6key);

$jaimatadi = $filename;
$myfile = fopen("$jaimatadi","w");
fwrite($myfile, $final);
echo "<div class='container'>";

echo "<a href=welcome.php><button type='button' class='btn btn-primary btn-block'>Back</button></a>";

echo "<a href='$jaimatadi' download><button type='button' class='btn btn-success btn-block'>Download</button></a>";



echo "<pre>".$final."</pre><br/>";

echo "</div>";


?>