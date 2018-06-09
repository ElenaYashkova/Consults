<?php

function model_students_getAll(){
    return core_loadArrayFromFile("student");
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

function model_students_getAllByIdGroup($id_group){
    $students=model_students_getAll();
    $arr=[];
    foreach ($students as $student){
        if(!$student["id_group"]==$id_group) $arr[]=$student;
    }
    return $arr;
}

function model_students_getById($id){
    $students=model_students_getAll();
    return array_shift(array_filter($students, function ($student) use ($id){
        return $student["id"]==$id;
    }));
}
function model_students_deleteById($id){
    $students=model_students_getAll();
    $arr=[];
    foreach ($students as $student){
        if(!$student["id"]==$id) $arr[]=$student;
    }
    core_saveArrayToFile("student",$arr);
}

function model_students_existInGroup(){
    //TODO check name and surname in this group
}
