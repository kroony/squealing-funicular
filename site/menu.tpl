<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="gamename.php">Hero Game!</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="{if $currentpage == "user"}active{/if}"><a href="user.php">User</a></li>
	  <li class="{if $currentpage == "home"}active{/if}"><a href="home.php">Heroes <span class="badge">20</span></a></li>
	  <li class="{if $currentpage == "fight"}active{/if}"><a href="fightpit.php">Fight Pit</a></li>
	  <li class="{if $currentpage == "inventory"}active{/if}"><a href="inventory.php">Inventory</a></li>
	  <li class="{if $currentpage == "leader"}active{/if}"><a href="leaderboard.php">Leaderboard</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
      <li><a href="index.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>