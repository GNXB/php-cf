<?php

session_start();

require_once ROOT . "/engine/global.php";
require_once ENGINE . "/system/lib_authority.php";
require_once ENGINE . "/system/lib_controller.php";
require_once ENGINE . "/system/lib_router.php";
require_once ENGINE . "/system/lib_view.php";

// require_once LIBRARY . "/gnxb.db.php";

// DB Defination goes here
// class db extends \gnxb\db {}
// db::connect("mysql:host=127.0.0.1;dbname=example", "root", "password");

// Core Router Configuation goes here
controller::authorization(
  authority::$level,
  [
    "admin" => CONTROLLER . "/admin.router.php"
  ]
);
