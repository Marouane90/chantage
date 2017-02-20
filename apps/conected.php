<?php
$res = mysqli_query($db, "SELECT users.* FROM users ");
while ($conected = mysqli_fetch_assoc($res))
{
	require('views/conected.phtml');
}