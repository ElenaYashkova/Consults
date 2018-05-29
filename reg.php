<?php
$regexparr = [
    "login"=>'/^\w{2,12}$/',
    "password"=>'/^\S{6,16}$/'
];

foreach ($regexparr as $key=>$val){
    if (preg_match($val,$_POST[$key])){

    }
}