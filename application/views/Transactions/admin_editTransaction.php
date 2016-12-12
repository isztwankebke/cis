<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  	<h1 class="page-header">Edycja transakcji:</h1>
  	<h3>Wprowadź dane dla klienta: </h3>
<?php if (!debug) {
		var_dump($this->data);
		var_dump($this->data[1]);
	}?>
	<form class="form-horizontal" method="post" action="../admin_editTransaction">
	  <div class="form-group">
	    <label for="inputPesel" class="col-sm-2 control-label">Pesel</label>
	    <div class="col-sm-4">
	      <input 
	      type="text"
	      maxlength="11"
	      min="0"
	      max="99999999999"
	      class="form-control" 
	      id="inputPesel" 
	      name="pesel" 
	      value="<?php echo $this->data[0][0]['pesel'];?>"
	      tabindex="1"
	      autofocus="autofocus"
	      required="required"
	      readonly>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputName" class="col-sm-2 control-label">Imię</label>
	    <div class="col-sm-4">
	      <input 
	      type="text"
	      maxlength="30" 
	      class="form-control" 
	      id="inputName" 
	      name="name" 
	      value="<?php echo $this->data[0][0]['name'];?>"
	      tabindex="2"
	      autofocus="autofocus"
	      required="required"
	      readonly>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputSurname" class="col-sm-2 control-label">Nazwisko</label>
	    <div class="col-sm-4">
	      <input 
	      type="text" 
	      maxlength="30"
	      class="form-control" 
	      id="inputSurname" 
	      name="surname" 
	      value="<?php echo $this->data[0][0]['surname'];?>"
	      tabindex="3"
	      autofocus="autofocus"
	      required="required"
	      readonly>
	    </div>
	  </div>
	    <div class="hidden">
	    <label for="inputId" class="col-sm-2 control-label">ID</label>
	    <div class="col-sm-4">
	      <input 
	      type="text"
	      maxlength="11"
	      value="<?php echo $this->data[0][0]['id']?>"
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
	    <label for="inputProduct" class="col-sm-2 control-label">Produkt</label>
	    <div class="col-sm-4">
	      <select 
	      class="form-control"
	      tabindex="5"
	      autofocus="autofocus"
	      id="inputProduct"
	      name="product_name">
	      
  			<?php
  			//var_dump($this->data[1]);
  			foreach ($this->data[1] as $product) {
  				//var_dump($product[1]['product_name']);
  				echo "<option value=".$product['id'].">", $product['product_name'], "</option>";
  			}
  			?>
  			
		  </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputInitDate" class="col-sm-2 control-label">Data zawarcia umowy</label>
	    <div class="col-sm-4">
	      <input 
	      type="date" 
	      class="form-control" 
	      id="inputInitDate" 
	      name="init_date" 
	      placeholder=""
	      tabindex="6"
	      autofocus="autofocus"
	      required="required"
	      value="<?php echo $this->data[0][0]['init_date'];?>">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputCreditValue" class="col-sm-2 control-label">Kwota kredytu</label>
	    <div class="col-sm-4">
	      <input 
	      type="number"
	      maxlength="7"
	      min="1"
	      max="9999999" 
	      class="form-control" 
	      id="inputCreditValue" 
	      name="credit_value" 
	      placeholder="wartość kredytu"
	      tabindex="7"
	      autofocus="autofocus"
	      required="required"
	      value="<?php echo $this->data[0][0]['credit_value'];?>">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputPeriod" class="col-sm-2 control-label">Okres kredytu</label>
	    <div class="col-sm-4">
	      <input 
	      type="number"
	      maxlength="3"
	      min="1"
	      max="120" 
	      class="form-control" 
	      id="inputPeriod" 
	      name="period" 
	      placeholder="12"
	      tabindex="8"
	      autofocus="autofocus"
	      required="required"
	      value="<?php echo $this->data[0][0]['period'];?>">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputDeleyedPayment" class="col-sm-2 control-label">Odroczona płatność</label>
	    <div class="col-sm-4">
	      <input 
	      type="number"
	      maxlength="1"
	      min="0"
	      max="9" 
	      class="form-control" 
	      id="inputDeleyedPayment" 
	      name="deleyedPayment" 
	      
	      tabindex="9"
	      autofocus="autofocus"
	      
	      value="<?php echo $this->data[0][0]['deleyed_payment'];?>">
	    </div>
	  </div>
	  
	  
	  
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-4">
	      <button 
	      type="submit" 
	      class="btn btn-default"
	      tabindex="10"
	      autofocus="autofocus">Zapisz</button>
	    </div>
	   </div>
	</form>

  	
</div>