<?php

function sanitizeInput($data) {
    return trim(htmlspecialchars(strip_tags(stripslashes($data))));
}