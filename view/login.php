<?php
include 'header.php';
$app = new USERS();
// check Login request

if (!empty($_POST['btnLogin'])) {
    $app = new USERS();


    $email = trim(@$_POST['email']);
    $email = $app->SafeString($email);

    $username = trim(@$_POST['email']);
    $username = $app->SafeString($username);

    $password = trim(@$_POST['password']);
    $password = $app->SafeString($password);

    $ip = $app->getRealIpAddr();

    if ($email == "") {
        $login_error_message = 'نام کاربری وارد نشده';
    } else if ($app->CheckBanUser($username) == 1) {
        $login_error_message = 'شما اخراج شده اید';
    } else if ($app->CheckMultiLogin($ip) == 1) {
        $login_error_message = 'با چند تا یوسر میخوای بیای تو ؟؟';
    } else if ($app->CheckipBanUser($ip) == 1) {
        $login_error_message = 'شما اخراج شده اید';
    } else if (@$_COOKIE['ban'] == 'yes') {
        $login_error_message = 'شما اخراج شده اید';
    } else if ($password == "") {
        $login_error_message = 'فیلد رمز عبور مورد نیاز است!';
    } else if ($_POST['captcha'] != $_SESSION['rand_code']) {
        $login_error_message = 'کد اشتباه وارد شده است';
    } else {
        $user_id = $app->Login($username, $password); // check user login
        if ($user_id > 0) {
            $_SESSION['page'] = 'main';
            $_SESSION['onlineid'] = rand();
            $_SESSION['time'] = date("i");

            $user = $app->GetUserid($_SESSION['onlineid']);
            @$_SESSION['clientid'] = $user->id;
            $clientid = $app->id;
            $ip = $app->getRealIpAddr();

            $app->InsertUserToOnlineList($username, $_SESSION['onlineid'], $clientid, $_SESSION['time'], $ip);
            // get give client id at main.php 
            header("Location: /");
        } else {
            $login_error_message = 'جزئیات ورود نا معتبر می باشد!';
        }
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-5 well mx-auto" style="margin-top: 7rem; text-align: right;">
            <h4>ورود</h4>
            <?php
            if (isset($login_error_message)) {
                echo '<div class="alert alert-danger">' . $login_error_message . '</div>';
            }
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">نام کاربری</label>
                    <input type="text" name="email" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="">رمز عبور</label>
                    <input type="password" name="password" class="form-control" />
                </div>
                <div class="form-group">
                    <center>
                        <img src="captcha.php">
                    </center>
                    <input type="text" class="form-control" name="captcha">
                </div>
                <center>
                    <div class="form-group">
                        <input type="submit" name="btnLogin" class="btn btn-primary" value="ورود" />

            </form>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" style="visibility:hidden;" name="register" value="true" class="form-control" />
                    <input type="submit" name="btnr" class="btn btn-primary" value="ثبت نام" />
                </div>
            </form>
            </center>
        </div>
    </div>
</div>
</body>

</html>