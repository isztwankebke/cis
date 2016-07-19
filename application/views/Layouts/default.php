
 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Customer Information System</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../application/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../application/css/dashboard.css" rel="stylesheet">
    <link href="../../application/css/mystyle.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../application/js/ie-emulation-modes-warning.js"></script>
    <script src="../../application/js/obliczanie-daty-konca.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  
 	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Customer Information System</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Raport dzienny</a></li>
            
            <li><a href="#">Wyloguj</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="<?php echo $scriptName == "index" ? 'active' : ''; ?>"><a href="index.php">Dzisiejsze alerty<span class="sr-only">(current)</span></a></li>
            <li class="<?php echo $scriptName == "dodajKlienta" ? 'active' : ''; ?>"><a href="view/dodajKlienta.php">Dodaj Klienta<span class="sr-only">(current)</span></a></li>
            <li class="<?php echo $scriptName == "szukajKlienta" ? 'active' : ''; ?>"><a href="szukajKlienta.php">Szukaj Klienta<span class="sr-only">(current)</span></a></li>
            <li class="<?php echo $scriptName == "edytujKlienta" ? 'active' : ''; ?>"><a href="../view/edytujKlienta.php">Edytuj Klienta<span class="sr-only">(current)</span></a></li>
            <li class="<?php echo $scriptName == "raporty" ? 'active' : ''; ?>"><a href="../view/raporty.php">Raporty<span class="sr-only">(current)</span></a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="../view/admin.php">Administrator</a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Wyloguj</a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
          </ul>
        </div>
        
      </div>
    </div>
    
    <div class="content">
    	<?php echo $contentForLayout; ?>
    
    </div>
    
    
    
    

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../application/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../../application/js/bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../application/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../application/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

