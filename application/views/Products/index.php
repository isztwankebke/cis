
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Lista Produktów</h1>
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Nazwa</th>
					<th>Akcja</th>					
				</tr>
			</thead>
			<tbody>
				
					<?php 
					//header('Content-type: text/html; charset=utf-8');
					//echo $name;
					foreach ($this->data as $product) {
						echo "<tr>";
						echo "<td>", $product['id'], "</td>";
						echo "<td>", $product['product_name'], "</td>";
						echo "<td> Edytuj</td>"; 
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
</div>