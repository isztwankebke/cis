<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Dodaj Alert:</h1>
	<?php if (debug) {
		var_dump($this->data);
	}?>
	<form class="form-horizontal" method="post" action="../Dashboards/admin_addAlert">
	<div class="alert alert-warning" role="alert">
		<a>Jeśli jakieś pole jest nie używane zostaw puste!</a>
	</div>
	  <div class="form-group">
	    <label for="inputProduct" class="col-sm-2 control-label">Produkt</label>
	    <div class="col-sm-4">
	      <select 
	      class="form-control"
	      tabindex="1"
	      autofocus="autofocus"
	      id="inputProduct"
	      name="product_name">
  			<?php 
  			foreach ($this->data as $poduct) {
  				echo '<option value="'.$poduct['id'].'">';
  				echo $poduct['product_name']."</option>";
  				
  			}
  			?>
  			
		  </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputHalfPeriod" class="col-sm-2 control-label">Połowa spłaconych rat</label>
	    <div class="col-sm-4">
	      <input 
	      type="checkbox"
	      class="checkbox" 
	      id="inputHalfPeriod" 
	      name="half_period" 
	      
	      tabindex="2"
	      autofocus="autofocus">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputPeriodInfo1" class="col-sm-2 control-label">Po ilu spłaconych ratach informować</label>
	    <div class="col-sm-4">
	      <input 
	      type="number" 
	      maxlength="3"
	      class="form-control" 
	      id="inputPeriodInfo1" 
	      name="period_info1" 
	      placeholder="np. 4 - pole obligatoryjne"
	      tabindex="3"
	      min="0"
	      max="300"
	      autofocus="autofocus">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputWeekInfo" class="col-sm-2 control-label">Ile tygodni wcześniej informować</label>
	    <div class="col-sm-4">
	      <input 
	      type="number"
	      maxlength="2"
	      min="0"
	      max="99" 
	      class="form-control" 
	      id="inputWeekInfo" 
	      name="week_info" 
	      placeholder="np. 2"
	      tabindex="4"
	      autofocus="autofocus">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputLast" class="col-sm-2 control-label">Spłacona ostatnia rata</label>
	    <div class="col-sm-4">
	      <input 
	      type="checkbox"
	      class="checkbox" 
	      id="inputLast" 
	      name="last" 
	      
	      tabindex="5"
	      autofocus="autofocus">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputPeriodNext" class="col-sm-2 control-label">Po ilu kolejnych tygodniach powiadamiać</label>
	    <div class="col-sm-4">
	      <input 
	      type="number"
	      min="0"
	      max="99" 
	      class="form-control" 
	      id="inputPeriodNext" 
	      name="period_next" 
	      placeholder="np.2"
	      tabindex="6"
	      autofocus="autofocus">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputHasProduct" class="col-sm-2 control-label">Powiadamiaj jeśli klient posiada już produkt</label>
	    <div class="col-sm-4">
	      <input 
	      type="checkbox"
	      class="checkbox" 
	      id="inputHasProduct" 
	      name="has_product" 
	      
	      tabindex="7"
	      autofocus="autofocus">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputPeriodInfo2" class="col-sm-2 control-label">Po ilu kolejnych ratach jeśli ma produkt</label>
	    <div class="col-sm-4">
	      <input 
	      type="number"
	      min="0"
	      max="99" 
	      class="form-control" 
	      id="inputPeriodInfo2" 
	      name="period_info2" 
	      placeholder="np.1"
	      tabindex="8"
	      autofocus="autofocus">
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-4">
	      <button 
	      type="submit" 
	      class="btn btn-default"
	      tabindex="9"
	      autofocus="autofocus">Zapisz</button>
	    </div>
	  </div>
	</form>

</div>
