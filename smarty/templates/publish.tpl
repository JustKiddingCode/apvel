

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>APVEL</title>
    <meta name="description" content="EpicEditor is an embeddable JavaScript Markdown editor with split fullscreen editing, live previewing, automatic draft saving, offline support, and more.">
    <script type="text/javascript" src="EpicEditor/src/editor.js" > </script>

  </head>
  <body>
    <h1> AStA Protokoll Veröffentlichungs und Editier Lösung </h1>
    <h2> Check if everything is ok, then click again...</h2>

        <a href="publish.php?file={$file}&amp;organ={$organ}&amp;rly" > Publish </a> <br />
{nocache}<iframe src="cache/{$tmp}.html" width="95%" height="1200"> </iframe>{/nocache}
    </body>
</html>
