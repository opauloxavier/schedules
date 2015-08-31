<?php 
	if(isset($_GET['wk_number']) and isset($_GET['year'])){
		$wk_number=$_GET['wk_number']; //
		$ano_atual=$_GET['year'];

		if($wk_number<10)
			$wk_number="0".$wk_number;


		$stringData=$ano_atual."W".$wk_number; // Formato 2015W35

		$inicioSemana= date('d-m-Y',strtotime($stringData));

		$finalSemana= date('d-m-Y',strtotime("+6 day", strtotime($inicioSemana)));

		echo'  Correspondente a <strong>'.$inicioSemana.'</strong> a <strong>'.$finalSemana.'  </strong>';
	}

	else{

		$numeroSemana= date('W');
		$ano=date('Y');

		$stringData=$ano."W".$numeroSemana; // Formato 2015W35

		$inicioSemana= date('d-m-Y',strtotime($stringData));

		$finalSemana= date('d-m-Y',strtotime("+6 day", strtotime($inicioSemana)));

		echo'  Correspondente a <strong>'.$inicioSemana.'</strong> a <strong>'.$finalSemana.'  </strong>';
		

	}
?>