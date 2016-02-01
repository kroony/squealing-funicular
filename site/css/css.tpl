<html>
<head>
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
			bar.width = percentString.concat("%");
		}
	</script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
