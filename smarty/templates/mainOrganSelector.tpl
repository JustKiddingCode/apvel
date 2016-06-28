<div id="mainOrganSelector">
	Organ auswählen:
	<form action="/index.php" method="GET">
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
