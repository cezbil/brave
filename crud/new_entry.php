<?php
include_once '/../classes/dbConfig.php';
include_once '/../classes/User.php';
include_once '/../classes/Entry.php';


$conn = new dbConfig();
$user = new User($conn->getConn());
$entry = new Entry($conn->getConn());

if(!isset($_SESSION['user']))
{
    $user->redirect('../index.php');
}
if(isset($_POST['btn-add']))
{
    $title = $_POST['title'];
    $text = $_POST['text'];
    $ownerId = $_SESSION['user'];

    if($entry->insert($title,$text,$ownerId))
    {
        $user->redirect('../index.php');
    }
    else
    {
        echo "You Have Entered Wrong details!";
    }
}

?>


<?php include_once '/../layouts/header.php'; ?>
<?php include_once '/../layouts/nav.php'; ?>


<div style="margin-top: 35px" class="container">
    <div class="col-sm-4 col-sm-offset-4">
        <form id="newEntry" method="post">
            <h2 >New Entry</h2>
            <label for="inputTitle">Title</label>
            <input name="title" type="text" id="inputTitle" class="form-control" placeholder="Title" required autofocus>
            <label for="inputText">Entry Text</label>
            <textarea class="form-control" name="text" form="newEntry" rows="3">

            </textarea>

            <br>
            <button name="btn-add" class="btn btn-lg btn-primary btn-block" type="submit">Add</button>
        </form>
    </div>
</div> <!-- /container -->

<?php include_once '/../layouts/footer.php'; ?>
