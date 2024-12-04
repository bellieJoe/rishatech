<?php

session_start();

// Generate CSRF token if not already set
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generate a random token

}

// Remove tags and encode special characters
function sanitizeInput($input) {
    
    return htmlspecialchars(strip_tags($input));
}


?>