<!-- this file is created by Breno Oliveira -->
<?php
session_start();

function is_logged_in(): bool
{
    return !empty($_SESSION['owner_logged_in']);
}

function require_login(): void
{
    if (!is_logged_in()) {
        header("Location: login.php");
        exit;
    }
}
