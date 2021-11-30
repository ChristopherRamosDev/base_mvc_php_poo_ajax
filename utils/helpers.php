<?php

function hashPass($pass)
{
    return password_hash($pass, PASSWORD_BCRYPT);
}
function verifyPass($passHash,$curretnPass){
    return password_verify($passHash,$curretnPass);
}
function isString($arr){
    $arr = array();
}
