<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  	<h1 class="page-header">Zarządzanie Alertami:</h1>
  	<h3>Czy oby na pewno chcesz usunąć Alert <b><?php echo $this->data[0]['product_name'];?></b>? <br>
  	Naciśniesz przycisk usuń i bezpowrotnie usuniesz alert z bazy! Zastanów się 3 razy:P
  	</h3>
<?php if (debug) {
		var_dump($this->data);
	}?>
	<form class="form-horizontal" method="post" action="../admin_deleteAlert">
	    
	    <div class="hidden">
	    <label for="inputId" class="col-sm-2 control-label">ID</label>
	    <div class="col-sm-4">
	      <input 
	      type="text"
	      maxlength="11"
	      value="<?php echo $this->data[0]['id']?>"
	      class="form-control" 
	      id="inputId" 
	      name="id" 
	      placeholder="ID"
	      tabindex="4"
	      autofocus="autofocus"
	      required="required">
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-4">
	      <button 
	      type="submit" 
	      class="btn btn-default"
	      tabindex="3"
	      autofocus="autofocus">USUŃ DRANIA</button>
	    </div>
	   </div>
	   <?php var_dump($this->data);?>
	</form>

  	
</div>