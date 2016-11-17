<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h2 class="page-header">Ammount Credit:</h2>
  	
	<div class="col-sm-4 form-group">
		<form class="form-inline" action="/Users/supervisor_ammountCredit" method="post">
			<div class="form-group">
				<input
				class="form-control"
				name="month"
				type="month"
				value="<?php echo $this->data[0];?>">
			</div>
			<div class="form-group">
				<button 
				class="btn btn-default" 
				type="submit" 
				name="ack">ok
				</button>
			</div>
		</form>
	<div>
	<?php //var_dump($this->data);?>
		<h4>Suma kredytów w miesiącu: <?php echo $this->data[1][0]['total'];?></h4>
	</div>

	</div>	

  	
</div>