{include file='header.tpl'}

{if isset($organ)}
<h2>{$organs[$organ]}</h2>
{if $write}
	<h3> Neues Protokoll hinzufügen </h3>

	<form action="create.php" method="POST">
		<input type="text" name="organ" value="{$organ}" style="visibility:hidden;width:0em;">
		<input type="text" name="date"> YYYY/MM/DD
		<button type="submit" >Neu anlegen</button>
	</form>
{/if}

{if $admin}
	<h2>Template, Email editieren</h2>
		<a href="/edit/{$organ}/template">Template editieren</a> <br/>
		<a href="/edit/{$organ}/email">Email editieren</a> <br/>
		<a href="/edit/{$organ}/resolutions.txt">Beschlusssammlung editieren</a>
{/if}

{if $read}
	<h3>Unveröffentlichte Protokolle </h3>
	<ol>
		{foreach from=$unPubRep item=rep}
			<li><a href="/edit/{$organ}/{$rep}">{$rep} </a></li>
		{/foreach}
	</ol>
{/if}


<!---Das sehen alle Leute --->

<h3> Beschlusssammlung </h3>
Um zu überprüfen, ob etwas entschieden worden ist, kannst du schnell alle Beschlüsse anschauen.
<br/>
<a href="/reports/published/{$organ}.resolutions.txt">Beschlusssammlung</a>

<h3>Veröffentlichte Protokolle </h3>
<ol>
	{section loop=$pubRep name=ind max=10 start=$page*10}
	<li> 
		<ul>
			{foreach from=$pubRep[ind] item=rep}
				<li><a href="/reports/published/{$organ}/{$rep}">{$rep} </a> </li>
			{/foreach}
			{if $admin}
				<li><a href="/withdraw/{$organ}/{$pubRep[ind][0]}" class="button">Zurückziehen</a></li>
			{/if}
		</ul>
	</li>
	{/section}
</ol>

<!-- end of if isset Organ -->
{else}
  <h3>Herzlich Willkommen zum Protokollsystem des AStA am Karlsruher Institut für Technologie (KIT).</h3 
  <p>Benutze deine Logindaten für das AStA-Wiki für den Log In oder wähle rechts ein Organ aus.
  <br/><br/> <a href="https://wiki.asta.kit.edu">Zum AStA-Wiki</a>
  </p>
{/if}

{include file='footer.tpl'}
