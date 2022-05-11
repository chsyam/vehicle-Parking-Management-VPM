<?php
session_start();
if (!isset($_SESSION['uemail'])) {
    header("location:index.php");
    exit();
}
