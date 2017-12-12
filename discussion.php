<?php
	session_start();

	if(isset($_SESSION['connection']) && $_SESSION["connection"] == true)
	{
		echo "<div class='account'>Bonjour, ".$_SESSION['pseudo'].
		"<a href='disconnect.php'><i class='fa fa-times' aria-hidden='true'></i>
</a>
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

		//recherche des posts
		include "connectionPDO.php";
		$query = $pdo->prepare("SELECT title_post, date_post, authors.pseudo, posts.id
		FROM posts
		INNER JOIN authors ON authors.id = posts.id_author;");
		$query->execute();
		$resultPostsRequest = $query->fetchAll(PDO::FETCH_ASSOC);
		$pdo = null;

		//rechercher des commentaires
		include "connectionPDO.php";
		$queryComments = $pdo->prepare("SELECT comment, comments.id_post
		FROM posts
		INNER JOIN comments ON comments.id_post = posts.id;");
		$queryComments->execute();
		$resultCommentsRequest = $queryComments->fetchAll(PDO::FETCH_ASSOC);
		$pdo = null;
		/*
		echo '<pre>';
		var_dump($resultCommentsRequest);
		echo '</pre>';
		<?php echo '<pre>'; var_dump($resultCommentsRequest); echo '</pre>'; ?>
		*/

		if(isset($_GET["idPost"]) && isset($_GET["comment"]))
		{
			$idPost = $_GET["idPost"];
			$comment = $_GET["comment"];
			$idSession = $_SESSION['idSession'];
			//insertion des commentaires
			include "connectionPDO.php";
			$query = $pdo->prepare(" INSERT INTO comments VALUES (null, ?,?,?)");
			$query->execute([$idSession, $idPost, $comment]);
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
