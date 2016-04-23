{include file='header.tpl'}
<div id="mainOrganSelector">
			Organ auswählen:
			<form action="index.php" method="POST">
				<select name="organ" size="1"  onchange="this.form.submit()">
					<option value="---">---</option>
					{foreach key=slang item=name from=$organs}
						{if isset($organ) and $slang eq $organ}
							<option value="{$slang}" selected="selected">{$name}</option>
						{else}
							<option value="{$slang}">{$name}</option>
						{/if}
					{/foreach}
				</select>
				<button type="submit" >Ändern</button>
			</form>
		</div>
		{if isset($organ)}<h2>{$organs[$organ]}</h2>
			{if $write}
				<h3> Neues Protokoll hinzufügen </h3>

				<form action="create.php" method="POST">
					<input type="text" name="organ" value="{$organ}" style="visibility:hidden;width:0em;">
					</select>
					<input type="text" name="date"> YYYY/MM/DD
					<button type="submit" >Neu anlegen</button>
				</form>
			{/if}

			{if $admin}
				<h2>Template, Email editieren</h2>
				<a href="edit.php?file=template&amp;organ={$organ}">Template editieren</a> <br/>
				<a href="edit.php?file=email&amp;organ={$organ}">Email editieren</a> <br/>
				<a href="edit.php?file=resolutions.txt&amp;organ={$organ}">Beschlusssammlung editieren</a>
			{/if}
			{if $read}
				<h3>Unveröffentlichte Protokolle </h3>
				<ol>{foreach from=$unPubRep item=rep}
					<li><a href="edit.php?file={$rep}&amp;organ={$organ}">{$rep} </a>
					</li>
					{/foreach}
				</ol>
			{/if}
			<h3> Beschlusssammlung </h3>
			Um zu überprüfen, ob etwas entschieden worden ist, kannst du schnell alle Beschlüsse anschauen.
			<br/>
			<a href="reports/published/{$organ}.resolutions.txt">Beschlusssammlung</a>

			<h3>Veröffentlichte Protokolle </h3>
			<ol>
				{foreach from=$pubRep item=arrrep}
				<li> 
					<ul>
						{foreach from=$arrrep item=rep}
							<li><a href="reports/published/{$organ}/{$rep}">{$rep} </a> </li>
						{/foreach}
						{if $admin}
							<li>
								<form action="index.php" method="post">
									<input type="text" name="withdraw" style="visibility:hidden;width:0em;">
									<input type="text" name="organ" value="{$organ}" style="visibility:hidden;width:0em;">
									<input type="text" name="report" value="{$arrrep[0]}" style="visibility:hidden;width:0em;">
									<button type="text">Withdraw</button>
								</form>
 						   	</li>
						{/if}
					</ul>
				</li>
				{/foreach}
			</ol>
		{else}
			<h3>Herzlich Willkommen zum Protokollsystem des AStA am Karlsruher Institut für Technologie (KIT).</h3 
			<p>Benutze deine Logindaten für das AStA-Wiki für den Log In oder wähle rechts ein Organ aus.
				<br/><br/> <a href="https://wiki.asta.kit.edu">Zum AStA-Wiki</a>
			</p>
		{/if}

{include file='footer.tpl'}
