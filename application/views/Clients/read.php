
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Dzisiejsze alerty</h1>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Imię</th>
					<th>Nazwisko</th>
					<th>Pesel</th>
					<th>Nr telefonu</th>
					<th>extra Info</th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
					//header('Content-type: text/html; charset=utf-8');
					foreach ($clients as $client) {
						echo "<tr>";
						echo "<td>", $client['id'], "</td>";
						echo "<td>", $client['name'], "</td>";
						echo "<td>", $client['surname'], "</td>";
						echo "<td>", $client['pesel'], "</td>";
						echo "<td>", $client['phone_nr'], "</td>";
						echo "<td>", $client['extra_info'], "</td>";
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
					 *
					//foreach
					echo'<td>'1'</td>'
					<td>Produkt A</td>
					<td>Jan</td>
					<td>Kowalski</td>
					<td>601100100</td>
					<td>6rat</td> */
				?>
			</tbody>
		</table>
	</div>
</div>