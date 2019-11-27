<?php

require_once ('../vendor/autoload.php');

require_once('../config.php');

echo 'TEST<br>';

$users = \Catalog\Database\Database::getConnection()::table('test_table')->get();

echo 'test...';

foreach ($users as $u){
    echo 'Enter loop';
    echo $u->id;
    echo $u->name;
}


