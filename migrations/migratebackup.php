<?php

set_include_path("../site");
require_once("includes/database.class.php");

$db = DB::GetConn();
$res = $db->query("SELECT * FROM migrations");

echo "Finding already run migrations\n";

$already_run = array();

while($obj = $res->fetchObject())
{
    $already_run[$obj->migration_name] = 1;
}

echo "Looking for new migrations\n";
$all = scandir("run");

foreach ($all as $migration) {
    if (!isset($already_run[$migration])) {
        echo "Running migration $migration\n";
        $info = pathinfo($migration);
        $filename = 'run/' . $migration;
        if ($info['extension'] == "php") {
            include($filename);
        } else if ($info['extension'] == "sql") {
            $contents = file_get_contents($filename);
            $queries  = explode(";", $contents);
            foreach ($queries as $query) {
                if (trim($query) != "")
                    $db->query($query);
            }
        } else {
            echo "NOT RUNNING $migration: unknown extension\n";
        }
        echo "Inserting migration $migration\n";
        $insert = array('migration_name' => $migration
                       , 'time' => time() );
        $db->insert('migrations', $insert);
    }
}



?>
