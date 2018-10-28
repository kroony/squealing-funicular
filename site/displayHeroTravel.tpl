{if $Hero->Status == ''}
  <form class="form-inline" action="/moveHero.php">
    <div class="form-group">
      <label for="moveSel{$Hero->ID}">Move To:</label>
      <select class="form-control" id="moveSel{$Hero->ID}" name="dest">
        {foreach $unlockedLocations as $location}
          {if $location->PageName != $currentpage}
          <option value="{$location->ID}">{$location->Name}</option>
        {/foreach}
      </select>
    </div>
    <input type="hidden" name="ID" value="$Hero->ID">
    <button type="submit" class="btn btn-default">Travel</button>
  </form>
{/if}