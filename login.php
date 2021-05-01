<!-- <iframe src="https://assets.pinterest.com/ext/embed.html?id=859765385106571877" height="336" width="236" frameborder="0"
    scrolling="no"></iframe> -->
<?php

if (isset($_POST['submit-btn'])) {

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Netflix</title>
    <?php include "includes/header.php";?>
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
                            <label for="uname">User Name</label>
                            <input type="text" class="form-control" name='uname' id="uname" placeholder="pjh" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name='password' id="password" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit-btn" class="btn btn-primary" value="Sign Up">
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