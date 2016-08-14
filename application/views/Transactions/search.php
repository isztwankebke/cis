
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Wyszukiwanie klienta:</h1>
	<form name="searchClientData" action="/transactions/search" method="post">
  <div class="form-group">
    <label for="searchClientData">Podaj PESEL, Nazwisko lub NR Telefonu</label>
    <input type="text" class="form-control" id="searchClientData" placeholder="PESEL, Nazwisko lub nr telefonu">
  </div>
  <button type="submit" class="btn btn-default">Szukaj</button>
</form>
<?php 
//echo $_POST['dane'];

if ($contentForLayout) :?>
	<div><a>nie znaleziono klienta</a></div>

<?php 
else :?>
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
					<th>Extra info</th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
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
						echo "<td>", $data['extra_info'], "</td>";
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