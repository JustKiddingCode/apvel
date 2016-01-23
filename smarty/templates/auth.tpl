<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>APVEL</title>
    <meta name="description" content="EpicEditor is an embeddable JavaScript Markdown editor with split fullscreen editing, live previewing, automatic draft saving, offline support, and more.">
      <link rel="stylesheet" href="style.css" >
    <script type="text/javascript" src="EpicEditor/epiceditor/js/epiceditor.min.js" > </script>
    <script type="text/javascript" src="script.js"> </script>
  </head>
  <body>
  <a href="index.php"> Back </a> <br/>
    <h1> <img src="/logos/asta.png">Protokoll Veröffentlichungs und Editier Lösung </h1>
    <br/>
  {if $loggedIn == false}
  <form name="login" action="auth.php" method="POST">
    <div class="loginelement">User: </div><input type="text" name="user"> <br/>
    <div class="loginelement">Password:</div> <input type="password" name="password"> <br/>
    <button type="submit">Log in!</button>
  </form>
  {else}
    <a href="auth.php?logout"> Logout </a>
  {/if}
  </body>
</html>
