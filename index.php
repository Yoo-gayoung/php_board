<?php
require_once 'controller.php';
$controller = new BoarderController($_GET['action']);
$controller->run();
exit;
?>