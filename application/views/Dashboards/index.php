<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Dzisiejsze alerty</h1>
	<?php 
	if (debug) {
		var_dump($this->data);
	}
	if (!$this->data):?>
	<div class="alert alert-danger" role="alert"><p align="center">Dzisiaj nie ma żadnych alertów, można grać w pasjansa:P</p></div>
	<?php else :?>
	<div class="table-responsive">
		
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Nazwa Produktu</th>
					<th>Imię</th>
					<th>Nazwisko</th>
					<th>nr telefonu</th>
					<th>Powiadomienie</th>
					<th>Załatwione</th>					
					<th>Komentarz</th>
					<th>Akcja</th>
					
				</tr>
			</thead>
			<tbody>
				
					<?php 
					//header('Content-type: text/html; charset=utf-8');
					//echo $name;
					foreach ($this->data as $alerts) {
						
						echo "<td>", $alerts['product_name'], "</td>";
						echo "<td>", $alerts['name'], "</td>";
						echo "<td>", $alerts['surname'], "</td>";
						echo "<td>", $alerts['phone_nr'], "</td>";
						echo "<td>";
						if ($alerts['half_period'])
							echo "połowa kredytu; ";
						if ($alerts['period_info1'])
							echo "spłacone ",$alerts['period_info1'] ," raty;";
						echo "</td>";
								
						echo '<td><input type="checkbox"></input></td>';
						echo '<td><input placeholder="dopisz komentarz"></input></td>';
						echo "<td> Zapisz</td>";
						echo "</tr>";
					}
					
				?>
			</tbody>
		</table>
	</div>		
	
</div>
<?php endif;?>