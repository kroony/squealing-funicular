<style>
body {
	font-family: sans-serif;
	font-size: 15px;
}

.tree ul {
	position: relative;
	padding: 1em 0;
	white-space: nowrap;
	margin: 0 auto;
	text-align: center;
}
.tree ul::after {
	content: '';
	display: table;
	clear: both;
}

.tree li {
	display: inline-block;
	vertical-align: top;
	text-align: center;
	list-style-type: none;
	position: relative;
	padding: 1em .5em 0 .5em;
}
.tree li::before, .tree li::after {
	content: '';
	position: absolute;
	top: 0;
	right: 50%;
	border-top: 1px solid #ccc;
	width: 50%;
	height: 1em;
}
.tree li::after {
	right: auto;
	left: 50%;
	border-left: 1px solid #ccc;
}
.tree li:only-child::after, .tree li:only-child::before {
	display: none;
}
.tree li:only-child {
	padding-top: 0;
}
.tree li:first-child::before, .tree li:last-child::after {
	border: 0 none;
}
.tree li:last-child::before {
	border-right: 1px solid #ccc;
	border-radius: 0 5px 0 0;
}
.tree li:first-child::after {
	border-radius: 5px 0 0 0;
}

.tree ul ul::before {
	content: '';
	position: absolute;
	top: 0;
	left: 50%;
	border-left: 1px solid #ccc;
	width: 0;
	height: 1em;
}

.tree li a {
	border: 1px solid #ccc;
	padding: .5em .75em;
	text-decoration: none;
	display: inline-block;
	border-radius: 5px;
	color: #333;
	position: relative;
	top: 1px;
}

.tree li a:hover,
.tree li a:hover + ul li a {
	background: #e9453f;
	color: #fff;
	border: 1px solid #e9453f;
}

.tree li a:hover + ul li::after,
.tree li a:hover + ul li::before,
.tree li a:hover + ul::before,
.tree li a:hover + ul ul::before {
	border-color: #e9453f;
}
</style>


<div class="tree">
<ul>
	<li>
		<a href="#">
			{$baseClass->Name}
			<br />Max Level: {$baseClass->LevelCap}
			{if $baseClass->Name != "Commoner"}<br />Favoured Attribute: {$baseClass->FavouredAttribute}{/if}
		</a>
		{if count($childClasses) > 0}
			<ul>
				{foreach from=$childClasses item=childClass}
				<li>
					<a href="#">
						{$childClass->Name}
						<br />Level: {$baseClass->LevelCap + 1} - {$childClass->LevelCap}
						<br />Requires: {$childClass->PrerequisiteAttribute} {$childClass->PrerequisiteTarget}
						<br />Favoured Attribute: {$childClass->FavouredAttribute}
					</a>
				</li>
				{/foreach}
			</ul>
		{/if}
	</li>
</ul>
</div>