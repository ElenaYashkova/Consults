<?php




function action_addNewVisitor(){
    //TODO create arr [id_consult, id_stud]
    core_load_model("students");
    if(is_empty(@$_POST["student"])){
        echo "Заполните все поля!";
        return;
    }
    $data=model_students_getById(@$_POST["student"]);
    core_appendToArrayInFile("visitors", $data);
    header("Location:".$_SERVER["HTTP_REFERER"]);
}

