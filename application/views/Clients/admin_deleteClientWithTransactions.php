<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Zarządzanie Klientami:</h1>
	<h3>Usunięcie danych klienta o nr PESEL: <?php echo $this->data[0]['pesel'];?></h3>
	<?php if (debug) {
		var_dump($this->data);
	}?>
	<h3>Czy na pewno chcesz usunąć klienta i wszystkie jego transakcje?</h3>
	<form class="form-horizontal" method="post" action="../admin_deleteClient">
	 <?php if (!$this->data) :?>
	<div><p class="text-danger">Nie znaleziono klienta</p></div>

<?php 
else : ?>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Imię</th>
					<th>Nazwisko</th>
					<th>Pesel</th>
					<th>Produkt</th>
					<th>Data zawarcia</th>
					<th>Okres</th>
					<th>Wartość kredytu</th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
					//var_dump($this->data);
					//header('Content-type: text/html; charset=utf-8');
					//echo $name;
					foreach ($this->data as $data) {
						echo "<tr>";
						echo "<td>", $data['id'], "</td>";
						echo "<td>", $data['name'], "</td>";
						echo "<td>", $data['surname'], "</td>";
						echo "<td>", $data['pesel'], "</td>";
						echo "<td>", $data['product_name'], "</td>";
						echo "<td>", $data['init_date'], "</td>";
						echo "<td>", $data['period'], "</td>";
						echo "<td>", $data['credit_value'], "</td>";
						echo "</tr>";
					}
					/**
					 * $clients = []; // collected from database
					 * 
					 * foreach ($clients as $client) {
					 * 
					 * echo <tr>
					 * echo <td> $client['name'];
					 * echo </tr>
					 * 
					 * }
					 * 
					 */
					
				?>
			</tbody>
		</table>
	</div>
<?php 
endif;
?>	  
	  <h3>Jeśli tak, naciśnij USUŃ</h3>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-4">
	      <button 
	      type="submit" 
	      class="btn btn-danger"
	      tabindex="8"
	      autofocus="autofocus">USUŃ</button>
	    </div>
	    <div>
	    <input type="hidden" name="pesel" value="<?php echo $data['pesel'];?>"> 
	    <input type="hidden" name="product" value="1">
	    </div>
	  </div>
	</form>

</div>
