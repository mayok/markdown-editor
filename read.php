<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Note there is no responsive meta tag here -->

    <link rel="shortcut icon" href="./assets/ico/favicon.png">

    <title>markdown Editor</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.css" rel="stylesheet">
    <link href="./css/bootstrap-markdown.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/non-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="./assets/js/html5shiv.js"></script>
      <script src="./assets/js/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./">markdown editor</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="./">Home</a></li>
            <li><a href="./rlist.php">Read</a></li>
            <li><a href="./wlist.php">Write</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

<?php
require_once(dirname(__FILE__) . "/configration.php");
require_once(dirname(__FILE__) . "/lib/Michelf/Markdown.inc.php");
// editor find
$title = $_GET['title'];

$con = mysql_connect($db_url, $db_user, $db_pass);
$result = mysql_select_db($db_use, $con);
$result = mysql_query('SET NAMES utf8', $con);
$result = mysql_query("SELECT * FROM posts WHERE title='".$title."'and user='".$_SERVER['REMOTE_USER']."'", $con);
$rows = mysql_num_rows($result);
?>

<div class="container">
<h1> READ MODE: <?php echo "$title"; ?> </h1>

<hr>

<p>
<?php

if($rows){
    while($row = mysql_fetch_array($result)) {
        $value = $row['editor'];
    }
}

//markdown trans
echo \Michelf\Markdown::defaultTransform($value);

$con = mysql_close($con);
?>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>

    <script>
    $('#myCarousel').carousel({
    interval: 3000;
    });
    </script>
  </body>
</html>
