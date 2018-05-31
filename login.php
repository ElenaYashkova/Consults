<?php
auth_login($_POST("login"),$_POST("pass"));
header("Location:".$_SERVER["HTTP_REFERER"]);