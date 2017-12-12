<?php
session_start();

function hashPassword($password)
	{
		$randomString = bin2hex(openssl_random_pseudo_bytes(32));
		$randomString = substr($randomString, 0, 22);
		$salt = '$2y$11$'.$randomString; // '$2y$11$' 2y permet d'utiliser blowFish
		return crypt($password, $salt);
	}

if(
	isset($_POST["lastName"]) &&
	isset($_POST["firstName"]) &&
	isset($_POST["pseudo"]) &&
	isset($_POST["password"])
	)
{
	$lastName = $_POST["lastName"];
	$firstName = $_POST["firstName"];
	$pseudo = $_POST["pseudo"];
	$password = $_POST["password"];
	$password = hashPassword($password);

	include "connectionPDO.php";
	$query = $pdo->prepare(
			"INSERT INTO authors
			VALUES (null,?,?,?,?)"
			);
		$query->execute([$lastName, $firstName, $pseudo, $password]);
		$pdo = null;

	header ("Location: index.php");
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


$page = "subscribe";
include "layout.phtml";
