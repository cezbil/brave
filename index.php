<?php
include_once 'User.php';
include_once 'dbConfig.php';
include_once 'Entry.php';
$conn = new dbConfig();
$user = new User($conn);
if(!isset($_SESSION['user']))
{
    $user->redirect('login.php');
}



$entry = new Entry($conn->getConn());
$entries = $entry->getEntries($_SESSION['user']);

?>
<?php include_once 'header.php'; ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">Brave</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo "http://$_SERVER[HTTP_HOST]/brave/new_entry.php"; ?>">New Entry</a></li>
                <li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> logout</a></li>
            </ul>

        </div>
    </div>
</nav>
<div style="margin-top: 35px" class="container">
    <h2 class="sub-header">Entries</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Text</th>
                <th>Edit/Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($entries as $row){
             ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id'],ENT_QUOTES | ENT_HTML401,'UTF-8');?></td>
                <td><?php echo htmlspecialchars($row['title'],ENT_QUOTES | ENT_HTML401,'UTF-8');?></td>
                <td><?php echo htmlspecialchars($row['entry_text'],ENT_QUOTES | ENT_HTML401,'UTF-8');?></td>

                <td>

                    <div class="row">

                        <a href="#" class="btn btn-primary a-btn-slide-text">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            <span><strong>Edit</strong></span>
                        </a>
                        <a href="<?php echo "http://$_SERVER[HTTP_HOST]/brave/delete.php/delete_id=" . $row['id']?>" class="btn btn-primary a-btn-slide-text">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            <span><strong>View</strong></span>
                        </a>
                        <a href="<?php echo "http://$_SERVER[HTTP_HOST]/brave/delete.php?delete_id=" . $row['id']?>" class="btn btn-danger a-btn-slide-text">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            <span><strong>Delete</strong></span>
                        </a>
                    </div>
                </td>

            </tr>
<?php } ?>
            </tbody>
        </table>
    </div>
</div>

</div>
<?php include_once 'footer.php'; ?>

