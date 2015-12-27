<?php

echo "Rolling 100 d6<br />";
$i=0;
$rolls = array();
while($i<600)
{
  array_push($rolls, rand(1,6));
  $i++;
}

$occurences = array_count_values($rolls);
ksort($occurences);
print_r($occurences);

?>
<br />
<hr>
<br />
<form action="login.php">
  Username: <input name="username" type="text"><br />
  password: <input name="password" type="password"><br />
  <input type="submit" value="Submit">
</form>