<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>EpicEditor - An embeddable JavaScript Markdown editor</title>
    <meta name="description" content="EpicEditor is an embeddable JavaScript Markdown editor with split fullscreen editing, live previewing, automatic draft saving, offline support, and more.">
    <link href='http://fonts.googleapis.com/css?family=Lato:400,400italic|Arvo:400,400italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="docs/css/main.css">
    <link rel="stylesheet" href="docs/css/prettify.css">
    <link rel="shortcut icon" href="docs/favicon.ico">
    <script type="text/javascript" src="EpicEditor/src/editor.js" > </script> 

  </head>
  <body>
    <h1> AStA Protokoll Veröffentlichungs und Editier L <h1>
    <div id="epiceditor"> </div>
    <script type="text/javascript"> 
      var opts = {
        basePath: 'EpicEditor/epiceditor'
      }
      var editor = new EpicEditor(opts).load();
    </script>
  </body>
</html>