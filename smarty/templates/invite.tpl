{include file='header.tpl'}
    <h3>Einladungen </h3>
    {if isset($organ)}<h2>{$organs[$organ]}</h2>
      {if $admin}
	<h3>Einladung verschicken</h3>
	<form action="/invite/{$organ}" method="POST">
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

{include file='footer.tpl'}
