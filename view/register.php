<?php
include 'header.php';
?>
    <div class="container">
      
<?php

$app = new USERS();

// check Register request
if (!empty($_POST['btnRegister'])) {
    if (@$_POST['name'] == "") {
        $register_error_message = 'فیلد نام مورد نیاز است!';
    } else if ($_POST['email'] == "") {
        $register_error_message = 'فیلد ایمیل مورد نیاز است!';
    } else if ($_POST['captcha'] != $_SESSION['rand_code']) {
        $register_error_message = 'کد اشتباه وارد شده است';
    } else if ($_POST['password'] == "") {
        $register_error_message = 'فیلد رمز عبور مورد نیاز است!';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $register_error_message = 'آدرس ایمیل نامعتبر است!';
    } else if ($app->isEmail($_POST['email'])) {
        $register_error_message = 'این ایمیل در حال حاضروجود دارد!';
    } else {

// check input post with function safeinput

        $name = $_POST['name'];
        $name = $app->SafeString($name);
        $name = $app->EncryptString('encrypt', $name);

        $email = $_POST['email'];
        $email = $app->SafeString($email);
        $email = $app->EncryptString('encrypt', $email);

        $password = $_POST['password'];
        $password = $app->SafeString($password);

        $user_id = $app->Register($name, $email, $password);
        // set session and redirect user to the login page
        $_SESSION['registered'] = 'true';
        $_SESSION['page'] = 'login';
        header('Refresh: 0');
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>فرم ثبت نام / ورود</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-5 well mx-auto" style="margin-top: 5rem; text-align: right;">
            <h4>ثبت نام</h4>
            <?php
            if (isset($register_error_message)) {
                echo '<div class="alert alert-danger">' . $register_error_message . '</div>';
            }
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">نام</label>
                    <input type="text" name="name" maxlength="20" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="">ایمیل</label>
                    <input type="email" name="email" maxlength="40" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="">رمز عبور</label>
                    <input type="password" name="password" maxlength="25" class="form-control"/>
                </div>
                <div class="form-group">
                    <center>
                        <img src="captcha.php">
                    </center>
                    <input type="text" class="form-control" name="captcha">
                </div>
                <div class="form-group">
                    <input type="submit" name="btnRegister" class="btn btn-primary" value="ثبت نام"/>
                </div>
            </form>
            <form action="" method="post">
                        <div class="form-group">
                            <input type="text" style="visibility:hidden;" name="login" value="true" class="form-control" />
                            <input type="submit" name="btnLogin" class="btn btn-primary" value="ورود" />
                        </div>
                    </form>
        </div>
    </div>
</div>

</body>
</html>
