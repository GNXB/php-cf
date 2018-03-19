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


class authority {
  public static $level;

  public function __construct() {
    self::$level =& $_SESSION["__role"];
  }

  public static function set($author) {
    self::$level = $author;
  }
}

// Force Construct
new authority();
