<?php
var_dump($_POST);
if (isset($_POST['content'], $_POST[$_SESSION['id']]))
{
	$comment = $_POST['content'];
	$id_article = $_POST['id'];

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
		$id_article = intval($id_article);
		$res = mysqli_query($db, "INSERT INTO messages (content, id_author) VALUES('".$comment."', '".$_SESSION['id']."')");
		if ($res)
		{
			// Etape 4
			header('Location: index.php?page=messages='.$id);
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