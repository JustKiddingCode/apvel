<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>APVEL</title>
    <meta name="description" content="EpicEditor is an embeddable JavaScript Markdown editor with split fullscreen editing, live previewing, automatic draft saving, offline support, and more.">
    <script type="text/javascript" src="EpicEditor/src/editor.js" > </script>
    <link rel="stylesheet" href="style.css" >
  </head>
  <body>
  <div id="login">{if isset($user)}
   Hallo {$user} <br/>
   <a href="auth.php?logout">Ausloggen!</a>
   {else}
   <a href="auth.php">Einloggen</a>
  {/if}</div>

    <h1>  <img src="/logos/asta.png"> Protokoll Veröffentlichungs und Editier Lösung </h1>
      <a class="button" href="search.php" style="float:left;">Suchen</a>
    <div id="mainOrganSelector">
Organ auswählen:
    <form action="invite.php" method="POST">
      <select name="organ" size="1"  onchange="this.form.submit()">
        <option value="---">---</option>
        {foreach key=slang item=name from=$organs}
          {if $slang eq $organ}
            <option value="{$slang}" selected="selected">{$name}</option>
          {else}
            <option value="{$slang}">{$name}</option>
          {/if}
        {/foreach}
      </select>
      <button type="submit" >Ändern</button>
    </form>
    </div>
    <h3>Einladungen </h3>
    {if isset($organ)}<h2>{$organs[$organ]}</h2>
      {if $admin}
	<h3>Einladung verschicken</h3>
	<form action="invite.php" method="POST">
	  <input type="text" name="organ" value="{$organ}" style="visibility:hidden;width:0em;">
          <textarea name="mailtext" class="emailedit"></textarea>
	  <button type="submit" >Einladung verschicken</button>
	</form>
      {/if}
      {if isset($organ)}
	<a href="reports/{$organ}.invitations.txt">Text aller Einladungen</a>
	<h4>Die letzte Einladung </h4>
	<pre>{$lastInvite}</pre>
      {/if}
  {else}
  <h3>Herzlich Willkommen zum Protokollsystem des AStA am Karlsruher Institut für Technologie (KIT).</h3> 
  
  
  <p>Benutze deine Logindaten für das AStA-Wiki für den Log In oder wähle rechts ein Organ aus.
  
  <br/><br/> <a href="https://wiki.asta.kit.edu">Zum AStA-Wiki</a>
  </p>
  {/if}
  
  <div id="footer"> <span style="font-size:0.8em">Bei Fragen, Anregungen, Kritik: <a href="mailto:admin@asta-kit.de"> Mail</a> </span></div>
  </body>
</html>
