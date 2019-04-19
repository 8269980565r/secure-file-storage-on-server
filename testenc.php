<?php
$password = "myPassword_!";
$messageClear = "Secret message";

$aes256Key = hash("SHA256", $password, true);
echo $aes256Key."<br>";

// for good entropy (for MCRYPT_RAND)
srand((double) microtime() * 1000000);
// generate random iv
$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_RAND);


$crypted = fnEncrypt($messageClear, $aes256Key);

$newClear = fnDecrypt($crypted, $aes256Key);

echo
"IV:        <code>".$iv."</code><br/>".
"Encrypred: <code>".$crypted."</code><br/>".
"Decrypred: <code>".$newClear."</code><br/>";

function fnEncrypt($sValue, $sSecretKey) {
    global $iv;
    return rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $sSecretKey, $sValue, MCRYPT_MODE_CBC, $iv)), "\0\3");
}

function fnDecrypt($sValue, $sSecretKey) {
    global $iv;
    return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $sSecretKey, base64_decode($sValue), MCRYPT_MODE_CBC, $iv), "\0\3");
}
?>