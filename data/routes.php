<?php
return [
    "auth"=>[
        ""=>"auth@main_index",
        "logout"=>"auth@logout",

        "addNewGroup"=>"groups@addNewGroup",
        "getAllGroups"=>"groups@getAllGroups",

        "getAllStudByGroup"=>"students@getAllStudByGroup",
        "addNewStudent"=>"students@addNewStudent",

        "openConsult"=>"consults@openConsult",
        "closeConsult"=>"consults@closeConsult",

        "addNewVisitor"=>"visitors@addNewVisitor",
        "getAllConsultVisitors"=>"visitors@getAllConsultVisitors",
        "delVisitor"=>"visitors@delVisitor"
    ],
    "notAuth"=>[
        ""=>"auth@login_index",
        "login"=>"auth@login",
        "reg"=>"auth@reg"
    ]
];