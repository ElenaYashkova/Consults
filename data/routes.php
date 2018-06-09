<?php
return [
    "auth"=>[
        ""=>"auth@main_index",
        "logout"=>"auth@logout",

        "addNewGroup"=>"groups@addNewGroup",
        "getAllGroups"=>"groups@getAllGroups",

        "addNewStudent"=>"students@addNewStudent",
        "addNewVisitor"=>"main@addNewVisitor",

        "openConsult"=>"consults@openConsult",
        "getAllConsultVisitors"=>"visitors@getAllConsultVisitors"
    ],
    "notAuth"=>[
        ""=>"auth@login_index",
        "login"=>"auth@login",
        "reg"=>"auth@reg"
    ]
];