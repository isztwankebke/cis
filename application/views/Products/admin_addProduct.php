<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  	<h1 class="page-header">Zarządzanie Produktami:</h1>
  	<h3>Podaj dane do nowego Produktu:</h3>
<?php if (debug) {
		var_dump($this->data);
	}?>
	<form class="form-horizontal" method="post" action="../Products/admin_addProduct">
	  <div class="form-group">
	    <label for="inputProductName" class="col-sm-2 control-label">Nazwa Produktu</label>
	    <div class="col-sm-4">
	      <input 
	      type="text"
	      maxlength="50"
	      
	      class="form-control" 
	      id="inputProductName" 
	      name="product_name" 
	      placeholder="Nazwa Produktu"
	      tabindex="1"
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