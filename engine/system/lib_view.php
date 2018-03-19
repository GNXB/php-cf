<?php

/**
 * PHP Conceptual Framework
 *
 *
 * Created on January 12, 2018
 *
 * @version 0.7-alpha
 * @author Apiwith Potisuk <po.apiwithd@gmail.com>
 * @copyright GNXB.Columnberg - Copyright(c) 2018, All rights reserved.
 * @license MIT License
 *
 */


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
    if (!controller::$activated) {
      self::$layout = $name;
    }
  }


  protected static function additional(&$app) {
    self::$content = $app;
    include self::$layout;
  }
}
