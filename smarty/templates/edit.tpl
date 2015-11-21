<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>APVEL</title>
    <meta name="description" content="EpicEditor is an embeddable JavaScript Markdown editor with split fullscreen editing, live previewing, automatic draft saving, offline support, and more.">

    <script type="text/javascript" src="EpicEditor/epiceditor/js/epiceditor.min.js" > </script>

  </head>
  <body>
    <h1> AStA Protokoll Veröffentlichungs und Editier L </h1>
Organ auswählen:
    <select name="group" size="1">
      {foreach from=$groups item=group}
        <option>{$group}</option>
      {/foreach}
    </select>
    <div id="epiceditor"> </div>
    <script type="text/javascript">
      var opts = {
        basePath: 'EpicEditor/epiceditor'

      }
      var editor = new EpicEditor(opts).load();
      editor.importFile('test', "{$text}");
    </script>
  </body>
</html>
