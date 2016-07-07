<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>APVEL</title>
		<meta name="description" content="Apvel is the online editor and report publish system used by the Fachschaftenkonferenz (FSK) and other organs of the student council at KIT" /> 
		<script type="text/javascript" src="/EpicEditor/epiceditor/js/epiceditor.min.js" > </script>
		<script type="text/javascript" src="/script.js"> </script>
		<link rel="stylesheet" href="/style.css" />
		<link rel="icon" href="/logo.png" />
	</head>
	<body>
		<div id="login">
			{if isset($user)}
				Hallo {$user} <br/>
				<a href="/auth.php?logout">Ausloggen!</a>
			{else}
				<a href="/auth.php">Einloggen</a>
			{/if}
		</div>

		<h1> <a href="/"> <img src="/logos/asta.png"> </a> Protokoll Veröffentlichungs und Editier Lösung </h1>
		<div class="menubar"> 
  			<a class="button" href="search.php">Suchen</a>
			<a class="button" href="invite.php">Einladungen</a>
			{include file='mainOrganSelector.tpl'}                                          
		</div>
