<?php
//kill the session
session_start();
$_SESSION['connection'] = false;
session_destroy();
//redirected to home page  
header("Location: index.php");
