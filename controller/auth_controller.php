<?php

function action_reg(){
    //core_load_model("auth");
    $users = _auth_getUsersArray();
    foreach ($users as $user) {
        if ($user["login"] == $_POST["login"]) {
            echo "loginexist";
            core_back();
            return false;
        }
    }
    if(is_empty(@$_POST["login"],@$_POST["name"],@$_POST["surname"],@$_POST["pass"],@$_POST["mail"])) {
        echo "fieldempty"; // Поле пустое
        core_back();
        return false;
    }
    if(!preg_match("/^\w{2,20}$/i",$_POST["login"])) {
        echo "logininvalid"; // Логин должен сожержать только буквы и цифры от 2 до 20 символов
        core_back();
        return false;
    }
    if(!preg_match("/^\S{6,20}$/i",$_POST["pass"])) {
        echo "passinvalid"; // Пароль должен содержать от 6 до 20 символов
        core_back();
        return false;
    }
    if(!preg_match("/^\S+@\w+(.\w+)+$/i",$_POST["mail"])) {
        echo "mailinvalid"; // Неправильный адресс электронной почты
        core_back();
        return false;
    }

    auth_register($_POST["login"],@$_POST["name"],@$_POST["surname"],$_POST["pass"],$_POST["mail"]);

    core_back();
    return "ok";
}

function action_login(){
    if(is_empty(@$_POST["login"],@$_POST["pass"])) {
        echo "fieldempty";
        core_back();
        return false;
    }
    $users = _auth_getUsersArray();
    $current_user = NULL;
    foreach ($users as $user) {
        if ($user["login"] == $_POST["login"]) {
            $current_user = $user;
            break;
        }
    }
    if ($current_user === NULL) {
        echo "nologin";
        core_back();
        return false;
    }
    if($current_user["pass"]!==md5($_POST["pass"])) {
        echo "nopass";
        core_back();
        return false;
    }
    auth_login($current_user);
    echo "ok";
    core_back();
}

function action_logout(){
    auth_logout();
    core_back();
}

function action_main_index(){
    core_render("main", ["title"=>"Consults::Main"], $templates="default");
}

function action_login_index(){
    core_render("login", ["title"=>"Consults::Login"], $templates="default");
}

function action_mail(){
    core_load_model("mail");
//    model_mail_get_pass($_POST["login"]);
}
