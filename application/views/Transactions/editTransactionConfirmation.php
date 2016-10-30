<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">
	<?php if ($this->data) {
			echo "Pomyślnie zmieniono wpis w bazie danych";
			}
			else {
				echo "Nie zmieniono wpisu w bazie danych"; 
			}
			if (debug) {
			//var_dump($this->data);
			}?>
	</h1>
	<div>
		<a class="btn btn-default" href="../Transactions/admin_search" role="button">OK</a>
	</div>
</div>