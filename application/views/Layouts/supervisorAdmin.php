<?php
$scriptName = $_SERVER['REQUEST_URI'];
//$scriptName = basename($_SERVER['REQUEST_URI']);
//echo $scriptName;
?>

 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
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
    <link href="/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="/css/mystyle.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>
    <script src="/js/obliczanie-daty-konca.js"></script>

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
          <a class="navbar-brand" href="/Users/index">Customer Information System - ADMIN MODE</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="navbar-brand">
            	<div>
            		<a href="/Users/supervisor_ammountCredit">
            			<span class="glyphicon glyphicon-user" aria-hidden="false">
            			</span>
            		</a>
            	</div>
            </li>
            <li>
            	<div class="btn-group" role="group">
            		<a class="navbar-brand" href="/Users/logout">Wyloguj</a>
            	</div>
            </li>
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
            <li class="<?php echo $scriptName == "/Dashboards/index" ? 'active' : ''; ?>"><a href="/Dashboards/index">Dzisiejsze alerty<span class="sr-only">(current)</span></a></li>
            <li class="<?php echo $scriptName == "/Dashboards/todayEntry" ? 'active' : ''; ?>"><a href="/Dashboards/todayEntry">Dzisiejsze wpisy<span class="sr-only">(current)</span></a></li>
            <li class="<?php echo $scriptName == "/Transactions/addTransaction" ? 'active' : ''; ?>"><a href="/Transactions/addTransaction">Dodaj Klienta<span class="sr-only">(current)</span></a></li>
            <li class="<?php echo $scriptName == '/Transactions/index' || $scriptName == '/Transactions/search' ? 'active' : ''; ?>"><a href="/transactions/index">Szukaj Klienta<span class="sr-only">(current)</span></a></li>
            <li class="<?php echo $scriptName == "/Reports/index" ? 'active' : ''; ?>"><a href="/Reports/index">Raporty<span class="sr-only">(current)</span></a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="<?php echo $scriptName == "/Users/admin_index" ? 'active' : ''; ?>"><a href="/Users/admin_index">Administrator<span class="sr-only">(current)</span></a></li>
            <li class="<?php echo $scriptName == "/Users/admin_read" ? 'active' : ''; ?>"><a href="/Users/admin_read">Zarzadząnie użytkownikami<span class="sr-only">(current)</span></a></li>
            <li class="<?php echo $scriptName == "/Products/admin_read" ? 'active' : ''; ?>"><a href="/Products/admin_read">Zarządzanie produktami<span class="sr-only">(current)</span></a></li>
            <li class="<?php echo $scriptName == "/Clients/admin_read" ? 'active' : ''; ?>" ><a href="/Clients/admin_read">Zarządzanie Klientami<span class="sr-only">(current)</span></a></li>
            <li class="<?php echo $scriptName == "/Dashboards/admin_read" ? 'active' : ''; ?>" ><a href="/Dashboards/admin_read">Zarządzanie Alertami<span class="sr-only">(current)</span></a></li>
            <li class="<?php echo $scriptName == "/Transactions/admin_search" ? 'active' : ''; ?>" ><a href="/Transactions/admin_search">Zarządzanie Transakcjami<span class="sr-only">(current)</span></a></li>
            </ul>
          <ul class="nav nav-sidebar">
            <li><a href="/Users/logout">Wyloguj</a></li>
            
          </ul>
          
        </div>
        
      </div>
    </div>
    
    <div class="content">
    
    	<?php include $this->contentForLayout; ?>
    
    </div>
    
    
    
    

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/js/vendor/jquery.min.js"><\/script>')</script>
<script src="/js/bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

