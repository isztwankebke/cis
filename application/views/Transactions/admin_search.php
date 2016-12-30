<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h2 class="page-header">Zarządzanie transakcjami:</h2>
	<?php //var_dump($this->data);?>
	<form class="form" action="/Transactions/admin_search" method="post">
  		 <div class="row">
		  <div class="col-lg-10">
		    <div class="input-group">
		      <input type="text"
		       name="clientData" 
			   class="form-control" 
			   id="searchClientData"
			   value="<?php echo isset($this->data[3]['clientData'])? $this->data[3]['clientData'] : '' ?>" 
			   placeholder="szukaj po PESEL, Nazwisku lub nr telefonu"
			   required="required"
			   tabindex="1"
			   autofocus="autofocus">
		      <span class="input-group-btn">
		        <button class="btn btn-primary" type="submit">Szukaj</button>
		      </span>
		    </div><!-- /input-group -->
		  </div><!-- /.col-lg-6 -->
		</div><!-- /.row -->
	 </form>  	
	  	
	
	
<?php 
//echo $_POST['dane'];

if ($this->data == -1) :?>
	<div><p class="text-danger">Nie znaleziono transakcji</p></div>

<?php
elseif ($this->data == null) :?>
	
<?php 
elseif (!is_array($this->data)) :?>
	<div><p class="text-danger">Nie wpisano danych</p></div>
<?php 
else : ?>
	<div class="table-responsive">
	<br>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Imię</th>
					<th>Nazwisko</th>
					<th>Pesel</th>
					<th>Produkt</th>
					<th>Kwota Kredytu</th>
					<th>Data zawarcia</th>
					<th>Okres</th>
					<th>Spłacony</th>
					<th>Akcja</th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
					//var_dump($this->data);
					//header('Content-type: text/html; charset=utf-8');
					//echo $name;
					foreach ($this->data[2] as $data) {
						echo "<tr>";
						echo "<td>", $data['id'], "</td>";
						echo "<td>", $data['name'], "</td>";
						echo "<td>", $data['surname'], "</td>";
						echo "<td>", $data['pesel'], "</td>";
						echo "<td>", $data['product_name'], "</td>";
						echo "<td>", $data['credit_value'], "</td>";
						echo "<td>", $data['init_date'], "</td>";
						echo "<td>", $data['period'], "</td>";
						echo '<td><input 
	    							type="checkbox" 
	    							name="endEarlier'.$data['id'].'"
	      							'.(!empty($data['end_earlier']) ? "checked disabled" : "unchecked disabled").'
	      							></input></td>';
						echo '<td><a class="btn btn-info" role="button" href="/Transactions/admin_editTransaction/'.$data['id'].'">Edytuj</a></td>';
						echo '<td><a class="btn btn-danger" role="button" href="/Transactions/admin_deleteTransaction/'.$data['id'].'">Usuń</a></td>';
						echo "</tr>";
					}
					
					
				?>
			</tbody>
		</table>
	</div>
	<div>
		<nav aria-label="Page navigation" class="pager">
  			<ul class="pagination">
    		
		    <?php //var_dump($this->data[0], $this->data[1]);?>
		    <?php for ($i = 1; $i <= $this->data[1]; $i++) {
		    echo '<li class="'.($this->data[0]['pageNr'] == $i ? 'active' : '').'"><a href="/Transactions/admin_search/'.$i, (isset($this->data[3]['clientData']) ? '/'.$this->data[3]['clientData'] : '').'">'.$i.'</a></li>';
		    }?>
		    
		    
		  </ul>
		</nav>
	</div>


<?php 
endif;
?>

</div>