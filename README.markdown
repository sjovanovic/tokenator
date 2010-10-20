Tokenator
=========

## License:

Dual licensed under MIT or GPL Version 2.0 by Ben Kulbertis

## Description:

A PHP library that makes using token based authentication easy. Ask for a new token and you recieve a random md5 hash as a token, pass that token back through to
validate and it simply returns true if the token is valid, and false if it is not. It can be used for web applications, or used for web integrated applications
for validating exchanging data. Its designed to be simple to use, and just work.

## Requirements:

  1. PHP 5
  2. A MySQL database (new or used)

## Usage:

  1. Get a MySQL database. You do not need a new database to do this, as long as the database you connect to does not have a table called `tokens` already.
  2. Run the SQL code from `table-create.sql` in phpmyadmin (or whatever you use) to create the table to be used in the database. Be sure to change `DB_name` in
     the first line to the name of your database.
  3. Add `require('/path/to/tokenator.php');` to the page that you are going to use Tokenator on.
  4. Give Tokenator the DB information by setting `$DB_host`, `$DB_user`, `$DB_pass`, and `$DB_name`.
  5. Set up your token authentication scheme! Examples below to provide usage.

## Functions:

### generate &mdash; Creates a 32 character md5 token

`boolean generate()`
<pre>
  $token = Tokenator::generate();
  echo $token;
</pre>
will output something like:

`3821ecfee8ee49a76f1e65639af3ac95`

### validate &mdash; Checks if the passed token is in the database

`boolean validate($token)`
<pre>
  $valid = Tokenator::validate($token);
  if($valid)
    echo 'true';
  else
    echo 'false';
</pre>
If the token is valid will print:

`true`

And will print the following if invalid:

`false`

## Examples:

<pre>
  require("tokenator.php");

  Tokenator::$DB_host = 'localhost';
  Tokenator::$DB_user = 'root';
  Tokenator::$DB_pass = 'password';
  Tokenator::$DB_name = 'tokenator';

  $token = Tokenator::generate();
  echo $token;

  echo "\n";
  
  $valid = Tokenator::validate($token);
  if($valid)
    echo 'true';
  else
    echo 'false';
</pre>
This would simply create a token, print the token, verify it and print whether or not it exists (which should always be true here).

## More Help/Questions:

[ben@kulbertis.org](mailto:ben@kulbertis.org)
