<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Dodaj Klienta:</h1>
	<?php if (debug) {
		var_dump($this->data);
	}?>
	<form class="form-horizontal" method="post" action="../Transactions/addTransaction">
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
	      placeholder="Pesel"
	      tabindex="1"
	      autofocus="autofocus"
	      required="required">
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
	      placeholder="Imię"
	      tabindex="2"
	      autofocus="autofocus"
	      required="required">
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
	      placeholder="Nazwisko"
	      tabindex="3"
	      autofocus="autofocus"
	      required="required">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputPhoneNr" class="col-sm-2 control-label">Nr telefonu</label>
	    <div class="col-sm-4">
	      <input 
	      type="text"
	      maxlength="13" 
	      class="form-control" 
	      id="inputPhoneNr" 
	      name="phone_nr" 
	      placeholder="123456789"
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
  			foreach ($this->data as $poduct) {
  				echo "<option>".$poduct['product_name']."</option>";
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
	      required="required">
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
	      required="required">
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
	      required="required">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputDeleyed" class="col-sm-2 control-label">Odroczona płatność</label>
	    <div class="col-sm-4">
	      <input 
	      type="number"
	      maxlength="2"
	      min="1"
	      max="12" 
	      class="form-control" 
	      id="inputDeleyed" 
	      name="deleyed" 
	      placeholder="w miesiącach np 0 albo 3"
	      tabindex="9"
	      autofocus="autofocus"
	      required="required">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputExtraInfo" class="col-sm-2 control-label">Notatki, info dodatkowe o kliencie</label>
	    <div class="col-sm-4">
	      <textarea
	      id="inputExtraInfo" 
	      maxlength="1000"
	      class="form-control" 
	      rows="3"
	      name="extra_info"
	      tabindex="10"
	      autofocus="autofocus"
	      placeholder="Zawsze dopisuję: kłamca. Możesz też dopisać: kutas albo przemiły człowiek, daje napiwki... Możesz też nic nie dopisywać." 
	      ></textarea>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-4">
	      <button 
	      type="submit" 
	      class="btn btn-default"
	      tabindex="11"
	      autofocus="autofocus">Zapisz</button>
	    </div>
	  </div>
	</form>

</div>
