<?php
include('connect/Connect.php');
include('app/UserController.php');
$user = new UserController;
$id = $_GET['id'];
$status = $_GET['status'];
$user->statusUser($_GET['id'], $status);
?>