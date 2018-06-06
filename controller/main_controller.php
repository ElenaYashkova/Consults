<?php
function action_addNewGroup(){
    core_load_model("grupp");
    if(is_empty(@$_POST["grupName"])) echo "vvedite group's name";
    else{
        model_group_add(@$_POST["grupName"]);
        header("Location:".$_SERVER["HTTP_REFERER"]);
    }
}

function action_getAllGroups(){
    core_load_model("grupp");
    $groups=model_group_getAll();
}

function action_addNewStudent(){
    core_load_model("students");
    if(is_empty(@$_POST["group"],@$_POST["name"],@$_POST["surname"])){
        echo "Заполните все поля!";
        return;
    }
    model_students_add(@$_POST["group"],@$_POST["name"],@$_POST["surname"]);
    header("Location:".$_SERVER["HTTP_REFERER"]);
}

function action_addNewVisitor(){
    //TODO create arr [id_consult, id_stud]
    core_load_model("students");
    if(is_empty(@$_POST["student"])){
        echo "Заполните все поля!";
        return;
    }
    $data=model_students_getById(@$_POST["student"]);
    core_appendToArrayInFile("visitors", $data);
    header("Location:".$_SERVER["HTTP_REFERER"]);
}

