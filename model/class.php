<?php

class USERS
{

    // Register New User

    public function Register($name, $email, $password)
    {
        try {
            $db = DB();
            $query = $db->prepare("INSERT INTO users(name, email, password) VALUES (:name,:email,:password)");
            $query->bindParam("name", $name, PDO::PARAM_STR);
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $enc_password = hash('sha256', $password);
            $query->bindParam("password", $enc_password, PDO::PARAM_STR);
            $query->execute();
            return $db->lastInsertId();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    // add product to ordering list

    public function ordering($name, $price)
    {
        try {
            $db = DB();
            $query = $db->prepare("INSERT INTO ordering(name, price) VALUES (:name,:price)");
            $query->bindParam("name", $name, PDO::PARAM_STR);
            $query->bindParam("price", $price, PDO::PARAM_STR);
            $query->execute();
            return $db->lastInsertId();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }


    /*
     * Login
     *
     * @param $username, $password
     * @return $mixed
     * */
    public function Login($username, $password)
    {
        try {
            $db = DB();
            $app = new USERS();
            $app-> DeletBanUser();
            $username = $app->EncryptString('encrypt', $username);
            $query = $db->prepare("SELECT id FROM users WHERE (name=:name) AND password=:password");
            $query->bindParam("name", $username, PDO::PARAM_STR);
            $enc_password = hash('sha256', $password);
            $query->bindParam("password", $enc_password, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_OBJ);
                $_SESSION['name'] = $username;
                $_SESSION['userid'] = $result->id;
                return $result->id;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function CheckBanUser($username){
        try {
            $db = DB();
            $app = new USERS();
            $username = $app->EncryptString('encrypt', $username);
            $user = $app->GetIdByName($username);
            @$clientid = $user->id;
            $query = $db->prepare("SELECT * FROM ban WHERE clientid=:clientid");
            $query->bindParam("clientid", $clientid, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $_SESSION['ban'] = 'yes';
                return 1;
            } else {
                $_SESSION['ban'] = 'no';
                return 2;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function CheckMultiLogin($ip){
        try {
            $db = DB();
            $app = new USERS();
            $query = $db->prepare("SELECT * FROM online WHERE ip=:ip");
            $query->bindParam("ip", $ip, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $_SESSION['multiuser'] = 'yes';
                return 1;
            } else {
                $_SESSION['multiuser'] = 'no';
                return 2;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function CheckipBanUser($ip){
        try {
            $db = DB();
            $app = new USERS();
            $query = $db->prepare("SELECT * FROM ban WHERE ip=:ip");
            $query->bindParam("ip", $ip, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $_SESSION['ban'] = 'yes';
                return 1;
            } else {
                $_SESSION['ban'] = 'no';
                return 2;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    /*
     * Check Email
     *
     * @param $email
     * @return boolean
     * */
    public function isEmail($email)
    {
        try {
            $db = DB();
            $app = new USERS();
            $email = $app->EncryptString('encrypt', $email);
            $query = $db->prepare("SELECT id FROM users WHERE email=:email");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    // get User Details

    public function UserDetails($id)
    {
        try {
            $db = DB();
            $query = $db->prepare("SELECT * FROM users WHERE id=:id");
            $query->bindParam("id", $id, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return $query->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    // get User Name From ID

    public function GetUserNameFromId($id)
    {
        try {
            $db = DB();
            $query = $db->prepare("SELECT * FROM users WHERE id=:id");
            $query->bindParam("id", $id, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return $query->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    // get User Details

    public function GetUserid($onlineid)
    {
        try {
            $db = DB();
            $query = $db->prepare("SELECT * FROM users WHERE onlineid=:onlineid");
            $query->bindParam("onlineid", $onlineid, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return $query->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    // get UserID by NAME

    public function GetIdByName($name)
    {
        try {
            $db = DB();
            $app = new USERS();
            $query = $db->prepare("SELECT * FROM users WHERE name=:name");
            $query->bindParam("name", $name, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return $query->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    // chat system come from https://7learn.com/tutorials/create-shoutbox-using-php-ajax


    // send message to database

    public function SendMessageToPublic($message, $name)
    {
        $app = new USERS();
        $message = $app->SafeString($message); // delet html code
        date_default_timezone_set('Asia/Tehran');
        $time = date("h:i:sa");
        if ($message == "") {
            exit;
        }
        // check lenght message
        if (strlen($message) <= 30) {
            // encrypt message
            $message = $app->EncryptString('encrypt', $message);


            $db = DB();
            $query = $db->prepare("INSERT INTO message(name, message, time) VALUES (:name,:message,:time)");
            $query->bindParam("name", $name, PDO::PARAM_STR);
            $query->bindParam("message", $message, PDO::PARAM_STR);
            $query->bindParam("time", $time, PDO::PARAM_STR);
            $query->execute();
        }
    }
    public function SendMessageToPrivet($message, $recivername)
    {
        $app = new USERS();
        $message = $app->SafeString($message); // delet html code
        if ($message == "") {
            exit;
        }
        if (strlen($message) <= 40) {
            // encrypt message
            $message = $app->EncryptString('encrypt', $message);
            @$sendername = $_SESSION["clientid"];
            date_default_timezone_set('Asia/Tehran');
            $time = date("h:i:sa");

            $db = DB();
            $query = $db->prepare("INSERT INTO messageprivet(sendername, recivername, message, time) VALUES (:sendername,:recivername,:message,:time)");
            $query->bindParam("sendername", $sendername, PDO::PARAM_STR);
            $query->bindParam("recivername", $recivername, PDO::PARAM_STR);
            $query->bindParam("message", $message, PDO::PARAM_STR);
            $query->bindParam("time", $time, PDO::PARAM_STR);
            $query->execute();
        }
    }



    // for set online id after login and update data user table

    public function SetOnlineId($id, $name, $ip)
    {
        try {
            $db = DB();
            $app = new USERS();
            $b = "UPDATE `users` SET `onlineid` = :onlineid , `ip` = :ip WHERE `name` = :name";
            $query = $db->prepare($b);
            $query->bindParam(":onlineid", $id);
            $query->bindParam(":name", $name);
            $query->bindParam(":ip", $ip);
            $query->execute();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function SetclientId($clientid, $name)
    {
        try {
            $db = DB();
            $app = new USERS();
            //$name = $app->EncryptString('encrypt', $name);
            $b = "UPDATE `online` SET `clientid` = :clientid WHERE `name` = :name";
            $query = $db->prepare($b);
            $query->bindParam(":clientid", $clientid);
            $query->bindParam(":name", $name);
            $result = $query->execute();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    // Insert name into the Online list
    public function InsertUserToOnlineList($name, $onlineid, $clientid, $time, $ip)
    {
        $db = DB();
        $app = new USERS();
        $name = $app->EncryptString('encrypt', $name);
        $query = $db->prepare("INSERT INTO online(name, onlineid, clientid, time, ip) VALUES (:name,:onlineid,:clientid,:time,:ip)");
        $query->bindParam("name", $name, PDO::PARAM_STR);
        $query->bindParam("onlineid", $onlineid, PDO::PARAM_STR);
        $query->bindParam("clientid", $clientid, PDO::PARAM_STR);
        $query->bindParam("time", $time, PDO::PARAM_STR);
        $query->bindParam("ip", $ip, PDO::PARAM_STR);
        $query->execute();
    }
    // Delet user after logut from onlinelist
    public function DeletUserFromOnlineList($onlineid)
    {

        $db = DB();
        $query = $db->prepare("DELETE FROM online WHERE onlineid=:onlineid");
        $query->bindParam("onlineid", $onlineid, PDO::PARAM_STR);
        $query->execute();
    }
    // for set online id after login and update data user table

    public function UpdateTimeUser($time, $name, $clientid, $onlineid, $ip)
    {
        try {

            $app = new USERS();
            $app->CheckUserNotHaveDublicate($clientid, $onlineid);
            $name2 = $app->EncryptString('decrypt', $name);
            $app->CheckBanUser($name2);
            $app-> DeletBanUser();

            // check user is ban or not if ban go out
            if($_SESSION['ban'] == 'yes'){
                ?>
                <script>
                    document.getElementById('exitt').click();
                </script>
                <?php
            }

            $db = DB();
            $b = "UPDATE `online` SET `time` = :time , `ip` = :ip WHERE `name` = :name";
            $query = $db->prepare($b);
            $query->bindParam(":time", $time);
            $query->bindParam(":name", $name);
            $query->bindParam(":ip", $ip);
            $query->execute();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    // Check if user close the brwoser tab delet from online list
    public function CheckUserTime($time)
    {
        $converttostring = strval($time);
        $db = DB();
        $query = $db->prepare("DELETE FROM online WHERE time <:time");
        $query->bindParam("time", $converttostring);
        $query->execute();
        //Check user online or not
        $app = new USERS();
        $app-> CheckUserOnlineOrNot();
        //
    }
    public function DeletBanUser()
    {
        $db = DB();
        $time = date("Y/d/m");
        $query = $db->prepare("DELETE FROM ban WHERE time !=:time");
        $query->bindParam("time", $time);
        $query->execute();
    }

    public function ShowPublicChat()
    {
        $db = DB();
        $query = $db->query("SELECT * FROM message ORDER BY id DESC LIMIT 20");

        echo '
        <script>
            $("#navlink").text("چت عمومی");
        </script>
        ';

        foreach ($query as $row) {
            $app = new USERS();
            $message = $app->EncryptString('decrypt', $row['message']);
            $showname = $app->EncryptString('decrypt', $row['name']);
            $user = $app->GetIdByName($row['name']);
            ?>
            <div id=categorie5.1-<?php echo $row['id']; ?>>
                <div class="chatt" style="overflow-auto">
                    <div class="chatt-avatar">
                        <a class="avatarr avatar-online" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="Edward Fletcher">
                            <img src="theme/img/avatar/avatar6.png" alt="...">
                            <i></i>
                        </a>
                    </div>
                    <div class="chatt-body">
                        <div class="chatt-content">
                            <p><?php
                                ?> <a style="color: black;" onclick=GetUserchat(<?php echo $user->id ?>) href=#><?php echo $showname; ?> </a> <?php
                                echo '<br>';
                                echo $message;
                                ?>
                            </p>
                            <time class="chat-time" datetime="<?php echo $row['time']; ?>"><?php echo $row['time']; ?></time>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    }
    public function ShowPrivetChat()
    {

        // Set cooki to now wich id client clicked
        if (isset($_COOKIE['idprivetchat'])) {
            $app = new USERS();
            $cooki = $_COOKIE['idprivetchat'];
            $cooki = $app->SafeString($cooki);
            $_SESSION['idprivetchat'] = $cooki;
            setcookie("idprivetchat", "", time() - 3600);
        }
        //
        // show message sender send
        @$clientid = $_SESSION["clientid"];
        @$privetid = $_SESSION['idprivetchat'];
        $app = new USERS();
        $name = $app->GetUserNameFromId($privetid);
        $nameshow = $app->EncryptString('decrypt', $name->name);
        $nameshowsession = $app->EncryptString('decrypt', $_SESSION['name']);
        ?>
        <script>
            $("#navlink").text("<?php  if ($nameshowsession == $nameshow){echo 'Saved Message';
            }else{
                echo $nameshow ;
            }?>");
        </script>
        <?php
        $db = DB();
        $app = new USERS();
        $app->CheckPrivetrSection($clientid, $privetid);
        $query = $db->prepare("SELECT * FROM messageprivet WHERE (sendername=:clientid) AND (recivername=:privetid)");
        $query->bindParam(":clientid", $clientid, PDO::PARAM_STR);
        $query->bindParam(":privetid", $privetid, PDO::PARAM_STR);
        $query->execute();


        //https://www.bootdey.com/snippets/view/Green-chat-room#js
        // https://www.bootdey.com/snippets/view/Clean-chat-box

        $result = $query->fetchAll();
        foreach ($result as $row) {
            $message = $app->EncryptString('decrypt', $row['message']);

            ?>
            <div id=categorie5.1-<?php echo $row['id']; ?>>
                <div class="chatt">
                    <div class="chatt-avatar">
                        <a class="avatarr avatar-online" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                            <img src="theme/img/avatar/avatar6.png" alt="...">
                            <i></i>
                        </a>
                    </div>
                    <div class="chatt-body">
                        <div class="chatt-content">
                            <p><?php
                                echo $message;
                                ?>
                            </p>
                            <time class="chat-time" datetime="<?php echo $row['time']; ?>"><?php echo $row['time']; ?></time>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }

        // final
        // show message reciver send

        @$clientid = $_SESSION["clientid"];
        @$privetid = $_SESSION['idprivetchat'];

        $converttostring = strval($clientid);
        $converttostring2 = strval($privetid);
        $db = DB();

        $query = $db->prepare("SELECT * FROM messageprivet WHERE (recivername=:clientid) AND (sendername=:privetid)");
        $query->bindParam(":clientid", $converttostring, PDO::PARAM_STR);
        $query->bindParam(":privetid", $converttostring2, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetchAll();
        foreach ($result as $row) {
            // this if for saved message
            if ($clientid == $row['sendername'] and $clientid == $row['recivername']) {
            } else {
                $message = $app->EncryptString('decrypt', $row['message']);
                ?>
                <div id=categorie5.1-<?php echo $row['id']; ?>>
                    <div class="chatt chatt-left">
                        <div class="chatt-avatar">
                            <a class="avatarr avatar-online" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                <img class="rounded" src="theme/img/avatar/avatar6.png" alt="...">
                                <i></i>
                            </a>
                        </div>
                        <div class="chatt-body">
                            <div class="chatt-content">
                                <p><?php
                                    echo $message;
                                    ?>
                                </p>
                                <time class="chat-time" datetime="<?php echo $row['time']; ?>"><?php echo $row['time']; ?></time>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

            }
        }


        // final

    }

    public function ShowPrivetChatList()
    {

        echo '
    <div class=chat-user>
    <div class=chat-user-name>
      <a><center>لیست چت</center></a>

      </div>
    </div>';
        if (@$_SESSION['showprivetchat'] == 'showprivet') {



            echo '
      <div class=chat-user>
      <div class=chat-user-name>
        <a onclick=GetPublicChat() href=#><center>نمایش صفحه چت عمومی</center></a>

        </div>
      </div>';
        }
        // For show Creator
        @$clientid = $_SESSION["clientid"];
        $converttostring = strval($clientid);
        $db = DB();
        $query = $db->prepare("SELECT * FROM messagepriversection WHERE (creator=:clientid)");
        $query->bindParam(":clientid", $converttostring, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetchAll();
        if ($query->rowCount() == 0) {
            if (@$_SESSION['rowcountprivetchatlist'] == '1') {
            } else {
                echo '<br>';
                echo 'روی نام کاربران کلیک کنید تا صفحه چت برای شما ساخته شود';
            }
        }
        foreach ($result as $row) {

            $name = $row['reciver'];
            $app = new USERS();
            $user = $app->GetUserNameFromId($name);
            $showname = $app->EncryptString('decrypt', $user->name);
            echo '
            <div class="className">
            <div class=chat-user>
            <img class=chat-avatar rounded src=/theme/img/avatar/avatar2.png>
            <div class=chat-user-name>
            <a onclick=GetUserchat(' . $row['reciver'] . ') href=#>' . $showname . '</a><br>';

            $app->ShowLastPrivetMessagesender($name, $clientid);
            echo ' || ';
            $app->ShowLastPrivetMessagereciver($name, $clientid);

            echo '
              
            </div></div></div>';
        }
        // For show Reciver
        $converttostring = strval($clientid);
        $db = DB();
        $query = $db->prepare("SELECT * FROM messagepriversection WHERE (reciver=:clientid)");
        $query->bindParam(":clientid", $converttostring, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetchAll();

        if ($query->rowCount() > 0) {
            @$_SESSION['rowcountprivetchatlist'] = 1;
        }
        foreach ($result as $row) {
            // this if for delet duplicate your self id in privetchat list
            if ($clientid == $row['creator'] and $clientid == $row['reciver']) {
            } else {
                $name = $row['creator'];
                $app = new USERS();
                $user = $app->GetUserNameFromId($name);
                $showname = $app->EncryptString('decrypt', $user->name);
                echo '
            <div class="className">
            <div class=chat-user>
           <img class=chat-avatar rounded src=/theme/img/avatar/avatar2.png>
           <div class=chat-user-name>
             <a onclick=GetUserchat(' . $row['creator'] . ') href=#>' . $showname . '</a><br>';

                $app->ShowLastPrivetMessagesender($name, $clientid);
                echo ' || ';
                $app->ShowLastPrivetMessagereciver($name, $clientid);

                echo '
               
             </div></div></div>';
            }
        }
    }

    public function ShowOnlineList()
    {

        $db = DB();
        $query = $db->query("SELECT * FROM online ORDER BY id");
        echo '
              <div class=chat-user>
              <div class=chat-user-name>
                <a><center>لیست آنلاین</center></a>
  
                </div>
              </div>';

        foreach ($query as $row) {
            $app = new USERS();
            $showname = $app->EncryptString('decrypt', $row['name']);
            $user = $app->GetIdByName($row['name']);
            echo '<div class=chat-user>';
            echo '<img class=chat-avatar rounded src=/theme/img/avatar/avatar2.png>';
            echo '<div class=chat-user-name>';
            if ($app->Checkvotingisprogress() == '2') {

                echo ' <a onclick=UserKickRequset(' . $user->id . ') href=#><img src=/theme/img/kick.png></a>';
                // line bellow is important
                $_SESSION['uservoted'] = 'no';
                setcookie("idkick", "", time() - 3600);
            }
            echo '<a onclick=GetUserchat(' . $user->id . ') href=#>' . $showname . '</a> 
             </div>
           </div>';
            $ip = $app->getRealIpAddr();
            $app->CheckTimeKickRequest();
            $app->UpdateTimeUser($_SESSION['time'], @$_SESSION['name'], @$_SESSION['clientid'], @$_SESSION['onlineid'], $ip);
        }
    }
    static function SafeString($str)
    {
        $str = trim($str);
        $str = str_replace(array('\\', '\'', '"', '<', '>', '[/url]', '[url]', '[img]', '[/img]', '[/URL]', '[URL]', '[IMG]', '[/IMG]', '[url=', ' '), "", $str);
        $str = htmlentities($str,  ENT_QUOTES | ENT_IGNORE, 'UTF-8');
        $str = html_entity_decode($str, ENT_COMPAT | ENT_XHTML, 'utf-8');
        if (preg_match('/\[url\]|\[img\]/i', $str)) {
            return false;
        }
        return ($str);
    }
    static function SafeNumber($num)
    {
        preg_match_all('!\d+!', $num, $matches);
        return (isset($matches[0][0]) ? $matches[0][0] : '');
    }
    public function CheckPrivetrSection($clientid, $reciver)
    {
        try {
            $db = DB();
            @$creator = $clientid;
            @$reciver = $reciver;

            $query = $db->prepare("SELECT * FROM messagepriversection WHERE creator=:clientid AND reciver=:reciver");
            $query->bindParam("clientid", $clientid, PDO::PARAM_INT);
            $query->bindParam("reciver", $reciver, PDO::PARAM_INT);
            $query->execute();
            if ($query->rowCount() > 0) {

                // here we have two for in for

            } else {
                $query = $db->prepare("SELECT * FROM messagepriversection WHERE creator=:reciver AND reciver=:clientid");
                $query->bindParam("clientid", $clientid, PDO::PARAM_INT);
                $query->bindParam("reciver", $reciver, PDO::PARAM_INT);
                $query->execute();
                if ($query->rowCount() > 0) {
                    echo 'its exisit';
                } else {
                    $app = new USERS();
                    $app->InsertMessageSection($reciver, $creator);
                }
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function InsertMessageSection($reciver, $creator)
    {

        $db = DB();
        $query1 = $db->prepare("INSERT INTO messagepriversection(creator, reciver) VALUES (:creator,:reciver)");
        $query1->bindParam("creator", $creator, PDO::PARAM_STR);
        $query1->bindParam("reciver", $reciver, PDO::PARAM_STR);
        $query1->execute();
    }
    public function ShowLastPrivetMessagesender($reciver, $clientid)
    {
        $db = DB();
        $query = $db->prepare("SELECT * FROM messageprivet WHERE sendername=:clientid AND recivername=:reciver ORDER BY id DESC LIMIT 1");
        $query->bindParam("clientid", $clientid, PDO::PARAM_INT);
        $query->bindParam("reciver", $reciver, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll();

        foreach ($result as $row) {
            $app = new USERS();
            $message = $app->EncryptString('decrypt', $row['message']);
            echo '<small>' . $message . '</small>';
        }
    }
    public function ShowLastPrivetMessagereciver($reciver, $clientid)
    {
        $db = DB();
        $query = $db->prepare("SELECT * FROM messageprivet WHERE sendername=:reciver AND recivername=:clientid ORDER BY id DESC LIMIT 1");
        $query->bindParam("clientid", $clientid, PDO::PARAM_INT);
        $query->bindParam("reciver", $reciver, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll();

        foreach ($result as $row) {
            $app = new USERS();
            $message = $app->EncryptString('decrypt', $row['message']);
            echo '<small>' . $message . '</small>';
        }
    }
    public function CheckUserNotHaveDublicate($clientid, $onlineid)
    {

        try {
            $db = DB();
            $query = $db->prepare("SELECT * FROM online WHERE clientid=:clientid");
            $query->bindParam(":clientid", $clientid, PDO::PARAM_INT);
            $query->execute();
            if ($query->rowCount()  > 1) {

                $app = new USERS();
                $app->DeletUserFromOnlineList($onlineid);

                // update onlineid at online tabel

                @$user = $app->GetUserNameFromId($clientid);
                @$id = $user->onlineid;

                $db = DB();
                $b = "UPDATE `online` SET `onlineid` = :onlineid WHERE `clientid` = :clientid";
                $query = $db->prepare($b);
                $query->bindParam(":onlineid", $id);
                $query->bindParam(":clientid", $clientid);
                $result = $query->execute();
            } else {
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else
            $ip = $_SERVER['REMOTE_ADDR'];

        return $ip;
    }

    //kick user request page and progress

    public function ShowKickRequest()
    {
        @$cooki = @$_COOKIE['idkick'];
        @$_SESSION['kickid'] = $cooki;
        $app = new USERS();
        @$user = $app->GetUserNameFromId($_SESSION['kickid']);
        echo '<br><br><center><normal>شما در حال رای گیری برای اخراج </normal><br>';
        $showname = $app->EncryptString('decrypt', $user->name);
        echo $showname;
        echo '<center><normal>هستید</normal><br>';
        echo '</center>';
        echo '</br></br>';
        echo '<button type="button" onclick="RequestVote()" class="btn btn-success">ایجاد رای گیری</button>';
        echo '</br></br>';
        echo '<button type="button" onclick="ExitFromRequestKick()" class="btn btn-danger">انصراف</button>';


        //setcookie("idprivetchat", "", time() - 3600);
    }
    public function RequestKick()
    {
        try {
            $requestkick = $_SESSION['clientid'];
            $kicked = $_SESSION['kickid'];
            $time = $_SESSION['time'] + '1';

            $db = DB();
            $query = $db->prepare("INSERT INTO kickrequest(requestkick, kicked, timestop) VALUES (:requestkick,:kicked,:timestop)");
            $query->bindParam("requestkick", $requestkick, PDO::PARAM_STR);
            $query->bindParam("kicked", $kicked, PDO::PARAM_STR);
            $query->bindParam("timestop", $time, PDO::PARAM_STR);
            $query->execute();
            $_SESSION['showvoting'] = "show";
            $_SESSION['showkickrequset'] = "no";
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function CheckKickRequsetExist()
    {
        $db = DB();
        $query = $db->prepare("SELECT * FROM kickrequest");
        $query->execute();
        if ($query->rowCount() == 1) {
            if (@$_SESSION['uservoted'] == "yes") {
                $_SESSION['showvoting'] = "no";
            } else {
                $_SESSION['showvoting'] = "show";

                $result = $query->fetchAll();
                foreach ($result as $row) {

                    $_SESSION['namekicked'] = $row['kicked'];

                }

            }
        } else {
            $_SESSION['showvoting'] = "no";
        }
    }
    public function ShowVotingPage($kickid)
    {
        $app = new USERS();
        $user = $app->GetUserNameFromId($_SESSION['namekicked']);
        $name = $user->name;
        echo '<br><br><center><normal>کاربران در حال رای گیری برای اخراج</normal><br>';
        $showname = $app->EncryptString('decrypt', $name);
        echo $showname;
        echo '<center><normal>هستند</normal><br>';
        echo '<br><br><center><normal>لطفا رای خود را ثبت کنید</normal><br>';
        echo '</center>';
        echo '</br></br>';
        echo '<button type="button" onclick="voteyeskick()" class="btn btn-success">اخراج بشه</button>';
        echo '</br></br>';
        echo '<button type="button" onclick="votenokick()" class="btn btn-danger">نه بزارید باشه</button>';
        $app = new USERS();
        $app->CheckTimeKickRequest();
    }

    // voting yes

    public function voteyeskick()
    {
        $app = new USERS();
        $user = $app->GetLastVote();
        $lastvoteyes = $user->voteyes + 1;
        $app->UpdateVoteYes($lastvoteyes);

        $app->CheckTimeKickRequest();
        // $_SESSION['showvoting'] = 'no';
        // $_SESSION['showkickrequset'] = 'showonlinelist';
        $_SESSION['uservoted'] = 'yes';
    }
    // voting no

    public function votenokick()
    {
        $app = new USERS();
        $user = $app->GetLastVote();
        $lastvoteno = $user->voteno + 1;
        $app->UpdateVoteNo($lastvoteno);

        $app->CheckTimeKickRequest();
        //$_SESSION['showvoting'] = 'no';
        //$_SESSION['showkickrequset'] = 'showonlinelist';
        $_SESSION['uservoted'] = 'yes';
    }
    public function GetLastVote()
    {
        try {
            $db = DB();
            $query = $db->prepare("SELECT * FROM kickrequest");
            $query->execute();
            if ($query->rowCount() > 0) {
                return $query->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function UpdateVoteYes($voteyes)
    {
        $db = DB();
        $b = "UPDATE `kickrequest` SET `voteyes` = :voteyes";
        $query = $db->prepare($b);
        $query->bindParam(":voteyes", $voteyes);
        $query->execute();
    }
    public function UpdateVoteNo($voteno)
    {
        $db = DB();
        $b = "UPDATE `kickrequest` SET `voteno` = :voteno";
        $query = $db->prepare($b);
        $query->bindParam(":voteno", $voteno);
        $query->execute();
    }
    // check time kick

    public function CheckTimeKickRequest()
    {
        $db = DB();
        $query = $db->prepare("SELECT * FROM kickrequest");
        $query->execute();
        $result = $query->fetchAll();
        $app = new USERS();
        $app->UpdateTimeKickReq();
        foreach ($result as $row) {

            if ($row['timestart'] > $row['timestop']) {
                // procces voting number
                $app->votingPercent();
                // finish procces
                $query = $db->prepare("DELETE FROM kickrequest");
                $query->execute();
                $_SESSION['uservoted'] = 'no';
                setcookie("idkick", "", time() - 3600);
            }
        }
    }
    // kick percent voting
    public function votingPercent()
    {
        $db = DB();
        $query = $db->prepare("SELECT * FROM kickrequest");
        $query->execute();
        $result = $query->fetchAll();

        foreach ($result as $row) {

            $yes = $row['voteyes'];
            $no = $row['voteno'];
            $sumvote = $yes + $no;
            //
            $yespercent = ($yes * 100) / $sumvote;
            $nopercent = ($no * 100) / $sumvote;
            //
            $yespercent = round($yespercent);
            $nopercent = round($nopercent);

            // if

            if ($yespercent >= 60 and $sumvote >= 2) {
                // he should be kick

                $app = new USERS();
                $user = $app->GetNameWhoKiked();
                $kickid = $user->kicked;

                $user1 = $app-> GetUserNameFromId($kickid);
                $ip = $user1->ip;
                $date =date("Y/d/m");
                $db = DB();
                $query = $db->prepare("INSERT INTO ban (clientid,ip,time) VALUES (:clientid,:ip,:time)");
                $query->bindParam("clientid", $kickid, PDO::PARAM_STR);
                $query->bindParam("ip", $ip, PDO::PARAM_STR);
                $query->bindParam("time", $date, PDO::PARAM_STR);
                $query->execute();
                setcookie('ban', 'yes', time() + (86400 * 30), "/"); // 86400 = 1 day
            }
        }
    }
    // update time start voting and after 1 min kick req will be remove

    public function UpdateTimeKickReq()
    {
        $db = DB();
        $timestart = $_SESSION['time'];
        $timestop = $_SESSION['time'] + '1';
        $b = "UPDATE `kickrequest` SET `timestart` = :timestart";
        $query = $db->prepare($b);
        $query->bindParam(":timestart", $timestart);
        $query->execute();
    }
    public function GetNameWhoKiked()
    {
        try {
            $db = DB();
            $query = $db->prepare("SELECT * FROM kickrequest");
            $query->execute();
            if ($query->rowCount() > 0) {
                return $query->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function Checkvotingisprogress()
    {
        try {
            $db = DB();
            $query = $db->prepare("SELECT * FROM kickrequest");
            $query->execute();
            if ($query->rowCount() > 0) {
                return '1';
            } else {
                return '2';
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    function EncryptString($action, $string)
    {
        // script encrypt come from https://www.webslesson.info/2017/12/encryption-and-decryption-form-data-in-php.html
        $output = '';
        $encrypt_method = "AES-256-CBC";
        $secret_key = '7a3kjrtwhEJVLfbTKoQIx5o=';
        $secret_iv = 'ghsia2lnHwriw0N0';
        // hash
        $key = hash('sha256', $secret_key);
        $initialization_vector = substr(hash('sha256', $secret_iv), 0, 16);
        if ($string != '') {
            if ($action == 'encrypt') {
                $output = openssl_encrypt($string, $encrypt_method, $key, 0, $initialization_vector);
                $output = base64_encode($output);
            }
            if ($action == 'decrypt') {
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $initialization_vector);
            }
        }
        return $output;
    }
    public function CheckUserOnlineOrNot (){

        try {
            $db = DB();
            $clientid = $_SESSION['clientid'];
            $app = new USERS();

            $query = $db->prepare("SELECT * FROM online WHERE clientid=:clientid");
            $query->bindParam("clientid", $clientid, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                //nothing
            } else {
                ?>
                <script>
                    document.getElementById('exitt').click();
                </script>
                <?php
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
}