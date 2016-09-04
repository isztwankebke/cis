<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  	<h1 class="page-header">Zarządzanie użytkownikami:</h1>
  	<h3>Podaj nowe hasło dla użytkownika <?php echo $this->data[0]['username'];?>:</h3>
<?php if (debug) {
		var_dump($this->data);
	}?>
	<form class="form-horizontal" method="post" action="../admin_passwordChange">
	  <div class="form-group">
	    <label for="inputPassword" class="col-sm-2 control-label">Nowe Hasło</label>
	    <div class="col-sm-4">
	      <input 
	      type="password"
	      maxlength="11"
	      class="form-control" 
	      id="inputPassword" 
	      name="password" 
	      placeholder="wpisz hasło"
	      tabindex="1"
	      autofocus="autofocus"
	      required="required">
	    </div>
	    </div>
	   <div class="form-group">
	    <label for="inputRetypePassword" class="col-sm-2 control-label">Powtórz Hasło</label>
	    <div class="col-sm-4">
	      <input 
	      type="password"
	      maxlength="11"
	      class="form-control" 
	      id="inputReTypePassword" 
	      name="reTypePassword" 
	      placeholder="powtórz hasło"
	      tabindex="2"
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
	      tabindex="3"
	      autofocus="autofocus">Zapisz</button>
	    </div>
	   </div>
	   <?php var_dump($this->data);?>
	</form>

  	
</div>