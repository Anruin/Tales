<?php
require_once('../engine/main.php');

$storyteller = new \Storyteller\Storyteller($morphy);

if (count($_POST)):
	echo $storyteller->NextTurn($_POST['turn']);
endif;