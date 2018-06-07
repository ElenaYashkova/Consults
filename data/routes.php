<?php
return [
    "auth"=>[
        ""=>"auth@main_index",
        "logout"=>"auth@logout",
        "addNewGroup"=>"main@addNewGroup",
        "addNewStudent"=>"main@addNewStudent",
        "addNewVisitor"=>"main@addNewVisitor",
        "openConsult"=>"consults@openConsult"
    ],
    "notAuth"=>[
        ""=>"auth@login_index",
        "login"=>"auth@login",
        "reg"=>"auth@reg"
    ]
];