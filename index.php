<?php
$errors = [];
$db = mysqli_connect("","","","");
session_start();
$access = ["articles", "login", "register", "create_article", "edit_article", "article", "comment"];
$page = "articles";
if (isset($_GET['page']) && in_array($_GET['page'], $access))
{
    $page = $_GET['page'];
}
require('apps/traitement_comments.php');
require('apps/traitement_articles.php');
require('apps/traitement_users.php');
require('apps/skel.php');

?>