<?php
session_start();

if (!isset($_SESSION['test'])) {
    if ($_SESSION['test'] != 'test_session_value') {
        header('location: temporary_login.php');
        exit();
    }
}
