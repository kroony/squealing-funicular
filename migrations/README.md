migrations are screwed
=================

create a file "NNNNNname.php", which executes your database queries.
something like this should be fine.
```
$db->query("create table...");
$db->query("update...");
```

problems
--------
once you create a migration, you cannot modify it; the modification will not run wherever the original migration has already been run.

you can name a file .sql and it will attempt to split it into queries and run them, but this will fail if the script contains semicolons inside strings, for example.

it should run each one in a transaction really.
