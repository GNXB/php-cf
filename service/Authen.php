<?php

class Authen {
  public function __construct() {}


  public static function login() {
    authority::set("admin");
  }


  public static function logout() {
    session_destroy();
  }
}
