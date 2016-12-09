<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Wybierz rodzaj raportu:</h1>
	
	
	
	<form class="form-horizontal" method="post" action="../Reports/index">
		<div class="radio">
		  <label>
		    <input type="radio" name="offset" id="optionsRadios1" value="0" checked="checked">
		    Raport na bieżący tydzień
		  </label>
		</div>
		<div class="radio">
		  <label>
		    <input type="radio" name="offset" id="optionsRadios2" value="1">
		    Raport na przyszły tydzień
		  </label>
		</div>
		<div class="radio">
		  <label>
		    <input type="radio" name="offset" id="optionsRadios3" value="2">
		    Raport za okres:
		  </label>
		</div>
		<br>
		<div class="form-inline">
		<div class="form-group">
		  <label class="col-sm-2 control-label" for="dateFrom">Od</label>
		  <input type="date" class="form-control" id="dateFrom" name="dateFrom">
		</div>
		<div class="form-group">
		  <label class="col-sm-2 control-label" for="dateTo">Do</label>
		  <input type="date" class="form-control" id="dateTo" name="dateTo">
		</div>
		</div>
		<div class="form">
		<br>
		 <button type="submit" class="btn btn-default">Generuj</button>
		</div>
		
				
	</form>
<div>
<?php 
if ($this->data):
?>
	<div>
	<input type="button" value="Zapisz do pliku">
	</div>
	<div class="table-responsive">
		
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Nazwa Alertu</th>
					<th>Imię i Nazwisko</th>
					<th>Pesel</th>
					<th>Data zawarcia</th>
					<th>nr telefonu</th>					
					<th>Komentarz</th>
					
					
				</tr>
			</thead>
			<tbody>
				
					<?php 
					//header('Content-type: text/html; charset=utf-8');
					//echo $name;
					foreach ($this->data as $alerts) {
						
						echo "<td>", $alerts['alert_name'], "</td>";
						echo "<td>", $alerts['clientName'], "</td>";
						echo "<td>", $alerts['pesel'], "</td>";
						echo "<td>", $alerts['init_date'], "</td>";
						echo "<td>", $alerts['phone_nr'], "</td>";
						echo "<td>", $alerts['comments'], "</td>";
						
						echo "</tr>";
					}
					
				?>
			</tbody>
		</table>
	</div>		
<?php endif;?>
</div>

	
</div>
