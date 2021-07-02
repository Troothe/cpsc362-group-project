<?php

session_start();
include('../PHP/functions.php');
include('../PHP/startup.php');

//Create a db entry for the user if there isn't one already, initialize values to 0
insertThought($sql_conn, $_SESSION['user']['user_id']);

//Retrieve the db entry for the user with thought values to be used on the html page
getUserThoughts($sql_conn, $_SESSION['user']['user_id']);


?>
<!doctype html>
<html class="no-js" lang="">
    <head>
      <meta charset="utf-8">
      <title>Thoughts</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <link rel="shortcut icon" href="img/icon.png">
        <!-- google font css-->
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

        <!-- bootstraf css-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

      <script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

      <!-- library and main css-->
      <link rel="stylesheet" href="style.css">
    </head>

<body>
<!--=========================your site content here =====================-->
<!--==========Header start==========-->
<section class="header">
  <div class="container">
    <h1>Thought Tracker</h1>
    <nav class="nav-menu float-right d-none d-lg-block">
      <ul>
        <li ><a href="../home.php"> Home</a></li>
        <li ><a href="../meditate.php"> Medation</a></li>
        <li ><a href="../journal/index.php"> Journal</a></li>
      </ul>
    </nav>
  </div>
</section>
<!--==========Section start==========-->
<section class="main">
  <div class="container">
    <div class="row"><!-------Row no-1------->
      <div class="col-md-3"></div>
      <div class="col-md-4"><h2><img src="img/i1.png" width="50">&nbsp;&nbsp;Anxiety</h2></div>
      <div class="col-md-2">

      <div class="mbl-center">
        <div class="quantity buttons_added">
            <input type="button" value="-" class="minus" onclick="updateThoughts('anxious_thoughts', Number(document.getElementById('anxious-thoughts-count').value) - 1)">
            <input id="anxious-thoughts-count" type="number" step="1" min="0" max="1000" name="quantity" value="<?php echo $_SESSION['user_thoughts']['anxious_thoughts']; ?>" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="" onblur="updateThoughts('anxious_thoughts', Number(document.getElementById('anxious-thoughts-count').value))">
            <input type="button" value="+" class="plus" onclick="updateThoughts('anxious_thoughts', Number(document.getElementById('anxious-thoughts-count').value) + 1)">       </div>
      </div>
        
      </div>
      <div class="col-md-3"></div>
    </div>
    <div class="row"><!-------Row no-1------->
      <div class="col-md-3"></div>
      <div class="col-md-4"><h2><img src="img/i2.png" width="50">&nbsp;&nbsp;Depression</h2></div>
      <div class="col-md-2">
        <div class="mbl-center">
        <div class="quantity buttons_added">
            <input type="button" value="-" class="minus" onclick="updateThoughts('depressed_thoughts', Number(document.getElementById('depressed-thoughts-count').value) - 1)">
            <input id="depressed-thoughts-count" type="number" step="1" min="0" max="1000" name="quantity" value="<?php echo $_SESSION['user_thoughts']['depressed_thoughts']; ?>" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="" onblur="updateThoughts('depressed_thoughts', Number(document.getElementById('depressed-thoughts-count').value))">
            <input type="button" value="+" class="plus" onclick="updateThoughts('depressed_thoughts', Number(document.getElementById('depressed-thoughts-count').value) + 1)"></div></div>
      </div>
      <div class="col-md-3"></div>
    </div>
    <div class="row"><!-------Row no-1------->
      <div class="col-md-3"></div>
      <div class="col-md-4"><h2><img src="img/i3.png" width="50">&nbsp;&nbsp;Cravings addictions</h2></div>
      <div class="col-md-2">
        <div class="mbl-center">
        <div class="quantity buttons_added">
            <input type="button" value="-" class="minus" onclick="updateThoughts('cravings', Number(document.getElementById('cravings-thoughts-count').value) - 1)">
            <input id="cravings-thoughts-count" type="number" step="1" min="0" max="1000" name="quantity" value="<?php echo $_SESSION['user_thoughts']['cravings']; ?>" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="" onblur="updateThoughts('cravings', Number(document.getElementById('cravings-thoughts-count').value))">
            <input type="button" value="+" class="plus" onclick="updateThoughts('cravings', Number(document.getElementById('cravings-thoughts-count').value) + 1)"></div></div>
      </div>
      <div class="col-md-3"></div>
    </div>
  <div class="row"><!--------row-2-------->
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <hr>
      <h2>Daily Total</h2>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <hr>
      <small>On a scale of 0 to 10, the higher the scale, the more severe the impact.Levels 0 are no anxiety, 1-3 are mild, 4-6 are moderate, and 7-10 are severe and panic.The same criteria apply to ratings of depression and addiction.</small>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <small>The definitions of different levels of symptoms can be found in more detail on the following websites: <a href="https://www.therecoveryvillage.com/mental-health/anxiety/related/levels-of-anxiety/">Anxiety</a> ,<a href="https://www.ncbi.nlm.nih.gov/books/NBK82926/">Depression</a>, and <a href="https://www.clearviewtreatment.com/blog/stages-drug-alcohol-addiction/">Addiction</a>.</small>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <hr>
      <small> Severe symptoms of depression and anxiety may cause you to lose hope, but be assured that there are many people in the world who want you to survive.
If you or someone close to you is suicidal because of anxiety or depression, please call the <b>Suicide Prevention Hotline: 1-800-273-8255</b>.
Also, if you are suffering from an addiction, seek treatment as soon as possible. Early treatment means better results!</small>
    </div>
    <div class="col-md-3"></div>
  </div>

  </div>
</section>
<section class="header">
    <h4><b>Although it sometimes only takes one bad day to ruin a person, please believe that there will be more unknown and better tomorrow!</b></h4>
</section>


        <!--=========================your site content End =====================-->
        <!--++++++++ your site Javascript hare ++++++++-->
        <script type="text/javascript">
         function wcqib_refresh_quantity_increments() {
    jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
        var c = jQuery(b);
        c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
    })
}
String.prototype.getDecimals || (String.prototype.getDecimals = function() {
    var a = this,
        b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
    return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
}), jQuery(document).ready(function() {
    wcqib_refresh_quantity_increments()
}), jQuery(document).on("updated_wc_div", function() {
    wcqib_refresh_quantity_increments()
}), jQuery(document).on("click", ".plus, .minus", function() {
    var a = jQuery(this).closest(".quantity").find(".qty"),
        b = parseFloat(a.val()),
        c = parseFloat(a.attr("max")),
        d = parseFloat(a.attr("min")),
        e = a.attr("step");
    b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
});

        </script>
        <!--++++++++ your site Javascript hare ++++++++-->
  <!-- Bootstraf cdn JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="js/thoughts.js"></script>
</body>
<footer>

</footer>
</html>
