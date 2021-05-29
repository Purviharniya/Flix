<!-- <iframe src="https://assets.pinterest.com/ext/embed.html?id=859765385106571877" height="336" width="236" frameborder="0"
    scrolling="no"></iframe> -->
<?php

require_once 'config.php';
require_once 'includes/classes/FormSanitizer.php';
require_once 'includes/classes/Constants.php';
require_once 'includes/classes/Account.php';

$account = new Account($con);

if (isset($_POST['submit-btn'])) {
    $username = FormSanitizer::sanitizeFormUsername($_POST['uname']);
    $pass = FormSanitizer::sanitizeFormPassword($_POST['password']);

    $success = $account->login($username, $pass);

    if ($success == true) {

        //store session variables
        $_SESSION['userLoggedIn'] = $username;

        //if remember me was checked, store the cookies
        if (!empty($_POST['rem-me'])) {
            setcookie("member_login", $username, time() + (10 * 365 * 24 * 60 * 60));
            setcookie("member_password", $pass, time() + (10 * 365 * 24 * 60 * 60));
        } else {
            if (isset($_COOKIE["member_login"])) {
                setcookie("member_login", "");
            }
            if (isset($_COOKIE["member_password"])) {
                setcookie("member_password", "");
            }
        }

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
                    <h3 class="py-2 mb-5">Sign In</h3>
                    <form action="login.php" method="POST">

                        <div class="form-group">
                            <?php echo $account->getError(Constants::$loginFailed); ?>
                            <label for="uname">User Name</label>
                            <input type="text" class="form-control" name='uname' id="uname" placeholder="pjh" value="<?php

if (isset($_COOKIE["member_login"])) {
    echo $_COOKIE["member_login"];
} else {
    getInputs('uname');
}
?>" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name='password' id="password" value="<?php
if (isset($_COOKIE["member_password"])) {
    echo $_COOKIE["member_password"];
}
?>" required>
                        </div>

                        <div class="form-group flex-row">
                            <input class="form-check" type="checkbox" name='rem-me'
                                <?php if (isset($_COOKIE["member_login"])) {?> checked <?php }?>
                                style="display:revert;">
                            <label class="form-check-label">Remember me</label>
                        </div>


                        <div class="form-group">
                            <input type="submit" name="submit-btn" class="btn btn-primary" value="Sign In">
                        </div>
                        <div class="form-group">
                            <a href="register.php"> Don't have an account? Sign Up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php";?>

</body>

</html>