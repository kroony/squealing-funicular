<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
			<a class="navbar-brand" href="gamename.php">Hero Game!</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<li class="{if $currentpage == "user"}active{/if}"><a href="user.php">User</a></li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Heroes<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li class="{if $currentpage == "home"}active{/if}"><a href="home.php">Heroes<!-- <span class="badge">20@TODO make this actually dynamic</span>--></a></li>
						<li class="{if $currentpage == "party"}active{/if}"><a href="party.php">Parties</a></li>
					</ul>
				</li>
				<li class="{if $currentpage == "fightpit"}active{/if}"><a href="fightpit.php">Fight Pit</a></li>
				<li class="{if $currentpage == "inventory"}active{/if}"><a href="inventory.php">Inventory</a></li>
				<li class="{if $currentpage == "leaderboard"}active{/if}"><a href="leaderboard.php">Leaderboard</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				{if isset($help)}
					<li><a href="#" title="{$helpTitle}" data-toggle="popover" data-trigger="focus" data-content="{$help}"></a><span class="glyphicon glyphicon-question-sign"></span> Page Help</li>
				{/if}
				{if isset($admin)}
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="admin/weaponBase.php">Weapon Bases</a></li>
							<li><a href="admin/users.php">Users</a></li>
							<li><a href="admin/migrations.php">Migrations</a></li>
						</ul>
					</li>
				{/if}
				<!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</div>
</nav>