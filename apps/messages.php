<?php
$count = 0;
$res = mysqli_query($db, "SELECT messages.*,users.login,users.avatar FROM  messages , users WHERE users.id = messages.id_author ORDER BY date DESC");
while ($message = mysqli_fetch_assoc($res))
{
	if ($count % 2 == 0)
		$pos = "left";
	else
		$pos = "right";
	require('views/messages.phtml');
	$count++;
}
// if (isset($_GET['id']))
// {
// 	$id = intval($_GET['id']);
// 	$res = mysqli_query($db, "SELECT messages.*,users.login FROM  messages , users WHERE users.id = messages.id_author AND messages.id = ".$id);
// 	$article = mysqli_fetch_assoc($res);
// 	if ($article)
// 	{
// 		var_dump($article);
// 		require('views/message.phtml');
// 	}
// 	else
// 	{
// 		$errors[] = "L'article n'existe pas";
// 		require('apps/errors.php');
// 	}
// }
// else
// {
// 	$errors[] = "L'article n'existe pas";

// 	require('apps/errors.php');
// }