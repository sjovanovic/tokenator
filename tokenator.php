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

    // Generate a token for use, place it in the database, and return the token.
    public static function generate() {
      $mysql = mysqli_connect(self::$DB_host, self::$DB_user, self::$DB_pass, self::$DB_name);
	    $token = md5(uniqid(mt_rand(), true)); // Generate md5 hash. Gets a random number, gets the uniqid of that number, then md5 hashes that 
	    $token = substr($token, 0, 32); // Shorten md5 to 32 characters.
      $sql = "SELECT token FROM tokens WHERE token = '".$token."' LIMIT 1";
      $result = mysqli_query($mysql, $sql) or die(mysqli_error($mysql));
      if(!(mysqli_num_rows($result) == 0)) { // Make sure that by some chance, the token is not a duplicate of one that is already in the database.
        $mysql->close();
        self::generate(); // If there is a duplicate, run the generator again.
      } else {
        $sql = "INSERT INTO `".self::$DB_name."`.`tokens` (`ID`, `token`, `timestamp`) VALUES (NULL, '".$token."', NULL)"; // Add the token to the DB.
        $result = mysqli_query($mysql, $sql) or die(mysqli_error($mysql));
        $mysql->close();
        return $token;
      }
    }

    // Validate a token, takes a variable that is the token to be validated.
    public static function validate($token) {
      $mysql = mysqli_connect(self::$DB_host, self::$DB_user, self::$DB_pass, self::$DB_name);
      $sql = "SELECT `token` FROM `tokens` WHERE `token` = '".$token."'"; // Finds if there is a token match in the database.
      $result = mysqli_query($mysql, $sql) or die(mysqli_error($mysql));
      if(mysqli_num_rows($result) == 1) { // If there is a matching token...
        $sql = "DELETE FROM `tokens` WHERE `token` = '".$token."'"; // Delete the token from the database, it has been returned and is no longer needed.
        $result = mysqli_query($mysql, $sql) or die(mysqli_error($mysql));
        $mysql->close();
        return true; // The token was matched successfully, return true!
      } else {
        $mysql->close();
        return false; // The token was not matched and is invalid, return false.
      }
    }
  }
?>
