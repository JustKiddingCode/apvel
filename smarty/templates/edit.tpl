{include file='header.tpl'}   
<h2> Editing: {$organ} {$file} </h2>
    <br/>

    <div class="menubar">
      <div id="lock">
	<a class="button" href="javascript:refreshWritePermission('{$file}','{$organ}')">Get write permission</a>
      </div>
      <div id="sendmail" >
	<a id="sendmailbutton" class="button" href="sendmail.php?file={$file}&amp;organ={$organ}">Send email</a>
      </div>

      {if $admin}
        <div id="publishFrame" >
  	  <a class="button" href="publish.php?file={$file}&amp;organ={$organ}" id="publish"> Publish (preview) </a>
        </div>
      {/if}
      {if $read}
	  <a class="button" href="download.php?file={$file}&amp;organ={$organ}"> Download </a>
      {/if}
    </div>
    <br><span id="locktext"></span> <br>  <br> <br>  <br>
    
    <p>Einige Hinweise: 
    <ul>
      <li> Füge vor neuen Überschriften (#) eine Leerzeile ein. </li>
      <li> Ebenso vor Aufzählungen (mit *) </li>
      <li> <strong>Fett</strong> mit **Fett** </li>
      <li> <span style="font-style:italic">Kursiv</span> mit _Kursiv_ </li>
      <li> http://pandoc.org/README.html#pandocs-markdown </li>
      <li> Beschlüsse in [beschluss]Hier kommt der Beschlusstext [/beschluss] packen</li>
      <li> Interne Daten in [intern]Sehr vertrauliche Informationen [/intern] packen</li>
    </ul>
    
    </p>
      <hr>

    <div id="epiceditor"> </div>

    <br/>

    <form action="/edit/{$organ}/{$file}" method="POST">
      <button type="submit" id="submitbutton" style="visibility:hidden;">Ändern</button>
      <input type="text"  name="organ" value="{$organ}" style="visibility:hidden;">
      <input type="text"  name="file" value="{$file}" style="visibility:hidden;">
      <textarea name="text" id="epicedit" style="visibility:hidden;">{$text}</textarea>
    </form>



    <script type="text/javascript">
      var opts = {
        basePath: '/EpicEditor/epiceditor',
        textarea: 'epicedit',
        autogrow: true,
        clientSideStorage: false,
        file: {
	  name:'{$organ}{$file}'
        }
      }
      var editor = new EpicEditor(opts).load();
      editor.preview();

      editor.on('edit', function() { refreshWritePermission('{$file}','{$organ}') });
      editor.on('fullscreenenter', function() { refreshWritePermission('{$file}','{$organ}')});

    </script>

{include file='footer.tpl'}
