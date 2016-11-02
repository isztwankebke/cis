<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Zarządzanie Transakcjami:</h1>
	
	<?php if (debug) {
		var_dump($this->data);
	}?>
	<?php if (!$this->data) :?>
	<div>
		<p class="text-danger">Nie znaleziono transakcji</p>
	</div>

<?php 
else : ?>
	<div class="table-responsive">
		<p>Pomyślnie usunięto transakcję.</p>	
	</div>
<?php 
endif;
?>	  
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-4">
	      <a class="btn btn-default" href="../Transactions/admin_search" role="button">OK</a>
	    </div>
	   </div>


</div>
