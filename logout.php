<?php
include_once 'dbConfig.php';
include_once 'User.php';

$conn = new dbConfig();
$user = new User($conn->getConn());

if(isset($_SESSION['user']))
{
    $user->logout();

    $user->redirect('login.php');
}

