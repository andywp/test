<?php
session_start();
if(!isset($_SESSION['akses'])){
header("Location:index.html?page=".base64_encode($_SERVER["REQUEST_URI"]));
}
?>
