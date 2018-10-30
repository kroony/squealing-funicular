<html>
<head>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

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
	
	.btn-hp {
    color: #f00;
    background-color: #fff;
    border-color: #f00;
  }

	.player
	{
		color: #005500;
	}

	.enemy
	{
		color: #550000;
	}
	
	.progress
	{
		margin-bottom: 2px;
	}
	
	.icon-flipped {
		transform: scaleX(-1);
		-moz-transform: scaleX(-1);
		-webkit-transform: scaleX(-1);
		-ms-transform: scaleX(-1);
	}
  .dropdown-submenu {
    position: relative;
  }

  .dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
  }
  </style>


	<script type="text/javascript">
		function UpdateBar(id, min, max) {
			var bar = document.getElementById(id);
			var percent = min / max * 100;
			var percentString = percent.toString();
			bar.style.width = percentString.concat("%");
		}
		
		$(document).ready(function(){
      $('[data-toggle="popover"]').popover(); 
    });
    
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip(); 
    });
	
	function countdown( elementName, days, hours, minutes, seconds )
	{
		var element, endTime, days, hours, mins, msLeft, time;

		function twoDigits( n )
		{
			return (n <= 9 ? "0" + n : n);
		}

		function updateTimer()
		{
			msLeft = endTime - (+new Date)
			if ( msLeft < 1000 ) {
				element.innerHTML = "Done";
			} else {
				time = new Date( msLeft );
				days = days = Math.floor(msLeft / 1000 / 60 / 60 / 24);
				hours = time.getUTCHours();
				mins = time.getUTCMinutes();
				element.innerHTML = (days ? days + " days " + hours + ':' : hours + ':') + twoDigits(mins) + ':' + twoDigits( time.getUTCSeconds() );
				setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
			}
		}

		element = document.getElementById( elementName );
		endTime = (+new Date) + 1000 * (24*60*60*days + 60*60*hours + 60*minutes + seconds) + 500;
		updateTimer();
	}
	</script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
