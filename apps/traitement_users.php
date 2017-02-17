<?php
// Etape 0
// var_dump($_POST);
if (isset($_GET['page']) && $_GET['page'] == "logout")
{
	session_destroy();
	header('Location: index.php');
	exit;
}

if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == "register")
	{
		// Etape 1
		if (isset($_POST['login'], $_POST['email'], $_POST['password1'], $_POST['password2']))
		{
			// Etape 2
			$login = $_POST['login'];// 31
			$email = $_POST['email'];// 127
			$password1 = $_POST['password1'];// 72
			$password2 = $_POST['password2'];// ~= $password1
			if (strlen($login) > 31)
			{
				$errors[] = "Login trop long (> 31)";
			}
			else if (strlen($login) < 2)
			{
				$errors[] = "Login trop court (< 2)";
			}
			if (strlen($password1) < 6)
			{
				$errors[] = "Password trop court (< 6)";
			}
			else if (strlen($password1) > 72)
			{
				$errors[] = "Password trop long (> 72)";
			}
			else if ($password1 != $password2)
			{
				$errors[] = "Les mots de passe ne correspondent pas";
			}
			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false)
			{
				$errors[] = "Email invalide";
			}
			// Etape 3
			if (count($errors) == 0)
			{
				$login = mysqli_real_escape_string($db, $login);
				$email = mysqli_real_escape_string($db, $email);
				$hash = password_hash($password1, PASSWORD_BCRYPT, ["cost"=>15]);
				$res = mysqli_query($db, "INSERT INTO users (email, password, login,) VALUES('".$email."', '".$hash."', '".$login."')");
				/*                                           |                               |         |                                                       |
															  nom des colonnes dans phpmyadmin                    nom des variables de la ligne 36 à 39
				*/
				if ($res)
				{
					// Etape 4
					header('Location: index.php?page=login');
					exit;
				}
				else
				{
					$errors[] = "Erreur interne";
				}
			}
		}
	}

	if ($action == "login")
	{
		// Etape 1
		if (isset($_POST['login'], $_POST['password']))
		{
			// Etape 2
			$login = $_POST['login'];
			$password = $_POST['password'];
			// Etape 3
			if (count($errors) == 0)
			{
				$login = mysqli_real_escape_string($db, $login);
				// $hash = password_hash($password1, PASSWORD_BCRYPT, ["cost"=>15]);
				$res = mysqli_query($db, "SELECT * FROM users WHERE login='".$login."'");
				if ($res)
				{
					$user = mysqli_fetch_assoc($res);
					// $user['id'], $user['email'], $user['login'], $user['password'], $user['birthdate']
					if ($user)
					{
						if (password_verify($password, $user['password']))
						{
							$_SESSION['id'] = $user['id'];
							$_SESSION['login'] = $user['login'];
							$_SESSION['admin'] = $user['admin'];
							// Etape 4
							header('Location: index.php?page=articles');
							exit;
						}
						else
						{
							$errors[] = "Mot de passe incorrect";
						}
					}
					else
					{
						$errors[] = "Login inconnu";
					}
				}
				else
				{
					$errors[] = "Erreur interne";
				}
			}
		}
	}
}
?>