<?php
/**
 * Created by PhpStorm.
 * User: anmolsingh
 * Date: 2018-03-12
 * Time: 1:50 PM
 */

//Check password match
function checkPass1Pass2($password1, $password2){
    echo strcmp(str_replace(' ', '', $password1), str_replace(' ', '', $password2));
    if(strcmp(str_replace(' ', '', $password1), str_replace(' ', '', $password2)) == 0){
        return true;
    }
    else{
        return false;
    }
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


