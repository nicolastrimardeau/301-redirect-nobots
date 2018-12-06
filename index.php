<?php 
	
	$params = json_decode(file_get_contents('./config.json'));
	// Récupération de la configuration
	$redirectTo = $params->redirectTo;
	// --- Block Common Crawlers (Bloc les crawlers connus (AHref, Majestic...))
	if($params->mod == 'UA-BCC'){
		// On récupère la liste des bots connus
		$botListRaw = file_get_contents('./d/blocked_ua.txt');
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
	}
	// --- Only Authorized Crawlers (Autorise uniquement certains User Agent)
	if($params->mod == 'UA-AC'){
		// On récupère la liste des bots autorisés
		$botListRaw = file_get_contents('./d/authorized_ua.txt');
		$botList = explode("\n",$botListRaw);
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		// On vérifie si l'User Agent est dans la liste des bots
		$redirect = false;
		foreach($botList as $bot){
			if(preg_match("#".$bot."#isU", $userAgent)){
				$redirect = true;
				break;
			}
		}
		// Si ce n'est pas un bot ou si c'est Google Bot, on redirige
		if($redirect){
			header("Location: $redirectTo",true, 301);
		}
	}
	// --- Autorise uniquement certaines IP
	if($params->mod == 'IP-AC'){
		// On récupère la liste des bots autorisés
		$addrListRaw = file_get_contents('./d/authorized_ip.txt');
		$addrList = explode("\n",$addrListRaw);
		$remoteAddr = $_SERVER['REMOTE_ADDR'];
		var_dump($remoteAddr);
		// On vérifie si l'User Agent est dans la liste des bots
		$redirect = false;
		foreach($addrList as $addr){
			if($remoteAddr == $addr){
				$redirect = true;
				break;
			}
		}
		// Si ce n'est pas un bot ou si c'est Google Bot, on redirige
		if($redirect){
			header("Location: $redirectTo",true, 301);
		}
	}
	// --- Autorise uniquement les reverses DNS de la liste
	if($params->mod == 'RDNS-AC'){
		$dnsListRaw = file_get_contents('./d/authorized_host.txt');
		$dnsList = explode("\n",$dnsListRaw);
		$remoteAddr =  $_SERVER['REMOTE_ADDR'];
		$host = gethostbyaddr($remoteAddr);
		$ipFromHost = gethostbyname($host);
		// Les ip ne correspondent pas, on ne redirige pas
		if($remoteAddr != $ipFromHost){ die(); }
		// On vérifie si le DNS match la liste de redirection
		$redirect = false;
		foreach($dnsList as $dns){
			if(preg_match("#".$dns."#isU", $host)){
				$redirect = true;
				break;
			}
		}
		if($redirect){
			header("Location: $redirectTo",true, 301);
		}
	}
	