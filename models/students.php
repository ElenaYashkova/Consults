<?php

function model_students_getAll(){
    return core_loadArrFromFile("student");
}

function model_students_add($id_group,$name,$surname){
    core_appendToArrayInFile("student",[
        "id"=>time()."_".rand(0, 9999),
        "name"=>ucfirst(strtolower($name)),
        "surname"=>ucfirst(strtolower($surname)),
        "id_group"=>$id_group
    ]);
}
function model_students_getByIdGroup($id_group){
    $students=model_students_getAll();
    return array_filter($students, function ($student) use ($id_group){
        return $student["id_group"]==$id_group;
    });
}

