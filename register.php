<!-- <iframe src="https://assets.pinterest.com/ext/embed.html?id=859765385106571877" height="336" width="236" frameborder="0"
    scrolling="no"></iframe> -->



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
                    <h3 class="py-2 mb-5">Sign Up</h3>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" class="form-control" name='fname' id="fname" placeholder="Purvi"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" class="form-control" name='lname' id="lname" placeholder="Harniya"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">User Name</label>
                            <input type="text" class="form-control" name='uname' id="uname" placeholder="pjh" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" name='email' id="email"
                                placeholder="abcd@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" name='password' id="password" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirm Password</label>
                            <input type="password" class="form-control" name='confirmpass' id="confirmpass" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit-btn" class="btn btn-primary" value="Sign Up">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php";?>

</body>

</html>