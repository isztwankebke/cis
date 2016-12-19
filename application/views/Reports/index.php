<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Wybierz rodzaj raportu:</h1>
	
	<?php //var_dump($this->data);?>
	
	<form class="form-horizontal" method="post" action="../Reports/index">
		<div class="radio">
		  <label>
		    <input type="radio" name="offset" id="optionsRadios1" value="0" 
		    <?php echo ($this->data[1] == 0 && isset($this->data[1])) ? 'checked="checked"' : '';?>>
		    Raport na bieżący tydzień
		  </label>
		</div>
		<div class="radio">
		  <label>
		    <input type="radio" name="offset" id="optionsRadios2" value="1" 
		    <?php echo ($this->data[1] == 1 && isset($this->data[1])) ? 'checked="checked"' : '';?>>
		    Raport na przyszły tydzień
		  </label>
		</div>
		<div class="radio">
		  <label>
		    <input type="radio" name="offset" id="optionsRadios3" value="2"
		    <?php echo ($this->data[1] == 2 && isset($this->data[1])) ? 'checked="checked"' : '';?>>
		    Raport za okres:
		  </label>
		</div>
		<br>
		<div class="form-inline">
		<div class="form-group">
		  <label class="col-sm-2 control-label" for="dateFrom">Od</label>
		  <input type="date" class="form-control" id="dateFrom" name="dateFrom"
		  <?php echo ($this->data[1] == 2 && isset($this->data[1])) ? 'value="'.$this->data[2].'"' : '';?>>
		</div>
		<div class="form-group">
		  <label class="col-sm-2 control-label" for="dateTo">Do</label>
		  <input type="date" class="form-control" id="dateTo" name="dateTo"
		  <?php echo ($this->data[1] == 2 && isset($this->data[1])) ? 'value="'.$this->data[3].'"' : '';?>>
		</div>
		</div>
		<div class="form">
		<br>
		 <button type="submit" class="btn btn-primary" name="generateReport" value="1">Generuj</button>
		 <?php echo (!empty($this->data[0])) ? 
		  '<button type="submit" class="btn btn-success" name="createCSV" value="1">Zapisz do pliku</button>' : '';
		 ?>
		 </div>
		
				
	</form>
<div>
<?php 
if (!empty($this->data[0])):
?>
	
	
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
					foreach ($this->data[0] as $alerts) {
						
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
		
<?php elseif (isset($this->data[0])):?>
<a>brak danych do raportu za dany okres</a>
<?php endif;?>
</div>

	
</div>
