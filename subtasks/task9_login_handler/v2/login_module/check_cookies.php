<?php

include_once("CookieHandler.php");

echo "user name: " . CookieHandler::isSetCookie("user_name");
echo "password: " . CookieHandler::isSetCookie("password");

?>