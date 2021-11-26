<?php
/**
 * Tutorial: PHP Login Registration system
 *
 * Page : Profile
 */

// Start Session
session_start();

// check user login
if(empty($_SESSION['user_id']))
{
    header("Location: login.php");
}
// Database connection
require_once  'db.php';
$db = DB();

// Application library ( with DemoLib class )
require_once  'library.php';
$app = new USERS();

$user = $app->UserDetails($_SESSION['user_id']); // get user details

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dastan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="well">
            <h2 style="text-align: center">
                پروفایل
            </h2>
            <h3>سلام <?php echo $user->name ?></h3>
            <p><br>
به سیستم ثبت نام و ورود به سیستم با php pdo  خوش آمدید.
</p>   <br>
            <a href="logout.php" class="btn btn-primary">خروج</a>
        </div>
    </div>
</body>
</html>
