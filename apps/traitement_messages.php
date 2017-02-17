<?php
var_dump($_POST);
if (isset($_POST['content'], $_SESSION['id']))
{
	$comment = $_POST['content'];

	if (strlen($comment) > 4095)
	{
		$errors[] = "Commentaire trop long (> 4095)";
	}
	else if (strlen($comment) < 2)
	{
		$errors[] = "Commentaire trop court (< 2)";
	}

	if (count($errors) == 0)
	{
		$comment = mysqli_real_escape_string($db, $comment);
		$res = mysqli_query($db, "INSERT INTO messages (content, id_author) VALUES('".$comment."', '".$_SESSION['id']."')");
		if ($res)
		{
			// Etape 4
			header('Location: index.php?page=create_message');
			exit;
		}
		else
		{
			$errors[] = "Erreur interne";
		}
	}
	// var_dump($errors);
}
?>