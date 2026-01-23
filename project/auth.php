<!-- this file is created by Breno Oliveira -->
<?php
session_start();

function is_logged_in(): bool // check if user is logged in
{
    return !empty($_SESSION['owner_logged_in']);
}

function require_login(): void // redirect to login if not logged in
{
    if (!is_logged_in()) {
        header("Location: login.php");
        exit;
    }
}
