<?php
include('connect/Connect.php');
include('app/EventController.php');
$event = new EventController;
$id = $_GET['id'];
$status = $_GET['status'];
$event->statusEvent($_GET['id'], $status);
?>