<?php
session_start();
if(isset($_SESSION['connection']) && $_SESSION['connection'] == true)
{
	echo "<div class='account'>Bonjour, ".$_SESSION['pseudo'].
	"<a href='disconnect.php'> Déconexion</a>
    </div>";

	$page = "tutaux";
	include "layout.phtml";
}

if(!isset($_SESSION['connection']))
{
	echo "<div class='account'>
            <a href='subscribe.php' id='subscribe'>Inscription</a>
            <a href='login.php' id='login'>Login</a>
        </div>";

	$page = "login";
	include "layout.phtml";

	if(
		isset($_POST["pseudo"])&&
		isset($_POST["password"])
		)
	{
		$pseudo = $_POST["pseudo"];
		$password = $_POST["password"];

		include "connectionPDO.php";

		$query = $pdo->prepare(
				"
				SELECT pseudo, password
				FROM authors
				WHERE pseudo = ? AND password = ?"
				);

		$query->execute(Array($pseudo, $password));
		$resultLoginRequest = $query->fetch(PDO::FETCH_ASSOC);
		
		if (!empty($resultLoginRequest))
		{				
			$_SESSION['connection'] = true;
			header("Location: index.php");
		}
		else
		{
			echo "<p style='color: white;'>tes nul</p>";
		}
		//$success = $this->verifyPassword($password, $user['password']);
		$pdo = null;
	}	
}

?>