<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta  content='text/html;  charset=UTF-8'  http-equiv='Content-Type'/>
    </head>
</html>
<?php
echo "<a href=welcome.php><button type='button' class='btn btn-primary btn-block'>Back</button></a>";
include('db.php');
include('session.php');
$loggedin_session=$row['username'];
$target_dir = "users/".$loggedin_session."/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$filename = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 500000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";

} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        
 $path1 = $target_file;

$string = file_get_contents($path1);

$i = 0; $len = strlen($string)/3; $bits = array();
while($i < strlen($string)) {
    $bits[] = substr($string, $i, $len);
    $i += $len;
}
$aes = $bits[0];
$des = $bits[1];
$rc6 = $bits[2];
//====================================Encryption AES starts here =========================
        
    function fnEncrypt($sValue, $sSecretKey) {
    global $iv;
    return rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $sSecretKey, $sValue, MCRYPT_MODE_CBC, $iv)), "\0\3");
}
        
        function fnDecrypt($sValue, $sSecretKey) {
    global $iv;
    return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $sSecretKey, base64_decode($sValue), MCRYPT_MODE_CBC, $iv), "\0\3");
}
        
$password = "myPassword_!";
$messageClear = $aes;
$aes256Key = hash("SHA256", $password, true);


srand((double) microtime() * 1000000);
// generate random iv
$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_RAND);


$crypted = fnEncrypt($messageClear, $aes256Key);

$newClear = fnDecrypt($crypted, $aes256Key);

/*
echo
"IV:        <code>".$iv."</code><br/>".
"Encrypred: <code>".$crypted."</code><br/>".
"Decrypred: <code><pre>".$newClear."</pre></code><br/>";*/



$path = $target_dir."01".basename($_FILES["fileToUpload"]["name"]);
$myfile = fopen("$path","w");
fwrite($myfile, $crypted);

//=================================Encryption DES starts here=============================
$password = "myDESPassword_!";
$messageClear = $des;
$des256Key = hash("SHA256", $password, true);

srand((double) microtime() * 1000000);
// generate random iv


$crypted = fnEncrypt($messageClear, $des256Key);

$newClear = fnDecrypt($crypted, $des256Key);

/*
echo
"IV:        <code>".$iv."</code><br/>".
"Encrypred: <code>".$crypted."</code><br/>".
"Decrypred: <code><pre>".$newClear."</pre></code><br/>";*/

$path = $target_dir."02".basename($_FILES["fileToUpload"]["name"]);
$myfile = fopen("$path","w");
fwrite($myfile, $crypted);

//=================================Encryption AES starts here=============================
$password = "myAESPassword_!";
$messageClear = $rc6;
$rc6256Key = hash("SHA256", $password, true);

srand((double) microtime() * 1000000);
// generate random iv



$crypted = fnEncrypt($messageClear, $rc6256Key);

$newClear = fnDecrypt($crypted, $rc6256Key);

/*
echo
"IV:        <code>".$iv."</code><br/>".
"Encrypred: <code>".$crypted."</code><br/>".
"Decrypred: <code><pre>".$newClear."</pre></code><br/>";*/

$path = $target_dir."03".basename($_FILES["fileToUpload"]["name"]);
$myfile = fopen("$path","w");
fwrite($myfile, $crypted);
//===================================Ends encryption=======================================

fclose($myfile);
unlink($path1);
$sql = "insert into $loggedin_session (filename,dfour) values('$filename','$iv')";
$db->query($sql);
        
        
        
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>