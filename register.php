<!-- <iframe src="https://assets.pinterest.com/ext/embed.html?id=859765385106571877" height="336" width="236" frameborder="0"
    scrolling="no"></iframe> -->

<?php
require_once 'config.php';
require_once 'includes/classes/FormSanitizer.php';
require_once 'includes/classes/Constants.php';
require_once 'includes/classes/Account.php';

$account = new Account($con);

if (isset($_POST['submit-btn'])) {
    $firstname = FormSanitizer::sanitizeFormString($_POST['fname']);
    $lastname = FormSanitizer::sanitizeFormString($_POST['lname']);
    $username = FormSanitizer::sanitizeFormUsername($_POST['uname']);
    $email = FormSanitizer::sanitizeFormEmail($_POST['email']);
    $conemail = FormSanitizer::sanitizeFormEmail($_POST['cemail']);
    $pass = FormSanitizer::sanitizeFormPassword($_POST['password']);
    $confirmpass = FormSanitizer::sanitizeFormPassword($_POST['confirmpass']);

    $success = $account->register($firstname, $lastname, $username, $email, $conemail, $pass, $confirmpass);

    if ($success == true) {
        //store session variables
        $_SESSION['userLoggedIn'] = $username;
        header("Location: index.php");
    }
}

function getInputs($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Netflix</title>
    <?php include "includes/header_scripts.php";?>
</head>

<body>
    <div class="container-fluid">
        <div class="row" style="min-height:100vh;">
            <div class="col-md-6 col-12 order-md-last" style="padding:0px;">
                <img src='assets/register.jpg' alt='' class='reg-img'>
            </div>
            <div class="col-md-6 col-12 align-self-center">
                <div class="signup-cnt">
                    <h3 class="py-2 mb-5">Sign Up</h3>
                    <form action="register.php" method="POST">
                        <div class="form-group">
                            <?php echo $account->getError(Constants::$firstNameChars); ?>
                            <?php echo $account->getError(Constants::$firstNameInvalid); ?>

                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" name='fname' id="fname" placeholder="Purvi"
                                value="<?php getInputs('fname');?>" required>
                        </div>
                        <div class="form-group">
                            <?php echo $account->getError(Constants::$lastNameChars); ?>
                            <?php echo $account->getError(Constants::$lastNameInvalid); ?>

                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" name='lname' id="lname" placeholder="Harniya"
                                value="<?php getInputs('lname');?>" required>
                        </div>
                        <div class="form-group">
                            <?php echo $account->getError(Constants::$userNameChars); ?>
                            <?php echo $account->getError(Constants::$userNameDup); ?>
                            <label for="uname">User Name</label>
                            <input type="text" class="form-control" name='uname' id="uname" placeholder="pjh"
                                value="<?php getInputs('uname');?>" required>
                        </div>
                        <div class="form-group">
                            <?php echo $account->getError(Constants::$emailInvalid); ?>
                            <?php echo $account->getError(Constants::$emailMatch); ?>
                            <?php echo $account->getError(Constants::$emailDup); ?>
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name='email' id="email"
                                value="<?php getInputs('email');?>" placeholder="purvi@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="cemail">Confirm Email</label>
                            <input type="email" class="form-control" name='cemail' id="cemail"
                                value="<?php getInputs('cemail');?>" placeholder="purvi@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <?php echo $account->getError(Constants::$passwordMatch); ?>
                            <?php echo $account->getError(Constants::$invalidPassword); ?>
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name='password' id="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmpass">Confirm Password</label>
                            <input type="password" class="form-control" name='confirmpass' id="confirmpass" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit-btn" class="btn btn-primary" value="Sign Up">
                        </div>
                        <div class="form-group">
                            <a href="login.php"> Have an account? Sign In</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php";?>

</body>

</html>