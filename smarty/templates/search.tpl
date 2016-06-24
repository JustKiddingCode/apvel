{include file='header.tpl'} 
    <h2> Suche in veröffentlichten Protokollen </h2>

    <form action="search.php" method="POST">
      Search: <input type="text" name="search">
      <button type="submit" >Ändern</button>
    </form>
    <pre>{if isset($result)}  {$result} {/if}  </pre>

{include file='footer.tpl'}
