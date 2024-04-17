<?php

// This file connects the project to the database.

// Replace "b70ebd" with your database name.
$conn = new mysqli("localhost", "root", "", "b70ebd");

if (!$conn) {
    echo "Connection failed.";
    die();
}