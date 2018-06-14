<?php
function model_visitors_getAll(){
    return core_loadArrayFromFile("visitors");
}

function model_visitors_getAllByConsult($consult_id){
    $visitors= model_visitors_getAll();
    $arr=[];
    foreach ($visitors as $visitor){
        if($visitor["consult_id"]==$consult_id) $arr[]=$visitor;
    }
    return $arr;
}

function model_visitors_add($consult_id,$student_id){
    core_appendToArrayInFile("visitors",[
        "consult_id"=>$consult_id,
        "student_id"=>$student_id
    ]);
}

function model_visitors_delete($consult_id,$student_id){
    $visitors=model_visitors_getAll();
    $arr=[];
    foreach ($visitors as $visitor){
        if($visitor["consult_id"]!==$consult_id) $arr[]=$visitor;
        if($visitor["consult_id"]===$consult_id){
           if($visitor["student_id"]!== $student_id) $arr[]=$visitor;
        }
    }
    core_saveArrayToFile("visitors",$arr);
}

function model_visitors_deleteByConsult($consult_id){
    $visitors=model_visitors_getAll();
    $arr=[];
    foreach ($visitors as $visitor){
        if($visitor["consult_id"]!==$consult_id) $arr[]=$visitor;
    }
    core_saveArrayToFile("visitors",$arr);
}

function model_visitors_notExist($consult_id,$student_id){
    $visitors=model_visitors_getAllByConsult($consult_id);
    foreach ($visitors as $visitor){
        if($visitor["student_id"]===$student_id) return false;
    }
    return true;
}
