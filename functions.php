<?php

function sanitizeInput($data) {
    return trim(htmlspecialchars(strip_tags(stripslashes($data))));
}

function generateID($last_name, $reg_date) {
    // Get the first three letters of the last name.
    $first = substr(trim($last_name), 0, 3);

    // Get the registration date and format as ddMMMYYYY
    $second = date_format(date_create($reg_date), "dMY");
    $third = str_pad(rand(0, pow(10, 5) - 1), 5, "0", STR_PAD_LEFT);

    $id = strtoupper($first . "-" . $second . "-" . $third);

    return $id;
}