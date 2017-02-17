<?php

$res = mysqli_query($db, "SELECT message.*, users.login FROM message, users WHERE users.id=message.id_author");

while ($comment = mysqli_fetch_assoc($res))
{
	require('views/comments.phtml');
}
?>