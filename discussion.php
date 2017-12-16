<?php
	session_start();

	if(isset($_SESSION['connection']) && $_SESSION["connection"] == true)
	{
		echo "<div class='account'>Bonjour, ".$_SESSION['pseudo'].
		"<a href='disconnect.php'><i class='fa fa-times' aria-hidden='true'></i>
		</a></div>";

		include "connectionPDO.php";
		//recherche de l'utilisateur du commentaires
		$idSession = $_SESSION['idSession'];
		$queryAuthor = $pdo->prepare("SELECT pseudo, date_comment
		FROM authors
		INNER JOIN comments ON comments.id_author = authors.id
		WHERE ? = id_author");
		$queryAuthor->execute([$idSession]);
		$queryAuthorRequest = $queryAuthor->fetch(PDO::FETCH_ASSOC);
		$pdo = null;

		//recherche des posts
		include "connectionPDO.php";
		$query = $pdo->prepare("SELECT title_post, date_post, authors.pseudo, posts.id, article
		FROM posts
		INNER JOIN authors ON authors.id = posts.id_author
		;");
		$query->execute();
		$resultPostsRequest = $query->fetchAll(PDO::FETCH_ASSOC);
		$pdo = null;

		//rechercher des commentaires
		include "connectionPDO.php";
		$queryComments = $pdo->prepare("SELECT comment, comments.id_post
		FROM posts
		INNER JOIN comments ON comments.id_post = posts.id;");
		$queryComments->execute([$idSession]);
		$resultCommentsRequest = $queryComments->fetchAll(PDO::FETCH_ASSOC);

		$pdo = null;

		/*
		echo '<pre>';
		var_dump($resultCommentsRequest);
		echo '</pre>';
		<?php echo '<pre>'; var_dump($resultCommentsRequest); echo '</pre>'; ?>
		*/
		if(isset($_POST["posts"]) && isset($_POST["article"]))
		{
			$posts = $_POST["posts"];
			$article = $_POST["article"];
			$idSession = $_SESSION['idSession'];
			include "connectionPDO.php";
			//insertion des posts dans la BDD
			$query = $pdo->prepare("INSERT INTO posts VALUES (null, ?, ?, NOW(), ?);");
			$query->execute([$posts, $article, $idSession]);
			$pdo = null;
		}

		if(isset($_POST["idPost"]) && isset($_POST["comment"]))
		{
			$idPost = $_POST["idPost"];
			$comment = $_POST["comment"];
			$idSession = $_SESSION['idSession'];
			include "connectionPDO.php";
			//insertion des commentaires dans la BDD
			$query = $pdo->prepare(" INSERT INTO comments VALUES (null, ?,?,?, NOW())");
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
