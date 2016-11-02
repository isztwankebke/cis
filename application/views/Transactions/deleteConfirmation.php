<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Zarządzanie Transakcjami:</h1>
	
	<?php if (debug) {
		var_dump($this->data);
	}?>
	<h3>Czy na pewno chcesz usunąć poniższą transakcję?</h3>
	<form class="form-horizontal" method="post" action="../admin_deleteTransaction">
	 <?php if (!$this->data) :?>
	<div><p class="text-danger">Nie znaleziono transakcji</p></div>

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
					<th>Kwota kredytu</th>
					<th>Data zawarcia</th>
					<th>Okres</th>
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
						echo "<td>", $data['credit_value'], "</td>";
						echo "<td>", $data['init_date'], "</td>";
						echo "<td>", $data['period'], "</td>";
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
	    <input type="hidden" name="transactionId" value="<?php echo $this->data[0]['id'];?>"> 
	    </div>
	  </div>
	</form>

</div>
