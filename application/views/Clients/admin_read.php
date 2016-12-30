
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h2 class="page-header">Zarządzanie klientami:</h2>
	<form class="form" action="/Clients/admin_read" method="post">
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
					foreach ($this->data[2] as $client) {
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
					
				?>
			</tbody>
		</table>
	</div>
	<div>
		<nav aria-label="Page navigation" class="pager">
  			<ul class="pagination">
    		
		    <?php //var_dump($this->data[0], $this->data[1]);?>
		    <?php for ($i = 1; $i <= $this->data[1]; $i++) {
		    echo '<li class="'.($this->data[0]['pageNr'] == $i ? 'active' : '').'"><a href="/Clients/admin_read/'.$i, (isset($this->data[3]['clientData']) ? '/'.$this->data[3]['clientData'] : '').'">'.$i.'</a></li>';
		    }?>
		    
		    
		  </ul>
		</nav>
	</div>
<?php 
endif;
?>
	
</div>
