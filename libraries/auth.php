<?php

session_start();

function _auth_getUsersArray(){
    return core_loadArrayFromFile("users");
}

function _auth_saveUsersArray($users){
    core_saveArrayToFile("users", $users);
}

function _auth_getUserById($id){
    foreach (_auth_getUsersArray() as $u) if($u["id"]==$id) return $u;
    return NULL;
}

function auth_register($login, $name, $surname, $pass, $mail){
    $users = _auth_getUsersArray();
    foreach ($users as $user) {
        if ($user["login"] == $login) return "loginexist";
    }
    if(!preg_match("/^\w{2,20}$/i",$login)) return "logininvalid"; // Логин должен сожержать только буквы и цифры от 2 до 20 символов
    if(!preg_match("/^\S{6,20}$/i",$pass)) return "passinvalid"; // Пароль должен содержать от 6 до 20 символов
    if(!preg_match("/^\S+@\w+.\w+(.\w*)*$/i",$mail)) return "mailinvalid"; // Неправильный адресс электронной почты
    $users[] = [
        "id" =>time().rand(0,9999999),
        "login" => $login,
        "name" => $name,
        "surname" => $surname,
        "pass" => md5($pass),
        "mail" => $mail
    ];
    _auth_saveUsersArray($users);
    return true;
}

function auth_login($login,$pass){
    $users = _auth_getUsersArray();
    $current_user = NULL;
    foreach ($users as $user)
        if ($user["login"] == $login) {
            $current_user = $user;
            break;
        }
    if ($current_user === NULL) return "nologin"; // Пользователя с таким логином не существует
    if($current_user["pass"]!==md5($pass)) return "nopass"; // Неправильный пароль

    $_SESSION["user_id"] = $current_user["id"];
    $_SESSION["user_ip"] = md5($_SERVER["REMOTE_ADDR"]);
    $_SESSION["user_agent"] = md5($_SERVER["HTTP_USER_AGENT"]);
    return true;
}

function auth_is_auth(){
    $id = @$_SESSION["user_id"];
    $agent = @$_SESSION["user_agent"];
    $ip = @$_SESSION["user_ip"];
    if(is_empty($id,$agent,$ip))return false;
    if($ip!=md5($_SERVER["REMOTE_ADDR"])||$agent!=md5($_SERVER["HTTP_USER_AGENT"])) return false;
    if(_auth_getUserById($id)===NULL) return false;
    return true;
}

function auth_logout(){
    session_destroy();
}

function auth_getCurrentUser(){
    if(!auth_is_auth()) return NULL;
    return _auth_getUserById($_SESSION["user_id"]);
}