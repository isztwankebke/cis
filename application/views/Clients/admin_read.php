
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Zarządzanie klientami
	</h1>
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Imię</th>
					<th>Nazwisko</th>
					<th>Pesel</th>
					<th>Nr telefonu</th>
					<th>extra Info</th>
					<th>Akcja</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
					//header('Content-type: text/html; charset=utf-8');
					//echo $name;
					foreach ($this->data as $client) {
						echo "<tr>";
						echo "<td>", $client['id'], "</td>";
						echo "<td>", $client['name'], "</td>";
						echo "<td>", $client['surname'], "</td>";
						echo "<td>", $client['pesel'], "</td>";
						echo "<td>", $client['phone_nr'], "</td>";
						echo "<td>", $client['extra_info'], "</td>";
						echo '<td><a class="btn btn-warning" role="button" href="/Clients/admin_editClient/'.$client['id'].'">Edytuj</a></td>';
						echo '<td><a class="btn btn-danger" role="button" href="/Clients/admin_deleteClient/'.$client['id'].'">Usuń</a></td>';
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
	
</div>