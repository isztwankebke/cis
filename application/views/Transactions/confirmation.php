<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">
	<?php if ($this->data) {
			echo "Dodano klienta";
			}
			else {
				echo "Nie dodano klienta"; 
			}
			if (debug) {
			var_dump($this->data);
			}?>
	</h1>
	<div>
		<a class="btn btn-default" href="../Transactions/addTransaction" role="button">OK</a>
	</div>
</div>