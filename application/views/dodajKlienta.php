<?php 
	include '/view/header.php';
	
	
   
?>
   
   
  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  	<h1 class="page-header">Dodaj Klienta:</h1>
  	<?php var_dump($_REQUEST);?>
  	<form name="DodajKlienta" action="dodajKlienta.php" method="post">
  		<div class="pesel">
  			<label for="1">PESEL</label>
  			<input
	  			type="text"
	  			maxlength="11"
	  			pattern="\d{11,11}"
	  			placeholder="PESEL"
	  			name="Pesel"
	  			id="1"
	  			tabindex="1"
	  			required="required"
	  			autofocus="autofocus"
  			>
  		</div>
  		<div class="imie">
  			<label for="2">IMIĘ</label>
  			<input
	  			type="text"
	  			maxlength="24"
	  			pattern="([A-Za-z]{1}[A-Za-z ]{2,})+"
	  			placeholder="IMIE"
	  			name="Imie"
	  			id="2"
	  			tabindex="2"
	  			required="required"
  			>
  		</div>
  		<div class="nazwisko">
  			<label for="3">NAZWISKO</label>
  			<input
	  			type="text"
	  			maxlength="50"
	  			pattern="([A-Za-z]{1}[A-Za-z -]{2,})+"
	  			placeholder="NAZWISKO"
	  			name="Nazwisko"
	  			id="3"
	  			tabindex="3"
	  			required="required"
  			>
  		</div>
  		<div class="nrTel">
  			<label for="4">Nr Telefonu</label>
  			<input
	  			type="text"
	  			maxlength="11"
	  			pattern="\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{3})"
	  			placeholder="Numer Telefonu"
	  			name="NrTelefonu"
	  			id="4"
	  			tabindex="4"
	  			required="required"
  			>
  		</div>
  		<div class="produkt">
  			<label for="5">Produkt</label>
  			<select 
  				id="5"
  				tabindex="5"
  				name="Produkt"
  				required="required">
  				<?php 
  					$sql = "SELECT * FROM `products` WHERE 1"; //dynamiczne wyswietlanie listy produktow
  					$result = MyQuery($sql);
  					
  					while ($wynik = mysqli_fetch_array($result)) {?>

  					<option value="<?php echo $wynik['id'];?>"><?php echo $wynik['nazwa'];?></option>
  					
  					<?php }?>	
  					
  				
			  
			</select>
  		</div>
  		<div class="dataZawarcia">
  			<label for="6">Data zawarcia umowy</label>
  			<input
	  			type="date"
	  			value="<?php echo date('Y-m-d'); ?>"
	  			name="DataZawarcia"
	  			id="6"
	  			tabindex="6"
	  			required="required"
	  			ondurationchange="oblicz()"
		  	
  			>
  		</div>
  		<div class="okresKredytu">
  			<label for="7">Ilosc rat</label>
  			<input
	  			type="number"
	  			min="1"
	  			max="120"
	  			placeholder="Wpisz ile rat, np. 15 albo 36"
	  			name="OkresKredytu"
	  			id="7"
	  			tabindex="7"
	  			required="required"
	  			onkeyup="oblicz()"
  			>
  		</div>
  		<div class="dataKoniec">
  			<label for="8">Koniec Rat</label>
  			<input
  			type="text"
  			value=""
  			name="DataKoniec"
  			id="8"
  			readonly="readonly"
  			>
  		</div><br>
  		<div class="notatki">
  		<label for="9">Notatki, info dodatkowe o kliencie<br></label>
  		<textarea 
  			rows="5"
  			id="9"
  			maxlength="1000"
  			tabindex="9"
  			placeholder="Zawsze dopisuje: klamca. Mozesz tez dopisac: kutas albo przemily czowiek"
  			name="Notatki"
  			 
		
		></textarea>
  		</div>
  		
  		<div class="button">
  		<input
  			type="reset"
  			value="Wyczyść"
  			tabindex="11"
  		>
  		<input
  			type="submit"
  			value="Zapisz"
  			tabindex="10"
  			name="Zapisz"
  		>
  		</div>
  		
  	
  	
  	</form>
  </div>
   

<?php 
	include '/view/footer.php';
?>
