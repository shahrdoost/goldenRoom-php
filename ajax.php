<?php
include 'model/db.php';
include 'model/class.php';
session_start();
if (empty($_SESSION['onlineid'])) {
  header('refresh: 0; url=/');
}
// Time Check who user in chat or not
//$_SESSION['time'] = date("h:i");
$_SESSION['time'] = date("i");
$app = new USERS();
$ip = $app->getRealIpAddr();
$app->UpdateTimeUser($_SESSION['time'], @$_SESSION['name'], @$_SESSION['clientid'], @$_SESSION['onlineid'], $ip);

// return name who not update the time- should be remover form onilne list

if (date("s") == '06' or date("s") == '07' or date("s") == '08') {
  $user = $app->CheckUserTime($_SESSION['time']);
}

?>
<script>
  function GetUserchatid(id) {

    var time = new Date();
    time.setTime(time.getTime() + (1000 * 24 * 60 * 60));
    time.toUTCString();
    document.cookie = "idprivetchat=" + id + ";expires=" + time + ";path=/";
  }

  function GetUserKickid(id) {

    var time = new Date();
    time.setTime(time.getTime() + (1000 * 24 * 60 * 60));
    time.toUTCString();
    document.cookie = "idkick=" + id + ";expires=" + time + ";path=/";
  }

  var toSort = document.getElementById('content').children;
  toSort = Array.prototype.slice.call(toSort, 0);

  toSort.sort(function(a, b) {
    var aord = +a.id.split('-')[1];
    var bord = +b.id.split('-')[1];
    // two elements never have the same ID hence this is sufficient:
    return (aord > bord) ? 1 : -1;
  });

  var parent = document.getElementById('content');
  parent.innerHTML = "";

  for (var i = 0, l = toSort.length; i < l; i++) {
    parent.appendChild(toSort[i]);
  }
</script>
<?PHP
//check input with safe string function
@$action = $_POST['action'];
$action = $app->SafeString($action);

if (!@$action) {
} else {

  // https://www.bootdey.com/snippets/view/card-chat-list#css template message url

  switch ($action) {
    case 'voteyeskick':
      $app->voteyeskick();
      break;
    case 'votenokick':
      $app->votenokick();
      break;
    case 'requestvote':
      $app->RequestKick();
      break;
    case 'showkickrequset':
      if ($app->Checkvotingisprogress() == '1') {
        echo 'یک رای گیری در جریان است';
      }  if ($app->Checkvotingisprogress() == '2') {

        @$_SESSION['showkickrequset'] = 'show';
      }
      break;
    case 'showonlinelist':
      @$_SESSION['showkickrequset'] = 'showonlinelist';
      break;
    case 'showprivetchat':
      @$_SESSION['showprivetchat'] = 'showprivet';

      break;
    case 'showpublicchat':
      @$_SESSION['showprivetchat'] = 'showpublic';
      break;
    case 'show':
      if (@$_SESSION['showprivetchat'] == 'showpublic') {
        $app->ShowPublicChat();
        $app->SetclientId($_SESSION['clientid'], $_SESSION['name']);
      }
      if (@$_SESSION['showprivetchat'] == 'showprivet') {

        $app->ShowPrivetChat();
      }
      break;
    case 'privetchatlist':
      $app->ShowPrivetChatList();
      break;
    case 'onlinelist':
      //if (@$_SESSION['uservoted'] == 'yes') {
      //} else {
        $app->CheckKickRequsetExist();
     // }
      if (@$_SESSION['showkickrequset'] == 'show') {
        $app->ShowKickRequest();
      } else {
        
        if ($_SESSION['showvoting'] == "show") {
          $app->ShowVotingPage(@$_SESSION['kickid']);
        } else {
          $app->ShowOnlineList();
        }
      }
      break;
    case 'insert':

      $app = new USERS();
      $message = $_POST['message'];
      $message = $app->SafeString($message); // delet html code

      if ($message == "") {
        exit;
      }
      if ($_SESSION['showprivetchat'] == 'showprivet') {
        //SEND MESSAGE TO PRIVETCHAT
        $app->SendMessageToPrivet($message, @$_SESSION['idprivetchat']);
      } else {
        $app->SendMessageToPublic($message, @$_SESSION['name']);
      }
  }
}
?>