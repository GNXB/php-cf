<?php
/*!
 * GNXB PHP MySQL Database Manipulation Library
 * http://www.gnxb-columberg.com
 * Version 0.3.0-alpha
 *
 * Github: https://github.com/GNXB/gnxb.db.php
 * Reports bugs and issues
 *
 * Copyright 2018, Apiwith Potisuk
 * Released under the MIT license
 */

namespace gnxb;

use PDO;

class db {
  public static $conn;
  public static $stmt;

  public static function connect($dsn, $usr, $pwd) {
    static::$conn = new PDO($dsn, $usr, $pwd);
    static::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return TRUE;
  }

  public function __destruct() {
    static::$conn = null;
  }


  public static function prepare($query) {
    try {
      static::$stmt = static::$conn->prepare($query);
      return TRUE;

    } catch(Exception $e) {
      return $e;
    }
  }


  public static function execute() {
    try {
      static::$stmt->execute();
      return TRUE;

    } catch(Exception $e) {
      return $e;
    }
  }


  public static function fetch($data = array(), $fetchMode = NULL) {
    try {
      if (!$fetchMode) $fetchMode = PDO::FETCH_ASSOC;

      foreach ($data as $k => $r) {
        static::$stmt->bindParam(":".$k, $r);
      }
      static::$stmt->setFetchMode($fetchMode);
      static::$stmt->execute();
      return static::$stmt->fetchAll();
    } catch(Exception $e) {
      return $e;
    }
  }


  public static function bindParam($data = array()) {
    foreach ($data as $k => &$r) {
      static::$stmt->bindParam(":".$k, $r);
    }
  }


  private static function parser($values = array()) {
    foreach ($values as $k => $r) {
      $column[] = $k;
      $bind[] = ":".$k;
    }

    return [
      "column" => join(",", $column),
      "bind" => join(",", $bind)
    ];
  }


  public static function insert($table, $values = array()) {
    if (!$values) return FALSE;

    // Prepare array[][] data to string
    $parse = static::parser($values);
    $sql = "INSERT INTO $table ($parse[column]) VALUES ($parse[bind])";

    if (static::prepare($sql) === TRUE) {
      static::bindParam($values);
      static::execute();
      return TRUE;
    }

    return FALSE;
  }


  public static function update($table, $values = array(), $where = array(), $limit = "") {
    if (!$values) return FALSE;
    $sql = "UPDATE $table SET ";

    // SET
    foreach ($values as $k => $r) {
      $data[] = "$k = :$k";
    }
    $sql .= join(",", $data);

    // WHERE
    if ($where) {
      foreach ($where as $k => $r) {
        $clause[] = "$k = :$k";
      }
      $sql .= " WHERE " . join(" AND ", $clause);
    }

    // LIMIT
    if ($limit) $sql .= " LIMIT " . $limit;

    if (static::prepare($sql) === TRUE) {
      static::bindParam($values);
      static::bindParam($where);
      static::execute();
      return TRUE;
    }

    return FALSE;
  }


  public static function delete($table, $where = array(), $limit = "") {
    if (!$where) return FALSE;

    // WHERE
    $sql = "DELETE FROM $table";
    foreach ($where as $k => $r) {
      $clause[] = "$k = :$k";
    }
    $sql .= " WHERE " . join(" AND ", $clause);

    // LIMIT
    if ($limit) $sql .= " LIMIT " . $limit;

    if (static::prepare($sql) === TRUE) {
      static::bindParam($where);
      static::execute();
      return TRUE;
    }

    return FALSE;
  }


  public static function insert_id() {
    return static::$conn->insert_id;
  }
}
