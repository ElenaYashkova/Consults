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
    echo json_encode($groups);
}