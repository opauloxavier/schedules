<?php

if (isset($_POST['enviaAlteracoes']) and $_SESSION['logado']){
		$firstLine=true;

		for($i=0;$i<6;$i++){ 
			for($j=0;$j<14;$j++){
				if($j==6)
					echo "-2,";
				else
					echo converteToMateria($_POST[$i."-".$j]);

				if($i!=0 and $j!=13){
					echo ",";
				}
			}
			echo"|";
		}
}

else
	echo "Não enviei";

?>