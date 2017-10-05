<?php
include_once 'dbConfig.php';
include_once 'User.php';

$conn = new dbConfig();
$user = new User($conn->getConn());

if(isset($_SESSION['user']))
{
    $user->redirect('index.php');
}
if(isset($_POST['btn-login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($user->Login($email,$password))
    {
        $user->redirect('index.php');
    }
    else
    {
        echo "You Have Entered Wrong credentials!";
    }
}

?>


<?php include_once 'header.php'; ?>


<div class="container">
    <div class="col-sm-4 col-sm-offset-4">
    <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
       <br>
        <button name="btn-login" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
    </div>
</div>

<?php include_once 'footer.php'; ?>
