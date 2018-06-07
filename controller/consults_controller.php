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