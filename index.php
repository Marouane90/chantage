<?php
$errors = [];
$db = mysqli_connect("192.168.1.62","chantage","chantage","chantage");
session_start();
$access = [ "login", "register", "create_message", "messages", "message"];
$page = "login";
if (isset($_GET['page']) && in_array($_GET['page'], $access))
{
    $page = $_GET['page'];
}
require('apps/traitement_messages.php');
require('apps/traitement_users.php');
require('apps/skel.php');

?>