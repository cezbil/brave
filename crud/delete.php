<?php
include_once '/../classes/dbConfig.php';
include_once '/../classes/User.php';
include_once '/../classes/Entry.php';

$conn = new dbConfig();
$user = new User($conn->getConn());
$entry = new Entry($conn->getConn());

$id = $_GET['delete_id'];
$entry->delete($id);
$user->redirect('../index.php');