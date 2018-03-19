<?php

include_once SERVICE . "/Authen.php";

switch (router::$params[1]) {
  case "login":
    Authen::login();
    break;

  case "logout":
    Authen::logout();
    break;
}

header("Location: /");
exit();
