<?php
function model_visitors_getAll(){
    return core_loadArrayFromFile("visitors");
}

function model_visitors_getAllByConsult($consult_id){
    $visitors= model_consults_getAll();
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
        if(!$visitor["consult_id"]==$consult_id && !$visitor["student_id"]==$student_id ) $arr[]=$visitor;
    }
    core_saveArrayToFile("visitors",$arr);
}
