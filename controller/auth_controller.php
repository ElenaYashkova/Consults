<?php

function action_reg(){
    //core_load_model("auth");
    $users = _auth_getUsersArray();
    foreach ($users as $user) {
        if ($user["login"] == $_POST["login"]) {echo "loginexist"; return false;}
    }
    if(is_empty(@$_POST["login"],@$_POST["name"],@$_POST["surname"],@$_POST["pass"],@$_POST["mail"])) {echo "fieldempty"; return false;}
    if(!preg_match("/^\w{2,20}$/i",$_POST["login"])) {echo "logininvalid"; return false;} // Логин должен сожержать только буквы и цифры от 2 до 20 символов
    if(!preg_match("/^\S{6,20}$/i",$_POST["pass"])) {echo "passinvalid"; return false;} // Пароль должен содержать от 6 до 20 символов
    if(!preg_match("/^\S+@\w+(.\w+)+$/i",$_POST["mail"])) {echo "mailinvalid"; return false;} // Неправильный адресс электронной почты

    auth_register($_POST["login"],@$_POST["name"],@$_POST["surname"],$_POST["pass"],$_POST["mail"]);

    header("Location:".$_SERVER["HTTP_REFERER"]);
    return "ok";
}

function action_login(){
    if(is_empty(@$_POST["login"],@$_POST["pass"])) {echo "fieldempty"; return false;}
    $users = _auth_getUsersArray();
    $current_user = NULL;
    foreach ($users as $user) {
        if ($user["login"] == $_POST["login"]) {
            $current_user = $user;
            break;
        }
    }
    if ($current_user === NULL) {echo "nologin"; return false;}
    if($current_user["pass"]!==md5($_POST["pass"])) {echo "nopass"; return false;}
    auth_login($current_user);
    header("Location:".$_SERVER["HTTP_REFERER"]);
    echo "ok";
}

function action_logout(){
    auth_logout();
    header("Location:".$_SERVER["HTTP_REFERER"]);
}

function action_main_index(){
    core_render("main", ["title"=>"Consults::Main"], $templates="default");
}

function action_login_index(){
    core_render("login", ["title"=>"Consults::Login"], $templates="default");
}

function action_mail(){
    core_load_model("mail");
    var_dump(model_mail_get_pass($_POST["login"]));
}
