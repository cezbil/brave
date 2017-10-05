<?php
include_once '../classes/dbConfig.php';
include_once '../classes/User.php';

$conn = new dbConfig();
$user = new User($conn->getConn());

if(isset($_SESSION['user']))
{
    $user->redirect('../index.php');
}
if(isset($_POST['btn-register']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($user->Register($name,$password, $email))
    {
        $user->redirect('../index.php');
    }
    else
    {
        echo "You Have Entered Wrong credentials!";
    }
}

?>


<?php include_once '/../layouts/header.php'; ?>


<div style="margin-top: 35px" class="container">
    <div class="col-sm-4 col-sm-offset-4">
    <form class="form-register" method="post">
        <h2 class="form-register-heading">Registration Form</h2>
        <label for="inputName" >Name</label>
        <input name="name" type="text" id="inputName" class="form-control" placeholder="Name" required autofocus>
          <label for="inputEmail" >Email address</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required >
        <label for="inputPassword" >Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
       <br>
        <button name="btn-register" class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    </form>
    </div>
</div>

<?php include_once '/../layouts/footer.php'; ?>
