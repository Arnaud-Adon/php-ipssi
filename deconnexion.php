<?php
session_start();

if(isset($_GET['deco'] ) && $_GET['deco'] == 1) {
    session_destroy();
    header('Location:index.php');
    exit;
}
?>