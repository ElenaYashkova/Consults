<?php

function action_addNewGroup(){
    core_load_model("grupp");
    if(is_empty(@$_POST["name"])){
        echo "no";
        return;
    }
    model_group_add(@$_POST["name"]);
    echo "yes";

}

function action_getAllGroups(){
    core_load_model("grupp");
    $groups=model_group_getAll();
    echo json_encode($groups);
}