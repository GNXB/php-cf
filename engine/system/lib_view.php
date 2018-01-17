<?php

// lib_controller must be included before this file

class view extends controller {
  public static $params = array();

  public static $layout;
  public static $content;
  public static $title;

  public static function setTitle($name) {
    self::$title = $name;
  }


  public static function layout($name) {
    self::$layout = $name;
  }


  protected static function additional(&$app) {
    self::$content = $app;
    include self::$layout;
  }
}
