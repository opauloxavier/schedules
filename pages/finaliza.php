<?php

$escreveBanco;

if (isset($_POST['enviaAlteracoes']) and $_SESSION['logado']){
		for($i=0;$i<6;$i++){ 
			for($j=1;$j<14;$j++){
				if($j==6)
					$escreveBanco=$escreveBanco."-2,";
				else{
					if($j!=13)
						$escreveBanco=$escreveBanco.converteToMateria($_POST[$i."-".$j]).",";
					else
						$escreveBanco=$escreveBanco.converteToMateria($_POST[$i."-".$j]);
				}
			}
			if($i!=5)
				$escreveBanco=$escreveBanco."|";
		}

		atualizaHorario($_GET['year'],$_GET['wk_number'],$escreveBanco);

		header("location:http://".url."editar/".$_GET['year']."/".$_GET['wk_number']);
}

else
	header("location:home/");
?>

