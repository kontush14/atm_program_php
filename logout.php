<?php 
    require __DIR__ . '/header.php'; // add project header
    require "config/db.php"; // connect file to connect to database

    // Log out the user
    unset($_SESSION['logged_user']);

    // Redirect to main page
    header('Location: index.php');

    require __DIR__ . '/footer.php'; // Connect the footer of the project
?>