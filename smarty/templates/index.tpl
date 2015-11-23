<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>APVEL</title>
    <meta name="description" content="EpicEditor is an embeddable JavaScript Markdown editor with split fullscreen editing, live previewing, automatic draft saving, offline support, and more.">
    <link href='http://fonts.googleapis.com/css?family=Lato:400,400italic|Arvo:400,400italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="docs/css/main.css">
    <link rel="stylesheet" href="docs/css/prettify.css">
    <link rel="shortcut icon" href="docs/favicon.ico">
    <script type="text/javascript" src="EpicEditor/src/editor.js" > </script>

  </head>
  <body>
    <h1> AStA Protokoll Veröffentlichungs und Editier L </h1>
Organ auswählen:
    <form action="index.php" method="POST">
      <select name="group" size="1">
        {foreach from=$groups item=group}
          <option>{$group}</option>
        {/foreach}
      </select>
      <button type="submit" >Ändern</button>
    </form>


    <form action="create.php" method="POST">
      <select name="organ" size="1">
        {foreach from=$groups item=group}
          <option>{$group}</option>
        {/foreach}
      </select>
      <input type="text" name="date"> YYYY/MM/DD
      <button type="submit" >Neu anlegen</button>
    </form>

    <h2>Unveröffentlichte Protokolle </h2>
    {foreach from=$unPubRep item=rep}
      <a href="edit.php?file={$rep}&amp;organ={$organ}">{$rep} </a>
    {/foreach}

    <h2>Veröffentlichte Protokolle </h2>
    {foreach from=$pubRep item=rep}
      <a href="show.php?file={$rep}&amp;organ={$organ}">{$rep} </a>
    {/foreach}
  </body>
</html>
