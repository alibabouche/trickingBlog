<?php 
session_start();

if(isset($_SESSION['connection']) && $_SESSION['connection'] == true)
    {
	echo "<div class='account'>Bonjour, ".$_SESSION['pseudo'].
    "<a href='disconnect.php'> Déconexion</a>
    </div>";
    }

if(!isset($_SESSION['connection']))
    {
	echo "<div class='account'>
    <a href='subscribe.php' id='subscribe'>Inscription</a>
    <a href='login.php' id='login'>Login</a>
    </div>";
    }

$page = "index";
include "layout.phtml";
?>