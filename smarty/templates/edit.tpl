<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>APVEL</title>
    <meta name="description" content="EpicEditor is an embeddable JavaScript Markdown editor with split fullscreen editing, live previewing, automatic draft saving, offline support, and more.">

    <script type="text/javascript" src="EpicEditor/epiceditor/js/epiceditor.min.js" > </script>

  </head>
  <body>
    <h1> AStA Protokoll Veröffentlichungs und Editier Lösung </h1>
    <h2> Editing: {$organ} {$file} </h2>
    <br/> <a href="index.php"> Back </a>

    <div id="epiceditor"> </div>

     <form action="edit.php" method="POST">
      <input type="text"  name="organ" value="{$organ}" style="visibility:hidden;">
      <input type="text"  name="file" value="{$file}" style="visibility:hidden;">
      <textarea name="text" id="epicedit" style="visibility:hidden;"> {$text}</textarea>
      <button type="submit" >Ändern</button>
    </form>

    <a href="publish.php?file={$file}&amp;organ={$organ}" > Publish (preview) </a>

    <script type="text/javascript">
      var opts = {
        basePath: 'EpicEditor/epiceditor',
        textarea: 'epicedit'
      }
      var editor = new EpicEditor(opts).load();
    </script>


  </body>
</html>
