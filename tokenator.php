<?php
/**
 * Tokenator
 * (c)2010 Ben Kulbertis <ben@kulbertis.org>
 *
 * Began Oct 19, 2010
*/

  class Tokenator {
    public static $DB_host;
    public static $DB_user;
    public static $DB_pass;
    public static $DB_name;
    public static $token;

    public static function generate() {
      $mysql = mysqli_connect(self::$DB_host, self::$DB_user, self::$DB_pass, self::$DB_name);
	    $token = md5(uniqid(mt_rand(), true));
	    $token = substr($token, 0, 32);
      $sql = "SELECT token FROM tokens WHERE token = '".$token."' LIMIT 1";
      $result = mysqli_query($mysql, $sql) or die(mysqli_error($mysql));
      if(!(mysqli_num_rows($result) == 0)) {
        $mysql->close();
        self::generate();
      } else {
        $sql = "INSERT INTO `".self::$DB_name."`.`tokens` (`ID`, `token`, `timestamp`) VALUES (NULL, '".$token."', NULL)";
        $result = mysqli_query($mysql, $sql) or die(mysqli_error($mysql));
        $mysql->close();
        return $token;
      }
    }

    public static function validate($token) {
      $mysql = mysqli_connect(self::$DB_host, self::$DB_user, self::$DB_pass, self::$DB_name);
      $sql = "SELECT `token` FROM `tokens` WHERE `token` = '".$token."'";
      $result = mysqli_query($mysql, $sql) or die(mysqli_error($mysql));
      if(mysqli_num_rows($result) == 1) {
        $sql = "DELETE FROM `tokens` WHERE `token` = '".$token."'";
        $result = mysqli_query($mysql, $sql) or die(mysqli_error($mysql));
        $mysql->close();
        return true;
      } else {
        $mysql->close();
        return false;
      }
    }
  }
?>
