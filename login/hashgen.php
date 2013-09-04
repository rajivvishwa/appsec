<?php
 //Takes a password and returns the salted hash
//$password - the password to hash
//returns - the hash of the password (128 hex characters)
function HashPassword($password)
{
    $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM)); //get 256 random bits in hex
    $hash = hash("sha256", $salt . $password); //prepend the salt, then hash
    //store the salt and hash in the same string, so only 1 DB column is needed
    $final = $salt . $hash; 
    return $final;
}
$pass1 = "test";
$pass2 = "test1";
$hash = HashPassword($pass1);
echo "<body>";
echo "INPUTS</br>";
echo "Password 1 = " . $pass1 . "</br>";
echo "Password 2 = " . $pass2 . "</br>";
echo "PROCESS</br>";
echo "Salt (Gen) = " . substr($hash, 0, 64) . "</br>";
echo "Password Hash (Gen) = " . $hash . "</br>";
echo "Password Hash (Val) = " . ValidatePassword($pass2,$hash);

echo "</body>";

//Validates a password
//returns true if hash is the correct hash for that password
//$hash - the hash created by HashPassword (stored in your DB)
//$password - the password to verify
//returns - true if the password is valid, false otherwise.
function ValidatePassword($password, $correctHash)
{
    $salt = substr($correctHash, 0, 64); //get the salt from the front of the hash
    $validHash = substr($correctHash, 64, 64); //the SHA256

    $testHash = hash("sha256", $salt . $password); //hash the password being tested

    //if the hashes are exactly the same, the password is valid
    return $testHash === $validHash;
}

?>