<?php
include_once '/../classes/dbConfig.php';
include_once '/../classes/User.php';
include_once '/../classes/Entry.php';



$conn = new dbConfig();
$user = new User($conn->getConn());
$entry = new Entry($conn->getConn());
$id = $_GET['view_id'];
$en = $entry->getEntry($id);
if(!isset($_SESSION['user']))
{
    $user->redirect('../index.php');
}


?>


<?php include_once '../layouts/header.php'; ?>
<?php include_once '/../layouts/nav.php'; ?>

<div style="margin-top: 35px" class="container">

    <h2 class="sub-header">Entry </h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Text</th>
                <th colspan="2" align="center">Edit/Delete</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;

            foreach ($en as $row){
                $i++;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id'],ENT_QUOTES | ENT_HTML401,'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($row['title'],ENT_QUOTES | ENT_HTML401,'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($row['entry_text'],ENT_QUOTES | ENT_HTML401,'UTF-8');?></td>

                    <td>


                        <a href="<?php echo "http://$_SERVER[HTTP_HOST]/brave/crud/edit.php?edit_id=" . $row['id']?>" class="btn btn-primary a-btn-slide-text">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            <span><strong>Edit</strong></span>
                        </a>
                    </td>

                    <td>

                        <a href="<?php echo "http://$_SERVER[HTTP_HOST]/brave/crud/delete.php?delete_id=" . $row['id']?>" class="btn btn-danger a-btn-slide-text">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            <span><strong>Delete</strong></span>
                        </a>
                    </td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</div>
<?php include_once '../layouts/footer.php'; ?>

