<?php

    session_start();
  // Assign file paths to PHP constants
  // __FILE__ returns the current path to this file
  // dirname() returns the path to the parent directory
  define("PRIVATE_PATH", dirname(__FILE__));

  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", '/public');
  define("SHARED_PATH", PRIVATE_PATH . '/shared');

  // Assign the root URL to a PHP constant
  // * Do not need to include the domain
  // * Use same document root as webserver
  // * Can set a hardcoded value:
  define("WWW_ROOT", '');

  require_once('func_files/functions.php');
  require_once('func_files/db_functions.php');


?>