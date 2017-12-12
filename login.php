<?php
session_start();

function hashPassword($password)
	{
		$randomString = bin2hex(openssl_random_pseudo_bytes(32));
		$randomString = substr($randomString, 0, 22);
		$salt = '$2y$11$'.$randomString; // '$2y$11$' 2y permet d'utiliser blowFish

		return crypt($password, $salt);
	}
function verifyPassword($password, $hash)
	{
		// Si le mot de passe en clair est le même que la version hachée alors renvoie true.
		return crypt($password, $hash) == $hash;
	}

if(isset($_POST["pseudo"]) && isset($_POST["password"]))
{
	$pseudo   = trim($_POST["pseudo"]);

	include "connectionPDO.php";
	$query = $pdo->prepare("SELECT id, last_name, pseudo, password FROM authors WHERE pseudo = ?");
	$query->execute([$pseudo]);
	$loginTable = $query->fetch(PDO::FETCH_ASSOC);
	$pdo = null;

	$success  = verifyPassword($_POST["password"], $loginTable["password"]);

	if($success)
	{
		$_SESSION["connection"] = true;
		$_SESSION['idSession'] = $loginTable['id'];
		$_SESSION['pseudo'] = $loginTable['last_name'];
		header("Location: index.php");
	}
}



if(isset($_SESSION['connection']) && $_SESSION['connection'] == true)
    {
    	echo "<div class='account'>Bonjour, ".$_SESSION['pseudo'].
		"<a href='disconnect.php'> <i class='fa fa-times' aria-hidden='true'></i></a>
    	</div>";
    }
if(!isset($_SESSION['connection']))
    {
    	echo "<div class='account'>
            <a href='subscribe.php' id='subscribe'>Inscription</a>
            <a href='login.php' id='login'>Login</a>
        </div>";
    }

$page = "login";
include "layout.phtml";
