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

<div class="container-fluid">
<h1>Class Tree</h1>

<div class="tree">
<ul>
	<li>
		<a href="#">Commoner</a>
		<ul>
			<li>
				<a href="#">Acolyte</a>
				<ul>
					<li>
						<a href="#">Cultist</a>
						<ul>
							<li>
								<a href="#">Anti Paladin</a>
							</li>
							<li>
								<a href="#">Cleric</a>
								<ul>
									<li>
										<a href="#">Angel Whisperer</a>
										<ul>
											<li>
												<a href="#">Ascendant</a>
											</li>
										</ul>
									</li>
									<li>
										<a href="#">Necromancer</a>
										<ul>
											<li>
												<a href="#">Lich</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">Priest</a>
						<ul>
							<li>
								<a href="#">Cleric</a>
								<ul>
									<li>
										<a href="#">Angel Whisperer</a>
										<ul>
											<li>
												<a href="#">Ascendant</a>
											</li>
										</ul>
									</li>
									<li>
										<a href="#">Necromancer</a>
										<ul>
											<li>
												<a href="#">Lich</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
							<li>
								<a href="#">Paladin</a>
								<ul>
									<li>
										<a href="#">Angel Whisperer</a>
										<ul>
											<li>
												<a href="#">Ascendant</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">Apprentice</a>
				<ul>
					<li>
						<a href="#">Wizard</a>
						<ul>
							<li>
								<a href="#">Sorcerer</a>
							</li>
							<li>
								<a href="#">Enchanter</a>
							</li>
							<li>
								<a href="#">Conjurer</a>
							</li>
							<li>
								<a href="#">Necromancer</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">Witch</a>
						<ul>
							<li>
								<a href="#">Enchanter</a>
							</li>
							<li>
								<a href="#">Conjurer</a>
							</li>
							<li>
								<a href="#">Necromancer</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">Squire</a>
				<ul>
					<li>
						<a href="#">Soldier</a>
						<ul>
							<li>
								<a href="#">Knight</a>
								<ul>
									<li>
										<a href="#">Warden</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="#">Cavalier</a>
								<ul>
									<li>
										<a href="#">Marshall</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">Archer</a>
						<ul>
							<li>
								<a href="#">Knight</a>
								<ul>
									<li>
										<a href="#">Warden</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="#">Sharpshooter</a>
							</li>
							<li>
								<a href="#">Ranger</a>
								<ul>
									<li>
										<a href="#">Marshall</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">Brawler</a>
				<ul>
					<li>
						<a href="#">Hunter</a>
						<ul>
							<li>
								<a href="#">Ranger</a>
								<ul>
									<li>
										<a href="#">Marshall</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="#">Druid</a>
							</li>
							<li>
								<a href="#">Assassin</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">Mercenary</a>
						<ul>
							<li>
								<a href="#">Cavalier</a>
								<ul>
									<li>
										<a href="#">Marshall</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="#">Assassin</a>
								<ul>
									<li>
										<a href="#">Warden</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>
	</li>
</ul>

</div>