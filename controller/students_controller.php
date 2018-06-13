<?php
function action_addNewStudent(){
    core_load_model("students");
    if(is_empty(@$_POST["group"],@$_POST["name"],@$_POST["surname"])){
        echo "no";
        return;
    }
    model_students_add(@$_POST["group"],@$_POST["name"],@$_POST["surname"]);
    echo "yes";

}
function action_getAllStudByGroup(){
    core_load_model("students");
    $group_id=@$_POST["group_id"];
    if(empty($group_id)){
        echo "[]";
        return;
    }
    $students=model_students_getAllByIdGroup($group_id);
    echo json_encode($students);
}

