<html>
<head>
<link type="text/css" rel="stylesheet" href="css/fight.css" />
</head>
<body>

{$log}

{if $hero1->CurrentHP lt (0 - $hero1->Con)}
	{$hero1_name} has <b>died</b> in battle<br /><br />
	<b>{$hero2_name} is victorious!</b><br />
{else if $hero1->CurrentHP lt 0}
	{$hero1_name} has been knocked out in battle<br /><br />
	<b>{$hero2_name} is victorious!</b><br />
{/if}

{if $hero2->CurrentHP lt (0 - $hero2->Con)}
	{$hero2_name} has died in battle<br /><br />
	<b>{$hero1_name}  is victorious!</b><br />
{else if $hero2->CurrentHP lt 0}
	{$hero2_name} has been knocked out in battle<br /><br />
	<b>{$hero1_name} is victorious!</b><br />
{/if}

<a href="home.php">Return</a>

</body>
