<?php

function model_group_getAll(){
     return core_loadArrayFromFile("group");
}

function _group_saveGroupsArray($groups){
    core_saveArrayToFile("group",$groups);
}

function model_group_add($name){
    $groups = model_group_getAll();
    $name = trim(strtoupper($name), " ");
    foreach ($groups as $group) if ($group["name"] == $name) return false;
    $groups[] = [
        "id" => time() . rand(0, 999),
        "name" => $name
    ];
    _group_saveGroupsArray($groups);
    return true;
}

function model_group_getById($id){
    $groups=model_group_getAll();
    foreach($groups as $group) if($group["id"]==$id) return $group;
    return NULL;
}