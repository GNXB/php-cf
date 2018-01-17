<?php

class router extends controller {
  public static $params = array();

  protected static function additional(&$app) {
    include $app;
  }
}
