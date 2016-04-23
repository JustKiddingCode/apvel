{include file='header.tpl'}
<br/>
  {if $loggedIn == false}
  <div>
  <form name="login" action="auth.php" method="POST">
    <div class="loginelement">User: </div><input type="text" name="user"> <br/>
    <div class="loginelement">Password:</div> <input type="password" name="password"> <br/>
    <button type="submit">Log in!</button>
  </form>
  </div>
  {else}
    <a href="auth.php?logout"> Logout </a>
    {/if}

{include file='footer.tpl'}
