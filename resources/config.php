<?php
// Output buffer and session started
ob_start();
session_start();

// Defines direct paths into back and front template folders as well as images folder.
defined ("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
defined ("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front");
defined ("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back");
defined ("IMG_DIR") ? null : define("IMG_DIR", __DIR__ . DS . "img");

// Defines information for database connection.
defined ("DB_HOST") ? null : define("DB_HOST", "localhost");
defined ("DB_USER") ? null : define("DB_USER", "ryansoltes");
defined ("DB_PASS") ? null : define("DB_PASS", "Twook458");
defined ("DB_NAME") ? null : define("DB_NAME", "soltesr1_CSIT_355_F16");

// Defines connection to the database.
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Requires functions and cart so all pages that require config also require functions and cart.
require_once("functions.php");
require_once("cart.php");

?>
