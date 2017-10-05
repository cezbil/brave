<?php

include_once 'dbConfig.php';
include_once 'User.php';
include_once 'Entry.php';

$conn = new dbConfig();
$user = new User($conn);
$entry = new Entry($conn->getConn());
$entries = $entry->getEntries($_SESSION['user']);
if(!isset($_SESSION['user']))
{
    $user->redirect('login.php');
}

?>
<?php include_once 'header.php'; ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">Brave</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> logout</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
        </div>
    </div>
</nav>
<div style="margin-top: 30px" class="container">
    <h2 class="sub-header">Entries</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Text</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($entries as $row){
             ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td><?php echo $row['title']?></td>
                <td><?php echo $row["entry_text"]?></td>

            </tr>
<?php } ?>
            </tbody>
        </table>
    </div>
</div>

</div>
<?php include_once 'footer.php'; ?>

