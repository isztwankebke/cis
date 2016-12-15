<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Dzisiejsze alerty</h1>
	<?php 
	if (debug) {
		var_dump($this->data);
	}
	if (!$this->data):?>
	<div class="alert alert-danger" role="alert"><p align="center">Dzisiaj nie ma żadnych alertów, można grać w pasjansa:P</p></div>
	<?php else :?>
	<form class="form-horizontal" action="../Dashboards/index" method="post">
	<div class="table-responsive">
		
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Nazwa Alertu</th>
					<th>Imię i Nazwisko</th>
					<th>Pesel</th>
					<th>Data zawarcia</th>
					<th>nr telefonu</th>
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
						
						echo "<td>", $alerts['alert_name'], "</td>";
						echo "<td>", $alerts['clientName'], "</td>";
						echo "<td>", $alerts['pesel'], "</td>";
						echo "<td>", $alerts['init_date'], "</td>";
						echo "<td>", $alerts['phone_nr'], "</td>";
						echo '<td><input
									type="checkbox" 
									name="checked'.$alerts['id'].'"
	      							'.(!empty($alerts['checked']) ? "checked disabled" : "unchecked").'
								>
							</td>';
						echo '<td>'.(!empty($alerts['checked'])? $alerts['comments'] : '
										<input
											type="text"
											name="comments'.$alerts['id'].'"
											placeholder="Wpisz komentarz...">')
							
						.'</td>';
						echo '<td><button
									class="btn btn-warning" 
									value="'.$alerts['id'].'"
									type="submit"
									name="setChecked"
							'.(!empty($alerts['checked']) ? 'disabled="disabled"' : "").'
									>Zapisz</button>
								</td>';
								 
						echo "</tr>";
					}
					
				?>
			</tbody>
		</table>
	</div>
	</form>		
	
</div>
<?php endif;?>