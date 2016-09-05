<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  	<h1 class="page-header">Zarządzanie Klientami:</h1>
  	
<?php 
if (debug) {
	var_dump($_REQUEST);
	var_dump($_SERVER);
	var_dump($this->data);
}
if ($this->data):?>
	<div>
	<h3>Pomyślnie dodano dane klienta do bazy</h3>
	</div>
<?php
else :?>
	<div>
	<h3>Wystąpił błąd - skontaktuj się z administratorem</h3>
	</div>
<?php endif;?>
	<div>
		<a class="btn btn-default" href="../Clients/admin_read" role="button">OK</a>
	</div>
	

  	
</div>