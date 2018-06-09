<?php
function action_addNewStudent(){
    core_load_model("students");
    if(is_empty(@$_POST["group"],@$_POST["name"],@$_POST["surname"])){
        echo "Заполните все поля!";
        return;
    }
    model_students_add(@$_POST["group"],@$_POST["name"],@$_POST["surname"]);
    //todo

}
function action_getAllStudByGroup(){
    core_load_model("students");
    $id_group=@$_POST["id_group"];
    if(empty($id_group)) echo "[]";
    $students=model_students_getAllByIdGroup($id_group);
    echo json_encode($students);
}

