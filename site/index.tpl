<html>
  <head>
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
  </head>
  <body>

		<a href="register.php">Register here</a> if you do not already have an account.<br />
		<hr>
		<br />
		<form action="login.php">
		  Username: <input name="username" type="text"><br />
		  password: <input name="password" type="password"><br />
		  <input type="submit" value="Submit">
		</form>
		<p>
		War happened as it always does when too many people with too many different opinions come together. This war was not between countries but between the professions that those had chosen, the guilds that worked for their professions' prosperity had decided that war was the only way. Thus it was not long before battle was joined, warrior against wizard, priest against thief. The war was devastating and when the dust settled the countries banded together and banned all profession based guilds. To ensure that the workers of the world would have the representation that they needed it was decided that guilds would be reinstated but instead of them being profession based they would instead be based on the membership of the individual guilds. The new guilds would be responsible for negotiating what jobs their members would do and for how much. Thus a new age of prosperity began.
		<br />Start your guild and choose your first members. Grow your guild to become the greatest of all the guilds.</p>

	<div id="classpiechart" style="width: 900px; height: 500px;"></div>
	<div id="Racepiechart" style="width: 900px; height: 500px;"></div>
	
	<div id="levelchart"></div>
  </body>
</html>
