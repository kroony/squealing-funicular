{if $Hero->Status == ''}
  <form class="form-inline" action="/moveHero.php">
    <div class="form-group">
      <input type="hidden" name="ID" value="{$Hero->ID}">
      <button type="submit" class="btn btn-default"><i class="fas fa-walking"></i> Travel To</button>
      <select class="form-control" id="moveSel{$Hero->ID}" name="dest">
        {foreach $unlockedLocations as $location}
          {if $location->PageName != $currentpage}
            <option value="{$location->ID}">{$location->Name}</option>
          {/if}
        {/foreach}
      </select>
    </div>
  </form>
{/if}