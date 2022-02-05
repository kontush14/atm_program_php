<?php
    // We connect the RedBeanPHP library
    require "libs/rb.php";

    // We connect to the database
    R::setup( 'mysql:host=localhost;dbname=atm_db',
            'root', '' );

    // Checking the connection to the database
    if(!R::testConnection()) die('No DB connection!');

    session_start(); // Create a session for authorization
?>