<?php 
	if(isset($_GET['wk_number']))	
		printaTabela(resolveHorario($_GET['wk_number']));

	else
		printaTabela(resolveHorario());
?>