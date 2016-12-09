<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Wyszukiwanie klienta:</h1>
	<form class="form-horizontal" action="/transactions/search" method="post">
  		<div class="form-group">
	    	<label for="searchClientData" class="col-sm-2 control-label">Wpisz szukane dane</label>
	    	<div class="col-sm-4">
	      		<input 
			      type="text" 
		    	  name="clientData" 
			      class="form-control" 
			      id="searchClientData" 
			      placeholder="PESEL, Nazwisko lub nr telefonu"
			      required="required">
  			</div>
	  	</div>
  		<div class="form-group">
	    	<div class="col-sm-offset-2 col-sm-4">
	      	<button 
	      	type="submit" 
	      	class="btn btn-default"
	      	tabindex="9"
	      	autofocus="autofocus">Szukaj</button>
	    	</div>
	  	</div>  		
	</form>
<?php 
//echo $_POST['dane'];

if (!$this->data) :?>
	<div><p class="text-danger">Nie znaleziono klienta</p></div>

<?php 
elseif (!is_array($this->data)) :?>
	<div><p class="text-danger">Nie wpisano danych</p></div>
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
					<th>Nr telefonu</th>
					<th>Produkt</th>
					<th>Data zawarcia</th>
					<th>Okres</th>
					<th>Kwota kredytu</th>
					<th>Extra info</th>
					<th>Wcześniejsza spłata</th>
					<th>Akcja</th>
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
						echo "<td>", $data['phone_nr'], "</td>";
						echo "<td>", $data['product_name'], "</td>";
						echo "<td>", $data['init_date'], "</td>";
						echo "<td>", $data['period'], "</td>";
						echo "<td>", $data['credit_value'], "</td>";
						echo "<td>", $data['extra_info'], "</td>";
						echo '<td><input type="checkbox" name="endEarlier"></input></td>';
						echo '<td><a class="btn btn-warning" role="button" href="/Transactions/update/'.$data['id'].'">Zapisz</a></td>';
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

</div>