<?php
session_start();
unset($_SESSION['account']);
unset($_SESSION['name']);
header("Location: ../website/library.php");
?>