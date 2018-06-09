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
    foreach ($students as $student){
        $student["group_name"]=model_group_getById($student["id_group"])["name"];
    }
    echo json_encode($students);
}
