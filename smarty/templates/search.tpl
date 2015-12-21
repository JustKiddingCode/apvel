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
    <a href="index.php"> Back </a> <br/>
  <div id="login">{if isset($user)}
   Hallo {$user} <br/>
   <a href="auth.php?logout">Ausloggen!</a>
   {else}
   <a href="auth.php">Einloggen</a>
  {/if}</div>

    <h1>  <img src="/logos/asta.png"> Protokoll Veröffentlichungs und Editier Lösung </h1>
    
    <h2> Suche in veröffentlichten Protokollen </h2>

    <form action="search.php" method="POST">
      Search: <input type="text" name="search">
      <button type="submit" >Ändern</button>
    </form>
  <p>
  {$result}
  </p>
  </body>
</html>
