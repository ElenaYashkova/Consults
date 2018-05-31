<?php
function reg(){
    if(is_empty(@$_POST["login"],@$_POST["pass"],@$_POST["email"]) || !auth_register($_POST["login"],$_POST["pass"],$_POST["email"])){
        echo "Произошла ошибка регистрации";
    }else{
        header("Location:".$_SERVER["HTTP_REFERER"]);
    }
}

function login(){
    if(is_empty(@$_POST["login"],@$_POST["pass"]) || !auth_login($_POST["login"],$_POST["pass"])){
        echo "Произошла ошибка авторизации";
    }else{
        header("Location:".$_SERVER["HTTP_REFERER"]);
    }
}

function logout(){
    auth_logout();
    header("Location:".$_SERVER["HTTP_REFERER"]);
}