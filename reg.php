<?php
auth_register($_POST("login"),$_POST("pass"),$_POST("email"));
header("Location:".$_SERVER["HTTP_REFERER"]);