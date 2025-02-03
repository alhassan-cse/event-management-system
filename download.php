<?php
include('connect/Connect.php');
include('app/EventController.php');
$event = new EventController;
$id = $_GET['id'];
$event->downloadEvent($_GET['id']);
?>