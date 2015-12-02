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
  <a href="index.php"> Back </a>
    <h1> AStA Protokoll Veröffentlichungs und Editier Lösung </h1>
    <h2> Editing: {$organ} {$file} </h2>
    <br/>

    <div>
      <div id="lock">
	<a class="button" href="javascript:refreshWritePermission('{$file}','{$organ}')">Get write permission</a>
      </div>
      <div id="sendmail" >
	<a class="button" href="sendmail.php?file={$file}&amp;organ={$organ}">Send email</a>
      </div>


      <div id="publishFrame" >
	<a class="button" href="publish.php?file={$file}&amp;organ={$organ}" id="publish"> Publish (preview) </a>
      </div>
    </div>
    	<span id="locktext"></span>
  <br>  <br> <br>  <br>
      <hr>

    <div id="epiceditor"> </div>

    <br/>

     <form action="edit.php" method="POST">
      <button type="submit" id="submitbutton" style="visibility:hidden;">Ändern</button>
      <input type="text"  name="organ" value="{$organ}" style="visibility:hidden;">
      <input type="text"  name="file" value="{$file}" style="visibility:hidden;">
      <textarea name="text" id="epicedit" style="visibility:hidden;">{$text}</textarea>
    </form>



    <script type="text/javascript">
      var opts = {
        basePath: 'EpicEditor/epiceditor',
        textarea: 'epicedit',
        autogrow: true,
        file: {
	  name:'{$organ}{$file}'
        }
      }
      var editor = new EpicEditor(opts).load();
      editor.preview();

      editor.on('edit', function() { refreshWritePermission('{$file}','{$organ}') });
      editor.on('fullscreenenter', function() { refreshWritePermission('{$file}','{$organ}')});

    </script>


  </body>
</html>
