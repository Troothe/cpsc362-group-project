<?php

session_start();
include('../PHP/functions.php');
include('../PHP/startup.php');

if(!isset($_SESSION['JournalDate'])) {
    $_SESSION['JournalDate'] = date("Y-m-d");
} else if(isset($_POST['NewJournalDate'])) {
    $_SESSION['JournalDate'] = $_POST['NewJournalDate'];
}


//Check the database to see if an entry exists for our current $_SESSION['JournalDate']
if(!checkJournalEntryExistsByDate($sql_conn, $_SESSION['user']['user_id'], $_SESSION['JournalDate'])) {
    insertJournalEntry($sql_conn, $_SESSION['user']['user_id'], $_SESSION['JournalDate']);
}

pullSingleJournalEntryByDate($sql_conn, $_SESSION['user']['user_id'], $_SESSION['JournalDate']);


?>
<!doctype html>
<html class="no-js" lang="">
    <head>
      <meta charset="utf-8">
      <title>Wellcome</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <link rel="shortcut icon" href="img/icon.png">
        <!-- google font css-->
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

        <!-- bootstraf css-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

      <!-- library and main css-->
      <link rel="stylesheet" href="css/normalize.css">
      <link rel="stylesheet" href="css/main.css">
      <link rel="stylesheet" href="style.css">
    </head>

<body>
<!--=========================your site content here =====================-->
<!--==========Header start==========-->
<section class="header">
  <div class="container">
    <h1>Journal</h1>
  </div>
</section>
<!--==========Section start==========-->
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="time">
            <div class="date" id="printDay"></div>&nbsp;&nbsp;<b>|</b>&nbsp;&nbsp;
            <div class="date" id="printDate"></div>&nbsp;&nbsp;<b>|</b>&nbsp;&nbsp;
            <div class="date" id="printTime"></div>
         </div>
      </div>
      <div class="col-md-3"></div>
    </div>
    
  </div>
</section>



<section class="main">
  <div class="container">
    <div class="row"><!----row 1----->
      <div class="col-md-6">
        <form method="POST" action="#" class="main-form"><!----------Box no 1-------------->
         <div class="image-box">
           <img src="img/1.jpg" width="24%">
           <img src="img/2.jpg" width="24%">
           <img src="img/3.jpg" width="24%">
           <img src="img/4.jpg" width="24%">
         </div>
         <div class="title">
          <center>
          <h5>Morning writing</h5>
          </center>
         </div>

      <fieldset>
      <center>
      <textarea name="message" id="message" placeholder="Write your message here...." rows="10" required></textarea>
      </center>
      </fieldset>


       <center></center>

        </form>
      </div>
      <div class="col-md-6">
        <form class="main-form"><!----------Box no 1-------------->
         <div class="image-box">
           <img src="img/1.jpg" width="24%">
           <img src="img/2.jpg" width="24%">
           <img src="img/3.jpg" width="24%">
           <img src="img/4.jpg" width="24%">
         </div>
         <div class="title">
          <center>
          <h5>Daily affirmation</h5>
          </center>
         </div>

      <fieldset>
      <center>
      <textarea placeholder="Write your message here...." rows="10" required></textarea>
      </center>
      </fieldset>


       <center></center>

        </form>
      </div>
    </div>
    <div class="row"><!----row 2----->
      <div class="col-md-6">
        <form class="main-form"><!----------Box no 1-------------->
         <div class="image-box">
           <img src="img/1.jpg" width="24%">
           <img src="img/2.jpg" width="24%">
           <img src="img/3.jpg" width="24%">
           <img src="img/4.jpg" width="24%">
         </div>
         <div class="title">
          <center>
          <h5>Gratitude</h5>
          </center>
         </div>

      <fieldset>
      <center>
      <textarea placeholder="Write your message here...." rows="10" required></textarea>
      </center>
      </fieldset>


       <center></center>

        </form>
      </div>
      <div class="col-md-6">
        <form class="main-form"><!----------Box no 1-------------->
         <div class="image-box">
           <img src="img/1.jpg" width="24%">
           <img src="img/2.jpg" width="24%">
           <img src="img/3.jpg" width="24%">
           <img src="img/4.jpg" width="24%">
         </div>
         <div class="title">
          <center>
          <h5>Evening writing</h5>
          </center>
         </div>

      <fieldset>
      <center>
      <textarea placeholder="Write your message here...." rows="10" required></textarea>
      </center>
      </fieldset>


       <center></center>

        </form>
      </div>
    </div>
    
  </div>
  
</section>
<section class="header">
</section>
<!--=========================your site content End =====================-->
<!--++++++++ your site Javascript hare ++++++++-->
  <script src="js/jquery.js"></script>
  <script src="js/vendor/modernizr-3.11.2.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>
  <script src="js/update.js"></script>
  <!--font-awesome cdn Jquary-->
  <script src="https://kit.fontawesome.com/6e4214a137.js" crossorigin="anonymous"></script>
  <!-- Bootstraf cdn JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('set', 'anonymizeIp', true); ga('set', 'transport', 'beacon'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async></script>
</body>
</html>
