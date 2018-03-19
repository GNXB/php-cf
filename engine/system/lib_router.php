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

class router extends controller {
  public static $params = array();

  protected static function additional(&$app) {
    include $app;
  }
}
