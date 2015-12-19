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
    <form action="index.php" method="POST">
      <select name="organ" size="1">
        {foreach key=slang item=name from=$organs}
          <option value="{$slang}">{$name}</option>
        {/foreach}
      </select>
      <button type="submit" >Ändern</button>
    </form>
    </div>
    {if isset($organ)}<h2>{$organs[$organ]}</h2>{/if}
    {if $writeOnOrgan}
      <h3> Neues Protokoll hinzufügen </h3>

      <form action="create.php" method="POST">
        <select name="organ" size="1">
	  {foreach key=slang item=name from=$organs}
	    <option value="{$slang}">{$name}</option>
	  {/foreach}
	</select>
	<input type="text" name="date"> YYYY/MM/DD
	<button type="submit" >Neu anlegen</button>
      </form>
    {/if}

    {if $showUnpublishedReports}
      <h2>Template, Email editieren</h2>
        <a href="edit.php?file=template&amp;organ={$organ}">Template editieren</a> <br/>
        <a href="edit.php?file=email&amp;organ={$organ}">Email editieren</a>
      <h3>Unveröffentlichte Protokolle </h3>
       <ol>{foreach from=$unPubRep item=rep}
	<li><a href="edit.php?file={$rep}&amp;organ={$organ}">{$rep} </a>
	</li>
      {/foreach}
       </ol>
    {/if}
    {if isset($organ)}
      <h3>Veröffentlichte Protokolle </h3>
      <ol>{foreach from=$pubRep item=rep}
        <li><a href="reports/published/{$organ}/{$rep}">{$rep} </a>
        	{if $writeOnOrgan}
		  <form action="index.php" method="post">
		    <input type="text" name="withdraw" style="visibility:hidden;width:0em;">
		    <input type="text" name="organ" value="{$organ}" style="visibility:hidden;width:0em;">
		    <input type="text" name="report" value="{$rep}" style="visibility:hidden;width:0em;">
		    <button type="text">Withdraw</button>
		  </form>
        	{/if}
        </li>
      {/foreach}</ol>
    {/if}
  </body>
</html>
