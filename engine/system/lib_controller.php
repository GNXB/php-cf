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

class controller {
  const DEFAULT_ROUTE = "__DEFAULT_ROUTER__";

  public static $activated = FALSE;
  protected static $params = array();

  protected static function main($mode, &$regex, &$app) {
    if (!self::$activated) {
      if ($mode == "REQ" || $_SERVER["REQUEST_METHOD"] == $mode) {
        $_path = isset($_GET["__path"]) ? $_GET["__path"] : "/";
        if (preg_match("#".$regex."#", $_path, $list)) {
          self::$activated = TRUE;
          static::$params = &$list;

          static::additional($app);

          return $list;
        }
      }

      return FALSE;
    }
  }

  protected static function additional($app) {
    // Overwrite in child class
  }

  public static function get($regex, $app) {
    return static::main("GET", $regex, $app);
  }


  public static function post($regex, $app) {
    return static::main("POST", $regex, $app);
  }


  public static function request($regex, $app) {
    return static::main("REQ", $regex, $app);
  }


  public static function hasParams() {
    return (static::$params[0]) ? TRUE : FALSE;
  }



  // Authority Section
  public static function authorization($id = "", $list = array()) {
    if (!count($list)) {
      $list[self::DEFAULT_ROUTE] = DEFAULT_ROUTER;
    }

    // Role doesn't match to anything in $list
    if (!isset($list[$id])) {
      // and don't have defualt defined
      if (!isset($list[self::DEFAULT_ROUTE])) {
        $list[self::DEFAULT_ROUTE] = DEFAULT_ROUTER;
      }

      $id = self::DEFAULT_ROUTE;
    }

    include_once $list[$id];
  }
}
