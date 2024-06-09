<?php

$config = require('config.php');
$db = new Database($config['database']);

// to pass to the view
$heading = 'My Notes';

$currentUserId = 3;

$notes = $db->query("select * from notes where user_id = $currentUserId")->get();


require 'views/notes.view.php';