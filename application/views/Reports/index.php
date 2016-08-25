<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Wybierz rodzaj raportu:</h1>
	
	
	
	<form class="form-horizontal" method="post" action="generate">
		<div class="radio">
		  <label>
		    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="checked">
		    Raport na bieżący tydzień
		  </label>
		</div>
		<div class="radio">
		  <label>
		    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
		    Raport na przyszły tydzień
		  </label>
		</div>
		<div class="radio">
		  <label>
		    <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
		    Raport za okres:
		  </label>
		</div>
		<br>
		<div class="form-inline">
		<div class="form-group">
		  <label class="col-sm-2 control-label" for="exampleInputName2">Od</label>
		  <input type="date" class="form-control" id="exampleInputName2">
		</div>
		<div class="form-group">
		  <label class="col-sm-2 control-label" for="exampleInputEmail2">Do</label>
		  <input type="date" class="form-control" id="exampleInputEmail2">
		</div>
		 <button type="submit" class="btn btn-default">Generuj</button>
		</div>
				
	</form>


	
</div>
