<?php

require_once ('../vendor/autoload.php');

require_once('../config.php');

echo 'Hello world<br>';

$users = \Catalog\Database\Database::getConnection()::table('test_table')->get();


foreach ($users as $u){
    echo $u->id;
    echo $u->name;
    echo "<br>";
}


