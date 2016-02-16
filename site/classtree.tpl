<style>
body {
	font-family: sans-serif;
	font-size: 15px;
}

$border-width: 1px;
$reverse: false;

.tree {
	@if $reverse {
		transform: rotate(180deg);
		transform-origin: 50%;
	}
}

.tree ul {
	position: relative;
	padding: 1em 0; 
	white-space: nowrap;
	margin: 0 auto;
	text-align: center;
	&::after {
		content: '';
		display: table;
		clear: both;
	}
}

.tree li {
  display: inline-block; // need white-space fix
  vertical-align: top;
  text-align: center;
	list-style-type: none;
	position: relative;
	padding: 1em .5em 0 .5em;
  &::before,
  &::after {
    content: '';
    position: absolute; 
    top: 0; 
    right: 50%;
    border-top: $border-width solid #ccc;
    width: 50%; 
    height: 1em;
  }
  &::after {
    right: auto; 
    left: 50%;
	  border-left: $border-width solid #ccc;
  }
  &:only-child::after,
  &:only-child::before {
    display: none;
  }
  &:only-child {
    padding-top: 0;
  }
  &:first-child::before,
  &:last-child::after {
    border: 0 none;
  }
  &:last-child::before{
    border-right: $border-width solid #ccc;
    border-radius: 0 5px 0 0;
  }
  &:first-child::after{
    border-radius: 5px 0 0 0;
  }
}

.tree ul ul::before{
	content: '';
	position: absolute; 
  top: 0; 
  left: 50%;
	border-left: $border-width solid #ccc;
	width: 0; 
  height: 1em;
}

.tree li a {
	border: $border-width solid #ccc;
	padding: .5em .75em;
	text-decoration: none;
	display: inline-block;
	border-radius: 5px;
  color: #333;
  position: relative;
  top: $border-width;
  @if $reverse {
    transform: rotate(180deg);
  }
}

.tree li a:hover,
.tree li a:hover+ul li a {
	background: #e9453f;
  color: #fff;
  border: $border-width solid #e9453f;
}

.tree li a:hover + ul li::after, 
.tree li a:hover + ul li::before, 
.tree li a:hover + ul::before, 
.tree li a:hover + ul ul::before{
	border-color:  #e9453f;
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
		</ul>
	</li>
</ul>

</div>