<?php
var_dump($_POST);
if (isset($_POST['comment'], $_POST['id_article']))
{
	$comment = $_POST['comment'];
	$id_article = $_POST['id_article'];

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
		$res = mysqli_query($db, "INSERT INTO comments (content, id_article, id_author) VALUES('".$comment."', '".$_SESSION['id']."', '".$id_article."')");
		if ($res)
		{
			// Etape 4
			header('Location: index.php?page=article&id='.$id_article);
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