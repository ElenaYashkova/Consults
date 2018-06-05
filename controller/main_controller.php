<?php
function addNewGroup(){
    core_load_model("grupp");
    if(is_empty(@$_POST["grupName"])) echo "vvedite group's name";
    else{
        model_group_add(@$_POST["grupName"]);
        header("Location:".$_SERVER["HTTP_REFERER"]);
    }
}

function getAllGroups(){
    core_load_model("grupp");
    $groups=model_group_getAll();
}

function addNewStudent(){
    core_load_model("students");
//    $id_group=@$_GET["group"];
    if(is_empty(@$_POST["group"],@$_POST["name"],@$_POST["surname"])){
        echo "Заполните все поля!";
        return;
    }
    model_students_add(@$_POST["group"],@$_POST["name"],@$_POST["surname"]);
    header("Location:".$_SERVER["HTTP_REFERER"]);
}

