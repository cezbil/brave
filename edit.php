<?php
include_once 'dbConfig.php';
include_once 'User.php';
include_once 'Entry.php';

$conn = new dbConfig();
$user = new User($conn->getConn());
$entry = new Entry($conn->getConn());
$id = $_GET['edit_id'];
$en = $entry->getEntry($id);
if(!isset($_SESSION['user']))
{
    $user->redirect('index.php');
}
if(isset($_POST['btn-edit']))
{
    $title = $_POST['title'];
    $text = $_POST['text'];
    $ownerId = $_SESSION['user'];

    if($entry->update($id,$title,$text))
    {
        $user->redirect('index.php');
    }
    else
    {
        echo "You Have Entered Wrong details!";
    }
}

?>


<?php include_once 'header.php'; ?>
<?php foreach ($en as $row) {
?>


<div class="container">
    <div class="col-sm-4 col-sm-offset-4">
        <form id="editEntry" method="post">
            <h2 >Edit Entry</h2>
            <label for="inputTitle">Title</label>
            <input name="title" type="text" id="inputTitle" class="form-control" placeholder="Title" value="<?php echo $row['title'];?>" required autofocus>
            <label for="inputText">Entry Text</label>
            <textarea class="form-control" name="text" form="editEntry" rows="3">
<?php echo $row['entry_text'];}?>
            </textarea>

            <br>
            <button name="btn-edit" class="btn btn-lg btn-primary btn-block" type="submit">Edit</button>
        </form>
    </div>
</div>

<?php include_once 'footer.php'; ?>
