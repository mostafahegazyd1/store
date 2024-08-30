<?php

$template = "includes/template/"; // template directory
$classes = "includes/classes/"; // classes directory 
$pages = "pages/"; // pages directory

require_once $classes . "db.php"; // connection to the database variable to use
include $classes . 'session.php'; // include session class 
include $classes . 'validation.php';

$session = new Session(); // set object for session class 
$connection = (new Connection())->connectionDB(); // database connection from Connection class in -> (includes/classes/db.php)

include $template . "header.php";
if (isset($navbar)):
    include $template . "navbar.php";
endif;