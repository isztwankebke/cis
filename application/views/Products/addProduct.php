<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  	<h1 class="page-header">Zarządzanie Produktami:</h1>
  	<?php var_dump($_REQUEST);?>
  	<?php if (isset($_POST['dodaj'])):?>
  	<h3>Podaj dane do nowego Produktu:</h3>
  	
  	<form name="DodajProdukt" action="zarzadzajProduktami.php" method="post">
  		<div>
  			<label for="1">Nazwa Produktu</label>
  			<input 
  			type="text"
  			placeholder="Nazwa produktu"
  			autofocus="autofocus"
  			name="nazwaProduktu"
  			id="1"
  			tabindex="1"
  			required="required"
  			>
  		</div>
  		<div>
  		<input
	  		type="checkbox"
	  		name="polowa"
	  		id="2"
	  		tabindex="2"
  		>
  		<label for="2">Spłacona połowa pożyczki</label>
  		
  		</div>
  		
  		<div>
  		<label for="3">Po jakiej ilości rat ma być informacja</label>
  		<input
  			type="number"
  			min="0"
  			max="120"
  			name="iloscRat1"
  			id="3"
  			tabindex="3"
  			required="required"
  			
  		>
  		</div>
  		
  		<div>
  			<label for="4">Powiadomienie ile tygodni wcześniej</label>
  			<input
  				type="number"
  				min="0"
  				max="5"
  				name="ileWczesniej"
  				id="4"
  				tabindex="4"
  				required="required"
  			>
  				
  		</div>
  		
  		<div>
  			<input
  				type="checkbox"
  				name="ostatnia"
  				id="5"
  				tabindex="5"
  			>
  			<label for="5">Spłacona ostatnia rata</label>
  		</div>
  		
  		<div>
  			<label for="6">Powiadomienie po spłaconych ilu kolejnych ratach</label>
  			<input
  				type="number"
  				min="0"
  				max="120"
  				name="ileKolejnych"
  				id="6"
  				tabindex="6"
  				required="required"
  			>
  		</div>
  		
  		<div>
  			<input
  				type="checkbox"
  				name="juzPosiada"
  				id="7"
  				tabindex="7"
  			>
  			<label for="7">Ustawienia dla klienta posiadającego już ten produkt</label>
  		</div>
  		
  		<div>
  			<label for="8">Powiadomienie po spłaceniu ilu rat jeśli klient posiada już ten produkt</label>
  			<input
  				type="number"
  				name="iloscRat2"
  				id="8"
  				tabindex="8"
  				min="0"
  				max="120"
  				required="required"
  			>
  		</div>
  		<div class="button">
  		<input
  			type="reset"
  			value="Wyczyść"
  			tabindex="10"
  			id="10"
  		>
  		<input
  			type="submit"
  			value="Zapisz"
  			tabindex="9"
  			name="Zapisz"
  			
  		>
  		</div>
  		</form>
  		
  		
  		
  		<?php 
  		elseif (isset($_POST['modyfikuj'])):
  		
  		?>
  	
  	<h3>Podaj numer # produktu, którego dane chcesz edytować:</h3>
  	
  	<form name="EdytujProdukt" action="edytujProdukt.php" method="post">
  		<div>
  			<label for="1">Numer Produktu</label>
  			<input 
  			type="number"
  			
  			autofocus="autofocus"
  			name="nazwa"
  			id="1"
  			tabindex="1"
  			required="required"
  			>
  		</div>
  		
  		<div class="button">
  		<input
  			type="reset"
  			value="Wyczyść"
  			tabindex="10"
  			id="10"
  		>
  		<input
  			type="submit"
  			value="Dalej"
  			tabindex="9"
  			name="Zmien"
  			
  		>
  		</div>  		
  		
  		
  	</form>
  	<?php endif;?>
 <?php var_dump($_REQUEST);?> 	
</div>