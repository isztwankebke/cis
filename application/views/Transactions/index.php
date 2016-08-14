
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Znaleziono klienta:</h1>
	<form action="/transactions/search" method="post">
  <div class="form-group">
    <label for="searchClientData">Podaj PESEL, Nazwisko lub NR Telefonu</label>
    <input type="text" name="clientData" class="form-control" id="searchClientData" placeholder="PESEL, Nazwisko lub nr telefonu">
  </div>
  <button type="submit" class="btn btn-default">Szukaj</button>
</form>
<div>
<?php 
var_dump($_POST);

?></div>
</div>