<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Zarządzanie Klientami:</h1>
	<h3>Edycja danych klienta o nr PESEL: <?php echo $this->data[0]['pesel']?></h3>
	<?php if (debug) {
		var_dump($this->data);
	}?>
	<form class="form-horizontal" method="post" action="../admin_editClient">
	  <div class="form-group">
	    <label for="inputName" class="col-sm-2 control-label">Imię</label>
	    <div class="col-sm-4">
	      <input 
	      value="<?php echo $this->data[0]['name']?>"
	      type="text"
	      maxlength="30" 
	      class="form-control" 
	      id="inputName" 
	      name="name" 
	      placeholder="Imię"
	      tabindex="1"
	      autofocus="autofocus">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputSurname" class="col-sm-2 control-label">Nazwisko</label>
	    <div class="col-sm-4">
	      <input
	      value="<?php echo $this->data[0]['surname']?>" 
	      type="text" 
	      maxlength="30"
	      class="form-control" 
	      id="inputSurname" 
	      name="surname" 
	      placeholder="Nazwisko"
	      tabindex="2"
	      autofocus="autofocus">
	    </div>
	  </div>
	  <div class="hide">
	    <label for="inputId" class="col-sm-2 control-label">ID</label>
	    <div class="col-sm-4">
	      <input 
	      value="<?php echo $this->data[0]['id']?>"
	      type="text"
	      maxlength="40" 
	      class="form-control" 
	      id="inputId" 
	      name="id" 
	      placeholder="id"
	      tabindex="5"
	      autofocus="autofocus">
	    </div>
	  </div>
	  <div class="hide">
	    <label for="inputPesel" class="col-sm-2 control-label">PESEL</label>
	    <div class="col-sm-4">
	      <input 
	      value="<?php echo $this->data[0]['pesel']?>"
	      type="text"
	      maxlength="40" 
	      class="form-control" 
	      id="inputPesel" 
	      name="pesel" 
	      placeholder="pesel"
	      autofocus="autofocus">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputPhoneNr" class="col-sm-2 control-label">Nr telefonu</label>
	    <div class="col-sm-4">
	      <input
	      value="<?php echo $this->data[0]['phone_nr']?>" 
	      type="text" 
	      maxlength="13"
	      class="form-control" 
	      id="inputSurname" 
	      name="phoneNumber" 
	      placeholder="601100100"
	      tabindex="6"
	      autofocus="autofocus">
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
	      name="extraInfo"
	      tabindex="7"
	      autofocus="autofocus"
	      placeholder="Zawsze dopisuję: kłamca. Możesz też dopisać: kutas albo przemiły człowiek, daje napiwki... Możesz też nic nie dopisywać." 
	      ><?php echo htmlspecialchars($this->data[0]['extra_info']);?></textarea>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-4">
	      <button 
	      type="submit" 
	      class="btn btn-default"
	      tabindex="8"
	      autofocus="autofocus">Zapisz</button>
	    </div>
	  </div>
	</form>

</div>
