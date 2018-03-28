<?php
/**
 * Created by PhpStorm.
 * User: anmolsingh
 * Date: 2018-03-12
 * Time: 1:50 PM
 */

//Check password match
function checkPass1Pass2($password1, $password2){
<<<<<<< HEAD
    return strcmp($password1,$password2);
=======
    if (strcmp($password1,$password2)){
        return true;
    }
    else{
        return false;
    }
>>>>>>> 6822184b64e647d42e012a06b9520cd86979738e
}

//Password encryption
function passHash($password, $options){
    return password_hash($password, PASSWORD_BCRYPT, $options);
}

//Password decryption and validation
function passDehash($password, $hash){
    if(password_verify($password, $hash)){
        return true;
    }
    else{
        return false;
    }
}


