<?php
include "includes/header.php";
require_once 'includes/classes/FormSanitizer.php';
require_once 'includes/classes/Constants.php';
require_once 'includes/classes/Account.php';
$detMsg = '';
?>

<?php

if (isset($_POST['userbtn'])) {

    $acc = new Account($con);

    $fname = FormSanitizer::sanitizeFormString($_POST['fname']);
    $lname = FormSanitizer::sanitizeFormString($_POST['lname']);
    $uname = FormSanitizer::sanitizeFormUsername($_POST['uname']);
    $email = FormSanitizer::sanitizeFormEmail($_POST['email']);

    if ($acc->updateDetails($fname, $lname, $uname, $email)) {
        //success
        $detMsg = "<div class='alert alert-success'> Details updated Successfully <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
    } else {
        //failure
        $erMsg = $acc->getFirstError();
        $detMsg = "<div class='alert alert-danger'>$erMsg<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
    }
}

?>

<?php

$user = new User($con, $username);

$fname = isset($_POST['fname']) ? $_POST['fname'] : $user->getFname();
$lname = isset($_POST['lname']) ? $_POST['lname'] : $user->getLname();
$email = isset($_POST['email']) ? $_POST['email'] : $user->getEmail();
$uname = isset($_POST['uname']) ? $_POST['uname'] : $user->getUsername();

?>

<div class="settingsContainer container">
    <div class="formSection">
        <form method="post">

            <h2>User Details </h2>
            <div class="form-group">
                <?php
if (isset($_POST['userbtn'])) {
    echo $detMsg;
}?>
            </div>
            <div class="form-group">
                <label for="">First Name</label>
                <input type="text" class="form-control" name='fname' value='<?php echo $fname; ?>'>
            </div>
            <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" class="form-control" name='lname' value='<?php echo $lname; ?>'>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" name='email' value='<?php echo $email; ?>'>
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" class="form-control" name='uname' value='<?php echo $uname; ?>'>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name='userbtn' value='Update'>
            </div>
        </form>
    </div>

    <div class="formSection">
        <form method="post">

            <h2>Change Password </h2>
            <div class="form-group">
                <label for="">Current password</label>
                <input type="password" class="form-control" name='cpass'>
            </div>
            <div class="form-group">
                <label for="">New password</label>
                <input type="password" class="form-control" name='pass2'>
            </div>
            <div class="form-group">
                <label for="">Confirm New password</label>
                <input type="password" class="form-control" name='cpass2'>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name='passbtn' value='Change'>
            </div>
        </form>
    </div>
</div>

<?php 
include "includes/footer.php";
?>