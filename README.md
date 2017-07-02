html5chat
=========

## About 
Chat based of Html5, Ajax, Php and Css3 + Mysql - database

## How to use it?
To use this, you have to change the 'config.php' file in the 'inc' directory.

```php

<?php

$server    = 'localhost'; //Insert your hostname

$user    = 'user'; //Insert MySQL username

$pass    = 'password'; //Insert MySQL password

$db    = 'chat'; //Insert database name

$table    = 'chattext'; //Insert table name

mysql_connect($server, $user, $pass);

mysql_select_db($db);

?> 

```