<?php
function model_consults_getAll(){
    return core_loadArrayFromFile("consults");
}

function model_consults_getAllByUser($user_id){
    $consults= model_consults_getAll();
    $arr=[];
    foreach ($consults as $consult){
        if($consult["user_id"]==$user_id) $arr[]=$consult;
    }
    return $arr;
}

function model_consults_create($user_id){
    core_appendToArrayInFile("consults",[
        "id"=>time()."_".rand(0, 99999),
        "name"=>date('d.m.Y_H:i'),
        "user_id"=>$user_id,
        "status"=>"open"
    ]);
}
function model_consults_getByStatus($status,$user_id){
    $consults=model_consults_getAllByUser($user_id);
    foreach ($consults as $consult){
        if($consult["status"]==$status) return $consult;
    }
    return NULL;
}
function model_consults_close($id){
    $consults=model_consults_getAll();
    $arr=[];
    foreach ($consults as $consult){
        if($consult["id"]==$id){
            $consult["status"]="close";
            $arr[]=$consult;
        }
        $arr[]=$consult;
    }
    core_saveArrayToFile("consults",$arr);
}

function model_consults_getById($id){
    $consults=model_consults_getAll();
    return array_shift(array_filter($consults, function ($consult) use ($id){
        return $consult["id"]==$id;
    }));
}
function model_consults_deleteById($id){
    $consults=model_consults_getAll();
    $arr=[];
    foreach ($consults as $consult){
        if(!$consult["id"]==$id) $arr[]=$consult;
    }
    core_saveArrayToFile("consults",$arr);
}


