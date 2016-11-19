<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h2 class="page-header">Wpisy na dzień: <?php echo $this->data[0];?></h2>
  	<?php //var_dump($this->data);?>
	<div class="form-group">
		<form class="form-inline" action="/Dashboards/todayEntry" method="post">
			<div class="form-group">
				<input
				class="form-control"
				name="day"
				type="date"
				value="<?php echo $this->data[0];?>">
			</div>
			<div class="form-group">
				<button 
				class="btn btn-default" 
				type="submit" 
				name="ack">ok
				</button>
				
			</div>
		</form>
		<div>
	</div>	
		<?php if (empty($this->data[1])):?>
			
		<a><?php echo "Brak wpisów na ten dzień.";?></a>	
		<?php else:?>
		<div class="table-responsive">
		<br><table class="table table-hover">
			<thead>
				<tr>
					<th>Imię</th>
					<th>Nazwisko</th>
					<th>nr telefonu</th>
					<th>nazwa produktu</th>
					<th>data zawarcia</th>
					<th>okres</th>					
					<th>kwota</th>
					<th>Wprowadził</th>
					
				</tr>
			</thead>
			<tbody>
				
					<?php 
					foreach ($this->data[1] as $entry) {
						
						echo "<td>", $entry['clientName'], "</td>";
						echo "<td>", $entry['clientSurname'], "</td>";
						echo "<td>", $entry['phone_nr'], "</td>";
						echo "<td>", $entry['product_name'], "</td>";
						echo "<td>", $entry['init_date'], "</td>";
						echo "<td>", $entry['period'], "</td>";
						echo "<td>", $entry['credit_value'], "</td>";
						echo "<td>", $entry['user'], "</td>";
						echo "</tr>";
					}
					
				?>
			</tbody>
		</table>
	</div>	
		
		
		
		<?php endif;?>
		</div>
		
		

  	
</div>