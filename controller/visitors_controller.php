<?php

function action_getAllConsultVisitors(){
    $consult_id=@$_POST["consult_id"];
    core_load_model("visitors");
    core_load_model("students");
    core_load_model("grupp");
    $visitors=model_visitors_getAllByConsult($consult_id);
    $students=array_map(function ($visitor){
        return model_students_getById($visitor["student_id"]);
    },$visitors);
    $arr=[];
    foreach ($students as $student){
        $student["group_name"]=model_group_getById($student["id_group"])["name"];
        $arr[]=$student;
    }
    echo json_encode($arr);
}

//function action_addNewVisitor(){
//    core_load_model("visitors");
//    if(empty(@$_POST["student_id"]) || empty(@$_POST["consult_id"])){
//        echo "no";
//        return;
//    }else{
//        model_visitors_add(@$_POST["consult_id"],@$_POST["student_id"]);
//        echo "yes";
//    }
//}
function action_addNewVisitor(){
    core_load_model("visitors");
    if(empty(@$_POST["student_id"]) || empty(@$_POST["consult_id"])){
        echo "no";
        return;
    }else{
        if(model_visitors_notExist(@$_POST["consult_id"],@$_POST["student_id"])===false){
            echo "exist";
            return;
        }else{
            model_visitors_add(@$_POST["consult_id"],@$_POST["student_id"]);
            echo "yes";
        }


    }
}

function action_delVisitor(){
    core_load_model("visitors");
    if(is_empty(@$_POST["consult_id"], @$_POST["student_id"])){
        echo"error";
        return;
    }
    model_visitors_delete(@$_POST["consult_id"], @$_POST["student_id"]);
    echo "yes";
}
