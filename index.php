<?php 

	// Config
	$redirectTo = 'https://www.yourdomain.tld/';
	// On récupère la liste des bots connus
	$botListRaw = file_get_contents('./botlist.txt');
	$botList = explode("\n",$botListRaw);
	$userAgent = $_SERVER['HTTP_USER_AGENT'];
	// On vérifie si l'User Agent est dans la liste des bots
	$redirect = true;
	foreach($botList as $bot){
		if(preg_match("#".$bot."#isU", $userAgent)){
			$redirect = false;
			break;
		}
	}
	// Si ce n'est pas un bot ou si c'est Google Bot, on redirige
	if($redirect){
		header("Location: $redirectTo",true, 301);
	}