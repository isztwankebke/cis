<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  	<h1 class="page-header"></h1>
  	<h3>Wprowadzone przez Ciebie dane już istnieją w bazie:<br></h3>
<?php if (debug) {
		var_dump($this->data);
		var_dump($this->data[1]);
	}
	//var_dump($this->data);?>
	<form class="form-horizontal" method="post" action="../Transactions/confirmationDuplicate">
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
	      value="<?php echo $this->data[1][0]['pesel'];?>"
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
	      value="<?php echo $this->data[1][0]['name'];?>"
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
	      value="<?php echo $this->data[1][0]['surname'];?>"
	      required="required"
	      readonly>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputProduct" class="col-sm-2 control-label">Produkt</label>
	    <div class="col-sm-4">
	      <input 
	      class="form-control"
	      id="inputProduct"
	      name="product_name"
	      value="<?php echo $this->data[1][0]['product_name']; ?>"
  		  readonly>
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
	      required="required"
	      value="<?php echo $this->data[1][0]['init_date'];?>"
	      readonly>
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
	      required="required"
	      value="<?php echo $this->data[1][0]['credit_value'];?>"
	      readonly>
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
	      required="required"
	      value="<?php echo $this->data[1][0]['period'];?>"
	      readonly>
	    </div>
	  </div>
	  <div class="hidden">
	    <label for="inputClientId" class="col-sm-2 control-label">clientID</label>
	    <div class="col-sm-4">
	      <input 
	      type="hidden"
	      maxlength="11"
	      value="<?php echo $this->data[1][0]['client_id']?>"
	      class="form-control" 
	      id="inputClientId" 
	      name="client_id" 
	      required="required">
	    </div>
	  </div>
	  <div class="hidden">
	    <label for="inputProductId" class="col-sm-2 control-label">productID</label>
	    <div class="col-sm-4">
	      <input 
	      type="hidden"
	      maxlength="11"
	      value="<?php echo $this->data[1][0]['product_id']?>"
	      class="form-control" 
	      id="inputProductId" 
	      name="product_id" 
	      required="required">
	    </div>
	  </div>
	  <div class="hidden">
	    <label for="inputInitDate" class="col-sm-2 control-label">init_date</label>
	    <div class="col-sm-4">
	      <input 
	      type="date"
	      value="<?php echo $this->data[1][0]['init_date']?>"
	      class="form-control" 
	      id="inputInitDate" 
	      name="init_date" 
	      required="required">
	    </div>
	  </div>
	  <div class="hidden">
	    <label for="inputCreditValue" class="col-sm-2 control-label">credit_value</label>
	    <div class="col-sm-4">
	      <input 
	      type="text"
	      value="<?php echo $this->data[1][0]['credit_value']?>"
	      class="form-control" 
	      id="inputCreditValue" 
	      name="credit_value" 
	      required="required">
	    </div>
	  </div>
	  <div class="hidden">
	    <label for="inputPeriod" class="col-sm-2 control-label">period</label>
	    <div class="col-sm-4">
	      <input 
	      type="text"
	      maxlength="11"
	      value="<?php echo $this->data[1][0]['period']?>"
	      class="form-control" 
	      id="inputPeriod" 
	      name="period" 
	      required="required">
	    </div>
	  </div>
	  <div class="hidden">
	    <label for="inputEndDate" class="col-sm-2 control-label">end_date</label>
	    <div class="col-sm-4">
	      <input 
	      type="date"
	      maxlength="11"
	      value="<?php echo $this->data[1][0]['end_date']?>"
	      class="form-control" 
	      id="inputEndDate" 
	      name="end_date"
	      required="required">
	    </div>
	  </div>
	  <div class="hidden">
	    <label for="inputHalfPeriod" class="col-sm-2 control-label">half_period</label>
	    <div class="col-sm-4">
	      <input 
	      type="date"
	      maxlength="11"
	      value="<?php echo $this->data[1][0]['half_period']?>"
	      class="form-control" 
	      id="inputHalfPeriod" 
	      name="half_period" 
	      required="required">
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="">
	      <h3>Jeśli jest to kolejny taki sam wpis - naciśnij
	      <button 
	      type="submit" 
	      class="btn btn-success"
	      tabindex="1"
	      name="ack"
	      value="acknowledge"
	      autofocus="autofocus">Potwierdź</button></h3>
	      
	      <h3>Jeśli to wpis przez pomyłkę i nie powinien się powtórzyć - naciśnij
	      <a class="btn btn-danger" href="../Transactions/addTransaction" role="button">Anuluj</a></h3>
	    
	    </div>
	   </div>
	</form>

  	
</div>