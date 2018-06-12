<?php
function action_openConsult(){
    core_load_model("consults");
    $user_id=@$_SESSION["user_id"];
    if(model_consults_getByStatus("open",$user_id)==NULL){
        model_consults_create($user_id);
        $c= model_consults_getByStatus("open", $user_id);
    }else $c= model_consults_getByStatus("open", $user_id);
    echo json_encode($c);

}

function action_closeConsult(){
    core_load_model("consults");
    model_consults_close(@$_POST["id"]);
    header("Location:".$_SERVER["HTTP_REFERER"]);
}
function action_getAllByUser(){
    core_load_model("consults");
    $user_id=@$_SESSION["user_id"];
    $consults=model_consults_getAllByUser($user_id);
    echo json_encode($consults);
}
function action_deleteConsult(){
    core_load_model("consults");
    if(is_empty(@$_POST["id"])){
        echo "no";
        return;
    }
    model_consults_deleteById(@$_POST["id"]);
    echo "yes";
}

function action_getDetails(){
    core_load_model("consults");
    if(is_empty(@$_POST["id"])){
        echo "no";
        return;
    }
    $consult=model_consults_getById(@$_POST["id"]);
    echo json_encode($consult);
}