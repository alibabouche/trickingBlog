<?php
	session_start();

	if(isset($_SESSION['connection']) && $_SESSION["connection"] == true)
	{
		echo "<div class='account'>Bonjour, ".$_SESSION['pseudo'].
		"<a href='disconnect.php'> Déconexion</a>
	    </div>";

		if(isset($_POST["posts"]) && isset($_POST["article"]))
		{
			$posts = $_POST["posts"];
			$article = $_POST["article"];
			$idSession = $_SESSION['idSession'];

			include "connectionPDO.php";
			$query = $pdo->prepare("
				INSERT INTO posts
				VALUES (null, ?, ?, NOW(), ?);
				");
			$query->execute([$posts, $article, $idSession]);
			$pdo = null;

			header ("Location: discussion.php");
		}		
	  
		//recherche des post
		include "connectionPDO.php";
		$query = $pdo->prepare("
		SELECT title_post, date_post, authors.pseudo, posts.id
		FROM posts
		INNER JOIN authors ON authors.id = posts.id_author;");
		$query->execute();
		$resultPostsRequest = $query->fetchAll(PDO::FETCH_ASSOC);
		$pdo = null;

		if(isset($_GET["submitAnswer"]))
		{
			$idPost = $_GET["idPost"];
			$answer = $_GET["answer"];
			//insertion des commentaires
			$query = $pdo->prepare(" INSERT INTO comments VALUES (null, ?,?,?)");
			$query->execute([$idSession, $idPost, $answer ]);
			$pdo = null;
		}
		
		
		$page = "discussion";
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
	}
?>