
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Wyszukiwanie klienta:</h1>
	<form class="form-horizontal" action="/Transactions/search" method="post">
  		<div class="form-group">
	    	<label for="searchClientData" class="col-sm-2 control-label">Wpisz szukane dane</label>
	    	<div class="col-sm-4">
	      		<input 
			      type="text" 
		    	  name="clientData" 
			      class="form-control" 
			      id="searchClientData" 
			      placeholder="PESEL, Nazwisko lub nr telefonu"
			      required="required"
			      tabindex="1"
			      autofocus="autofocus">
  			</div>
	  	</div>
  		<div class="form-group">
	    	<div class="col-sm-offset-2 col-sm-4">
	      	<button 
	      	type="submit" 
	      	class="btn btn-default"
	      	tabindex="2">Szukaj</button>
	    	</div>
	  	</div>  		
	</form>
</div>