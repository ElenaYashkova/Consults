<?php

function core_navigate(){
    //include LIBS_PATH . "auth.php";
    if(auth_is_auth()){
        core_render("main");
    }
    else core_render("main");
}


function core_saveArrayToFile($name, array $arr){
    $jsonstr = json_encode($arr);
    $path = STORAGE_PATH."{$name}.json";
    file_put_contents($path,$jsonstr);
};

function core_loadArrayFromFile($name) {
    $path = STORAGE_PATH."{$name}.json";
    if(!file_exists($path))return[];
    $data = file_get_contents($path);
    return json_decode($data,true);
};

function core_appendToArrayInFile(string $name, $data):void{
    $arr = core_loadArrayFromFile($name);
    $arr[] = $data;
    core_saveArrayToFile($name,$arr);
};

function core_removeFromArrayInFile($name, $index):void{
    $arr = core_loadArrayFromFile($name);
    array_splice($arr,$index);
    core_saveArrayToFile($name,$arr);
};

function core_render($view, $data=[], $templates="default"){       //шаблонизировать
    $content = VIEWS_PATH.$view.".php";
    extract($data);
    include TEMPLATES_PATH.$templates.".php";
}

function is_empty():bool {
    foreach (func_get_args() as $arg) if(empty($arg)) return true;
    return false;
}

//function core_register(){
//    $regexparr = [
//        "login"=>'/^\w{2,12}$/',
//        "password"=>'/^\S{6,16}$/'
//    ];
//
//    foreach ($regexparr as $key=>$val){
//        if (preg_match($val,$_POST[$key])){
//
//        }
//    }
//}