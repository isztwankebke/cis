<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<?php if (debug) var_dump($this->data);?>
	<h1 class="page-header">Zarządzanie alertami</h1>
	<div>
		<a class="btn btn-primary" href="../Dashboards/admin_addAlert" role="button">Dodaj Alert</a>
	</div>
	<div class="table-responsive">
		
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Nazwa Alertu</th>
					<th>Nazwa produktu</th>
					<th>połowa rat</th>
					<th>po ilu spłaconych ratach informować</th>
					<th>ile tygodni wcześniej</th>
					<th>powiadomienie o spłaconej ostatniej racie</th>
					<th>po ilu kolejnych ratach</th>					
					<th>powiadamiaj jeśli klient posiada już ten produkt</th>
					<th>po ilu kolejnych ratach jeśli już posiada produkt</th>
					<th>Akcja</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
					//header('Content-type: text/html; charset=utf-8');
					//echo $name;
					foreach ($this->data as $alerts) {
						echo "<tr>";
						echo "<td>", $alerts['id'], "</td>";
						echo "<td>", $alerts['alert_name'], "</td>";
						echo "<td>", $alerts['product_name'], "</td>";
						echo "<td>", $alerts['is_half_period'], "</td>";
						echo "<td>", $alerts['after_period_info1'], "</td>";
						echo "<td>", $alerts['week_before_info'], "</td>";
						echo "<td>", $alerts['is_last_installment'], "</td>";
						echo "<td>", $alerts['after_period1_next_installment'], "</td>";
						echo "<td>", $alerts['has_product'], "</td>";
						echo "<td>", $alerts['after_period_info2'], "</td>";
						echo '<td><a class="btn btn-warning" role="button" href="/Dashboards/admin_editAlert/'.$alerts['id'].'">Edytuj</a></td>';
						echo '<td><a class="btn btn-danger" role="button" href="/Dashboards/admin_deleteAlert/'.$alerts['id'].'">Usuń</a></td>';
						echo "</tr>";
					}
					
				?>
			</tbody>
		</table>
	</div>
</div>