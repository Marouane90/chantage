<?php
$res = mysqli_query($db, "SELECT messages.*,users.login,users.avatar FROM  messages , users WHERE users.id = messages.id_author");
while ($message = mysqli_fetch_assoc($res))
{
	require('views/messages.phtml');
}
require('views/create_message.phtml');
?>