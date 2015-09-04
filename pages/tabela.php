<?php 
	if(isset($_GET['wk_number']) and isset($_GET['year'])){
		//echo"entrei";	
		printaTabela(resolveHorario($_GET['wk_number'],$_GET['year']));
	}
	else
		printaTabela(resolveHorario());
?>