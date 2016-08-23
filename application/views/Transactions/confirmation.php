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
	<form class="form-horizontal" action="/transactions/addTransaction" method="post">
  		<div class="form-group">
	    	<div class="col-sm-offset-2 col-sm-4">
	      	<button 
	      	type="submit" 
	      	class="btn btn-default"
	      	tabindex="1"
	      	autofocus="autofocus">OK</button>
	    	</div>
	  	</div>  		
	</form>
</div>