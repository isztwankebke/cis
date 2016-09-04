<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Dodaj Użytkownika:</h1>
	<?php if (debug) {
		var_dump($this->data);
	}?>
	<form class="form-horizontal" method="post" action="../Users/admin_addUser">
	  <div class="form-group">
	    <label for="inputUserName" class="col-sm-2 control-label">Nazwa użytkownika</label>
	    <div class="col-sm-4">
	      <input 
	      type="text"
	      maxlength="11"
	      
	      class="form-control" 
	      id="inputUserName" 
	      name="username" 
	      placeholder="login"
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
	      autofocus="autofocus">
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
	      autofocus="autofocus">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputEmail" class="col-sm-2 control-label">e-mail</label>
	    <div class="col-sm-4">
	      <input 
	      type="email"
	      maxlength="40" 
	      class="form-control" 
	      id="inputEmail" 
	      name="email" 
	      placeholder="nazwa@domena.com"
	      tabindex="4"
	      autofocus="autofocus">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputPassword" class="col-sm-2 control-label">Hasło</label>
	    <div class="col-sm-4">
	      <input 
	      type="password"
	      maxlength="40" 
	      class="form-control" 
	      id="inputPassword" 
	      name="password" 
	      placeholder="hasło"
	      tabindex="5"
	      autofocus="autofocus">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputGrant" class="col-sm-2 control-label">Prawo administratora</label>
	    <div class="col-sm-4">
	      <input 
	      type="checkbox"
	      class="checkbox" 
	      id="inputGrant" 
	      name="grant_access" 
	      
	      tabindex="6"
	      autofocus="autofocus">
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-4">
	      <button 
	      type="submit" 
	      class="btn btn-default"
	      tabindex="7"
	      autofocus="autofocus">Zapisz</button>
	    </div>
	  </div>
	</form>

</div>
