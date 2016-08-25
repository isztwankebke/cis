<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Zarządzanie użytkownikami</h1>
	
	<div class="table-responsive">
		
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Nazwa użytkownika</th>
					<th>Imię</th>
					<th>Nazwisko</th>
					<th>e-mail</th>
					<th>Grant</th>
					<th>Data utworzenia</th>					
					<th>Ostatnia data logowania</th>
					<th>Ostatnia data zmian</th>
					<th>Akcja</th>
					
				</tr>
			</thead>
			<tbody>
				
					<?php 
					//header('Content-type: text/html; charset=utf-8');
					//echo $name;
					foreach ($this->data as $users) {
						echo "<tr>";
						echo "<td>", $users['id'], "</td>";
						echo "<td>", $users['username'], "</td>";
						echo "<td>", $users['name'], "</td>";
						echo "<td>", $users['surname'], "</td>";
						echo "<td>", $users['email'], "</td>";
						echo "<td>", $users['grant_access'], "</td>";
						echo "<td>", $users['created'], "</td>";
						echo "<td>", $users['last_login'], "</td>";
						echo "<td>", $users['modified'], "</td>";
						echo "<td> Zmień hasło<br>Usuń</td>";
						echo "</tr>";
					}
					
				?>
			</tbody>
		</table>
	</div>
</div>
