<?php
$errors = [];
$db = mysqli_connect("192.168.1.62","chantage","chantage","chantage");
session_start();
$access = [ "login", "register", "create_message", "messages", "conected"];
$page = "login";
if (isset($_GET['page']) && in_array($_GET['page'], $access))
{
    $page = $_GET['page'];
}
require('apps/traitement_messages.php');
require('apps/traitement_users.php');
if (isset($_GET['ajax']))
{
	require('apps/'.$page.'.php');
}
else
{
	require('apps/skel.php');
}
?>