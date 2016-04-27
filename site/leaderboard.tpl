<div class="container-fluid">
	
	
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Top 10 by XP</a>
				</h4>
			</div>
			<div id="collapse1" class="panel-collapse collapse in">
				<div class="panel-body">
					<table class='table table-condensed table-hover'>
						<thead>
							<tr>
								<th>Rank</th>
								<th>Name</th>
								<th>Type</th>
								<th>Level</th>
								<th>XP</th>
								<th>User</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$XPHeroes key=rank item=Hero}
							<tr>
								<td>{$rank + 1}</td>
								<td>{str_replace("'", "", $Hero->Name)}</td>
								<td>{$Hero->Race->Name} {$Hero->HeroClass->Name}</td>
								<td>{$Hero->Level}</td>
								<td>
									<div class="progress">
										<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{$Hero->CurrentXP}"
										aria-valuemin="0" aria-valuemax="{$Hero->LevelUpXP}" style="width:{$Hero->CurrentXP / $Hero->LevelUpXP * 100}%">
											<span>{number_format($Hero->CurrentXP)}XP</span>
										</div>
									</div>
								</td>
								<td>
									{if !empty($Hero->GetOwner())}
										<a href="viewUser.php?ID={$Hero->OwnerID}">{$Hero->GetOwner()->username}</a>
									{else}
										Owner Unknown (ID: {$Hero->OwnerID})
									{/if}
								</td>
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Top 10 by Kills</a>
				</h4>
			</div>
			<div id="collapse2" class="panel-collapse collapse">
				<div class="panel-body">
					<table class='table table-condensed table-hover'>
						<thead>
							<tr>
								<th>Rank</th>
								<th>Name</th>
								<th>Type</th>
								<th>Level</th>
								<th>Kills</th>
								<th>User</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$KillHeroes key=rank item=Hero}
							<tr>
								<td>{$rank + 1}</td>
								<td>{str_replace("'", "", $Hero->Name)}</td>
								<td>{$Hero->Race->Name} {$Hero->HeroClass->Name}</td>
								<td>{$Hero->Level}</td>
								<td>{$Hero->Kills}</td>
								<td>
									{if !empty($Hero->GetOwner())}
										<a href="viewUser.php?ID={$Hero->OwnerID}">{$Hero->GetOwner()->username}</a>
									{else}
										Owner Unknown (ID: {$Hero->OwnerID})
									{/if}
								</td>
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Top 10 by Age</a>
				</h4>
			</div>
			<div id="collapse3" class="panel-collapse collapse">
				<div class="panel-body">
					<table class='table table-condensed table-hover'>
						<thead>
							<tr>
								<th>Rank</th>
								<th>Name</th>
								<th>Type</th>
								<th>Level</th>
								<th>Age</th>
								<th>User</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$OldHeroes key=rank item=Hero}
							<tr>
								<td>{$rank + 1}</td>
								<td>{str_replace("'", "", $Hero->Name)}</td>
								<td>{$Hero->Race->Name} {$Hero->HeroClass->Name}</td>
								<td>{$Hero->Level}</td>
								<td>{$Hero->Age}</td>
								<td>
									{if !empty($Hero->GetOwner())}
										<a href="viewUser.php?ID={$Hero->OwnerID}">{$Hero->GetOwner()->username}</a>
									{else}
										Owner Unknown (ID: {$Hero->OwnerID})
									{/if}
								</td>
							</tr>
							{/foreach}
						</tbody>
					</table>					
				</div>
			</div>
		</div>
		
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Worst 10 By Hero Deaths</a>
				</h4>
			</div>
			<div id="collapse4" class="panel-collapse collapse">
				<div class="panel-body">
					<table class='table table-condensed table-hover'>
						<thead>
							<tr>
								<th>Rank</th>
								<th>Username</th>
								<th>Deaths</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$DeathUsers key=rank item=User}
							<tr>
								<td>{$rank + 1}</td>
								<td><a href="viewUser.php?ID={$User->ID}">{$User->username}</a></td>
								<td>{$User->deaths}</td>
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Top 10 By Total Kills</a>
				</h4>
			</div>
			<div id="collapse5" class="panel-collapse collapse">
				<div class="panel-body">
					<table class='table table-condensed table-hover'>
						<thead>
							<tr>
								<th>Rank</th>
								<th>Username</th>
								<th>Kills</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$KillUsers key=rank item=User}
							<tr>
								<td>{$rank + 1}</td>
								<td><a href="viewUser.php?ID={$User->ID}">{$User->username}</a></td>
								<td>{$User->kills}</td>
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Top 10 by Wealth</a>
				</h4>
			</div>
			<div id="collapse6" class="panel-collapse collapse">
				<div class="panel-body">
					
					<table class='table table-condensed table-hover'>
						<thead>
							<tr>
								<th>Rank</th>
								<th>Username</th>
								<th>Gold</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$WealthUsers key=rank item=User}
							<tr>
								<td>{$rank + 1}</td>
								<td><a href="viewUser.php?ID={$User->ID}">{$User->username}</a></td>
								<td>{$User->gold}</td>
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
