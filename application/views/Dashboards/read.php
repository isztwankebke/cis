<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<?php var_dump($this->data);?>
	<h1 class="page-header">Zarządzanie alertami</h1>
	<div class="table-responsive">
		
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Nazwa produktu</th>
					<th>połowa rat</th>
					<th>po ilu ratach informować</th>
					<th>ile tygodni wcześniej</th>
					<th>powiadomienie o spłaconej ostatniej racie</th>
					<th>po ilu kolejnych ratach</th>
					<th>powiadomienie o spłaconej ostatniej racie</th>
					<th>powiadamiaj jeśli klient posiada już ten produkt</th>
					<th>po ilu kolejnych ratach jeśli już posiada produkt</th>
					<th>Akcja</th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
					//header('Content-type: text/html; charset=utf-8');
					//echo $name;
					foreach ($this->data as $alerts) {
						echo "<tr>";
						echo "<td>", $alerts['id'], "</td>";
						echo "<td>", $alerts['product_name'], "</td>";
						echo "<td>", $alerts['half_period'], "</td>";
						echo "<td>", $alerts['period_info1'], "</td>";
						echo "<td>", $alerts['week_info'], "</td>";
						echo "<td>", $alerts['last'], "</td>";
						echo "<td>", $alerts['period_next'], "</td>";
						echo "<td>", $alerts['has_product'], "</td>";
						echo "<td>", $alerts['period_info2'], "</td>";
						echo "<td>Edytuj Usuń</td>";
						echo "</tr>";
					}
					
				?>
			</tbody>
		</table>
	</div>
</div>