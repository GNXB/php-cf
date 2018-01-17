<?php

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
