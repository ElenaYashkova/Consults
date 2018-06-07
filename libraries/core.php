<?php

function core_getData(string $name){
    return include DATA_PATH.$name.".php";
}

function core_saveArrayToFile($name, array $arr):void{
    $jsonstr = json_encode($arr);
    $path = STORAGE_PATH."{$name}.json";
    file_put_contents($path,$jsonstr);
};

function core_loadArrayFromFile($name):array {
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

function core_render($view, array $data=[], $templates="default"):void{
    $content = VIEWS_PATH.$view.".php";
    extract($data);
    include TEMPLATES_PATH.$templates.".php";
}

function core_load_model(string $name):void{
    include MODELS_PATH.$name.".php";
}

function is_empty():bool {
    foreach (func_get_args() as $arg) if(empty($arg)) return true;
    return false;
}

function core_navigate(){
    $routs=core_getData("routes");
    if(auth_is_auth()) $routs=$routs["auth"];
    else $routs=$routs["notAuth"];
    $url=trim(explode("?",$_SERVER["REQUEST_URI"])[0],"/");
    $prefix="PROGECT/Consults/";
    foreach ($routs as $route=>$command){
        if(trim($prefix.$route, "/")==$url){
            $cmd=explode("@", $command);
            $controller_name=$cmd[0]."_controller";
            $action_name="action_".$cmd[1];
            if(!file_exists(CONTROLLERS_PATH.$controller_name.".php")){
                echo "file".CONTROLLERS_PATH.$controller_name.".php"." not exist";
            };
            include CONTROLLERS_PATH.$controller_name.".php";
            if(!function_exists($action_name)) {
                echo "function".$action_name." not exist";
            };
            call_user_func($action_name);
            return;
        }
    }
    echo "404";
}