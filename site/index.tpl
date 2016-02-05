<html>
  <head>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {literal}{packages:["corechart"]}{/literal});
      google.setOnLoadCallback(drawChart);
      function drawChart() {literal}{
        var Classdata = google.visualization.arrayToDataTable([{/literal}
          {$ClassTableData}
        ]);
        var Classoptions = {literal}{
          title: 'Population By Class'
        };
        var Classchart = new google.visualization.PieChart(document.getElementById('classpiechart'));
        Classchart.draw(Classdata, Classoptions);
		
		var Racedata = google.visualization.arrayToDataTable([{/literal}
          {$RaceTableData}
        ]);
        var Raceoptions = {literal}{
          title: 'Population By Race'
        };
        var Racechart = new google.visualization.PieChart(document.getElementById('Racepiechart'));
        Racechart.draw(Racedata, Raceoptions);
      }
	  
	  google.charts.load('current', {packages: ['corechart', 'line']});
	google.charts.setOnLoadCallback(drawBackgroundColor);

	function drawBackgroundColor() {{/literal}
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Heros');

      data.addRows([{$LevelTableData}]);

      var options = {literal}{
        hAxis: {
          title: 'Level'
        },
        vAxis: {
          title: 'Popupation'
        },
        backgroundColor: '#ffffff'
      };

      var chart = new google.visualization.LineChart(document.getElementById('levelchart'));
      chart.draw(data, options);
    }{/literal}
    </script>
	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<style>
	.progress {
	  display: inline-flex;
	  width: 300px; 
	  position: relative;
	}
	.progress span {
	  position: absolute;
	  display: block;
	  width: 100%;
	  color: black;
	}

	.player
	{
		color: #005500;
	}

	.enemy
	{
		color: #550000;
	}
	</style>

	<script type="text/javascript">
		function UpdateBar(id, min, max) {
			var bar = document.getElementById(id);
			var percent = min / max * 100;
			var percentString = percent.toString();
			bar.style.width = percentString.concat("%");
		}
	</script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<style>
		body {
		  position: relative; 
		}
		#InfoSection {
			padding-top:50px;height:500px;
		}
		#UpdatesSection {
			padding-top:50px;height:500px;background-color: #ddd;
		}
		#StatsSection {
			padding-top:50px;height:500px;
		}
		#SignupSection {
			padding-top:50px;height:500px;background-color: #eee;
		}
		#LoginSection {
			padding-top:50px;height:500px;
		}
	</style>
	
  </head>
  <body data-spy="scroll" data-target=".navbar" data-offset="50">
  
  <nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
			<a class="navbar-brand" href="#InfoSection">Hero Game!</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<li><a href="#UpdatesSection">Updates</a></li>
				<li><a href="#StatsSection">Statistics</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#SignupSection"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
				<li><a href="#LoginSection"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			</ul>
		</div>
	</div>
</nav>

<div id="InfoSection">
<div class="container">
	<div class="jumbotron">
		<p>War happened as it always does when too many people with too many different opinions come together. This war was not between countries but between the professions that those had chosen, the guilds that worked for their professions' prosperity had decided that war was the only way. Thus it was not long before battle was joined, warrior against wizard, priest against thief. The war was devastating and when the dust settled the countries banded together and banned all profession based guilds. To ensure that the workers of the world would have the representation that they needed it was decided that guilds would be reinstated but instead of them being profession based they would instead be based on the membership of the individual guilds. The new guilds would be responsible for negotiating what jobs their members would do and for how much. Thus a new age of prosperity began.
		<br />Start your guild and choose your first members. Grow your guild to become the greatest of all the guilds.</p>
	</div>
</div>
</div>

<div id="LoginSection">
<div class="container">
	<h1>Login</h1>
	<form action="login.php" class="form-horizontal" role="form">
		<div class="form-group">
			<label class="control-label col-sm-2" for="email">Username:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="pwd">Password:</label>
			<div class="col-sm-10"> 
				<input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
			</div>
		</div>
		<div class="form-group"> 
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">Submit</button>
			</div>
		</div>
	</form>
</div>
</div>

<div id="UpdatesSection">
<div class="container">
	{include file='updates.tpl'}
</div>
</div>

<div id="SignupSection">
<div class="container">
	<h1>Register</h1>
	<form action="register.php" method="post" class="form-horizontal" role="form">
		<div class="form-group">
			<label class="control-label col-sm-2" for="email">Username:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="pwd">Password:</label>
			<div class="col-sm-10"> 
				<input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
			</div>
		</div>
		<div class="form-group"> 
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">Submit</button>
			</div>
		</div>
	</form>
</div>
</div>

<div id="StatsSection">
	<div class="row">
		<div class="col-sm-4"><div id="classpiechart" style="width: 900px; height: 500px;"></div></div>
		<div class="col-sm-4"><div id="Racepiechart" style="width: 900px; height: 500px;"></div></div>
	</div>
	<div id="levelchart"></div>
</div>

  </body>
</html>
