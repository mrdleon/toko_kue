<?php
session_start();

// Jika session 'login' tidak ada (belum login), tendang ke login.php
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit; 
}
?>