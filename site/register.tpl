<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta property="og:url"                content="http://amospheric.com/" />
	<!--<meta property="og:type"               content="article" />-->
	<meta property="og:title"              content="Manage a Guild of Heroes" />
	<meta property="og:description"        content="How well can your guild fair the rest, and the dreaded scourge of the undead?" />
	<!--<meta property="og:image"              content="" />-->
	<!--<meta property="fb:app_id"             content="" />-->

	<meta name="author" content="Trout-Slap" />
	<meta name="keywords" content="Game, RPG, Text Based, Free, Multiplayer, Guild, Hero" />
	<meta name="description" content="" />
	<meta name="robots" content="all" />
	<meta name="copyright" content="Trout-Slap" />
	
	<title>Squealing Funicular</title>
	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
 </head>
<body>





{if isset($error)}
Sorry, that username already exists. <a href="register.php">Try again!</a>

{else if isset($id)}
You have successfully created a new user.
<br />
Your username is "{$user}".
<br />
You can log in <a href="index.php">here</a>.

{else}
Register a new user!
<br />
<hr>
<br />
<form action="register.php" method="post">
Username: <input name="username" type="text"><br />
Password: <input name="password" type="password"><br />
<input type="hidden" name="refererID" value="{$refererID}">
<input type="submit" value="Submit">
</form>

{/if}

</body>
</html>



