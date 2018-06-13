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
    $users[] = [
        "id" =>time().rand(0,9999999),
        "login" => $login,
        "name" => $name,
        "surname" => $surname,
        "pass" => md5($pass),
        "mail" => $mail,
        "image" => "images/usericon.png"
    ];
    _auth_saveUsersArray($users);
}

function auth_login($current_user){
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