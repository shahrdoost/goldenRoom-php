<?php
if (empty($_SESSION['onlineid'])) {
  header("Location: /");
} else {
  include 'view/header.php';
  $app = new USERS();
  $user = $app->GetUserid($_SESSION['onlineid']);
  $_SESSION['clientid'] = $user->id;
  $_SESSION['showprivetchat'] = 'showpublic';

 // echo $app->EncryptString('encrypt', 123);
  //echo '<br>';
 // echo $app->EncryptString('decrypt', 'WSthTmxsU0MxT1V=');
?>
<script>

</script>
  <!-- header end-->
  <nav class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark main-nav">
    <div class="container">
      <div class="navbar-collapse collapse nav-content order-2">
        <ul class="nav navbar-nav">
          <li class="nav-item active">
            <button class="btn" style="color: #f8f9fa;" id="exitt" onclick="Exit()">خروج</button>
          </li>
          <!--  <li class="nav-item">
            <a class="nav-link" href="#">Download</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Register</a>
          </li>
          -->
        </ul>
      </div>
      <ul class="nav navbar-nav text-nowrap flex-row mx-md-auto order-1 order-md-2">
        <li class="nav-item"><a style="text-align: right;" class="nav-link" href="#" id="navlink">چت روم</a></li>
        <button class="navbar-toggler ml-2" type="button" data-toggle="collapse" data-target=".nav-content" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </ul>
      <div class="ml-auto navbar-collapse collapse nav-content order-3 order-md-3">
        <ul class="ml-auto nav navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#" onclick=GetUserchat(32)>تماس با ما</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Online List-->

  <div class="container">
    <div class="row justify-content-md-center" style="margin-top: 1rem; text-align: right;">
      <div class="col-sm overflow-auto" style="background-color:#e6e6fa26;" id="onlinelistj">

        <div class="users-list" id="onlinelist"></div>
      </div>

      <!-- Public Chat-->

      <div class="col-sm overflow-auto " style="background-color:hsla(240, 66.7%, 94.1%, 0.75);" id="publicchat">
        <div id="loading"></div>
        <div class="panel-body">

          <div class="chats" id="content"></div>

        </div>

        <!-- Input Send Message-->
        <form action="" class="fixed" method="post" name="action" id="form">
          <div class="input-group fixed-bottom mx-auto" style="padding-bottom: 2 rem;max-width:800px;">
            <input id="message" type="text" class="form-control" autocomplete="off" maxlength="15" maxlength="255" aria-label="" aria-describedby="basic-addon1">
            <div class="input-group-prepend">
              <button class="btn btn-secondary" id="submit" style="max-height:35px" type="submit"><i class="fa fa-paper-plane"></i></button>
            </div>
        </form>
        <br><br>
      </div>
    </div>
    <!-- Chat List-->
    <div class="col-sm overflow-auto" style="background-color:#e6e6fa26;" id="privetchatlistt">

      <div class="users-list" id="privetchatlist"></div>

    </div>


  </div>
  </div>
  </div>
  <script src="theme/js/script.js"></script>
  <!-- Footer -->
  </body>

  </html>
<?php
}
?>