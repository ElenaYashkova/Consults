<?php

function action_reg(){
    core_load_model("auth");
    if(is_empty(@$_POST["login"],@$_POST["pass"],@$_POST["email"]) || !auth_register($_POST["login"],$_POST["pass"],$_POST["email"])){
        echo "Произошла ошибка регистрации";
    }else{
        header("Location:".$_SERVER["HTTP_REFERER"]);
    }
}

function action_login(){
    if(is_empty(@$_POST["login"],@$_POST["pass"]) || !auth_login($_POST["login"],$_POST["pass"])){
        echo "Произошла ошибка авторизации";
    }else{
        echo "log";
        header("Location:".$_SERVER["HTTP_REFERER"]);
    }
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
