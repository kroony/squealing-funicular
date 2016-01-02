{if $hero1->CurrentHP lt (0 - $hero1->Con)}
	{$hero1->Name} has <b>died</b> in battle<br /><br />
	<b>{$hero2->Name} is victorious!</b><br />
{else if $hero1->CurrentHP gt 0}
	{$hero1->Name} has been knocked out in battle<br /><br />
	<b>{$hero2->Name} is victorious!</b><br />
{/if}

{if $hero2->CurrentHP lt (0 - $hero2->Con)}
	{$hero2->Name} has died in battle<br /><br />
	<b>{$hero1->Name}  is victorious!</b><br />
{else if $hero2->CurrentHP lt 0}
	{$hero2->Name} has been knocked out in battle<br /><br />
	<b>{$hero1->Name} is victorious!</b><br />
{/if}

<a href="home.php">Return</a>
