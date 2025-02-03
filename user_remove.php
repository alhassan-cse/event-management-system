<?php
include('connect/Connect.php');
include('app/UserController.php');
$user = new UserController;
$id = $_GET['id'];
$user->removeUser($_GET['id']);
?>