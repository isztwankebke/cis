<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  	<h1 class="page-header">Zarządzanie Produktami:</h1>
  	<h3>Podaj nową nazwę dla <?php echo $this->data[0]['product_name']?>:</h3>
<?php if (debug) {
		var_dump($this->data);
	}?>
	<form class="form-horizontal" method="post" action="../admin_editProduct">
	  <div class="form-group">
	    <label for="inputProductName" class="col-sm-2 control-label">Nazwa Produktu</label>
	    <div class="col-sm-4">
	      <input 
	      type="text"
	      maxlength="11"
	      value="<?php echo $this->data[0]['product_name']?>"
	      class="form-control" 
	      id="inputProductName" 
	      name="product_name" 
	      placeholder="Nazwa Produktu"
	      tabindex="1"
	      autofocus="autofocus"
	      required="required">
	    </div>
	    </div>
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
	      tabindex="2"
	      autofocus="autofocus">Zapisz</button>
	    </div>
	   </div>
	</form>

  	
</div>