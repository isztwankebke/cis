<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h2 class="page-header">Ammount Credit:</h2>
  	<?php //var_dump($this->data);?>
	<div class="col-sm-4 form-group">
		<form class="form-inline" action="/Users/supervisor_ammountCredit" method="post">
			<div class="form-group">
				<input
				class="form-control"
				name="month"
				type="month"
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
	<?php //var_dump($this->data);?>
		<h4><br>Suma kredytów w miesiącu: <?php 
		foreach ($this->data[1] as $product) {
			extract($this->data[1]);
			if ($product['product_name'] == "Total"){
				
				echo $product['credit_value'];
			}
			//var_dump($product);
		}
	
	//echo $this->data[1][0]['total'];?></h4>
	</div>
	<div>
		<h4><br>Wg produktów: <br></h4>
		<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nazwa produktu</th>
					<th>Wartość kredytów</th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
					foreach ($this->data[1] as $product) {
						if ($product['product_name'] == 'Total') {continue;}
						echo "<tr>";
						echo "<td>", $product['product_name'], "</td>";
						echo "<td>", $product['credit_value'], "</td>";
						echo "</tr>";
					}
					?>
			</tbody>
		</table>
	</div>
	</div>

	</div>	

  	
</div>