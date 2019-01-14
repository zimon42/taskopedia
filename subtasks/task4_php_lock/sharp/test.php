<?php

include_once("LockHandler.php");

LockHandler::lock();

sleep(10);

LockHandler::unlock();

?>