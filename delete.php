<?php
include_once 'dbConfig.php';
include_once 'User.php';
include_once 'Entry.php';

$conn = new dbConfig();
$user = new User($conn->getConn());
$entry = new Entry($conn->getConn());

$id = $_GET['delete_id'];
$entry->delete($id);
$user->redirect('index.php');