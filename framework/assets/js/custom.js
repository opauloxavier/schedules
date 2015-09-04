function insereData(){
    	var $data = $('.periodo');

    	$.ajax({
    		type: "GET",
    		url: "data",
    		dataType:"html",
    		success: function(response){
    			$data.append(response);
    		}
    	});
}

	Date.prototype.getWeek = function() {
		var onejan = new Date(this.getFullYear(),0,1);
		
		return Math.ceil((((this - onejan) / 86400000) + onejan.getDay()+1)/7);
	} 


$(document).ready(function() {

	var $aula;
    var $today = new Date();
	var $weekAtual = $today.getWeek();
	var $anoAtual = 2015;

	insereData(); //Insere a data no primeiro

    $('.proximo').click(function(){
    	var $tabelaAntiga=$('.table');
    	var $dataAntiga=$('.periodo');

    	$tabelaAntiga.empty();
    	$dataAntiga.empty();
    	$weekAtual++;

    	$(function(){

    	$.ajax({
    		type: "GET",
    		url: "tabela/"+$anoAtual+"/"+$weekAtual,
    		dataType:"html",
    		success: function(response){
    			$tabelaAntiga.append(response);
    			//alert(response);
    		}
    	});

    	$(function(){
    	var $data = $('.periodo');
	    	$.ajax({
	    		type: "GET",
	    		url: "data/"+$anoAtual+"/"+$weekAtual,
	    		dataType:"html",
	    		success: function(response){
	    			$data.append(response);
	    		}
	    	});

   			});
    	});
    });


    $('.anterior').click(function(){
    	var $tabelaAntiga=$('.table');
    	var $dataAntiga=$('.periodo');

    	$tabelaAntiga.empty();
    	$dataAntiga.empty();
    	$weekAtual--;

    	$(function(){

    	$.ajax({
    		type: "GET",
    		url: "tabela/"+$anoAtual+"/"+$weekAtual,
    		dataType:"html",
    		success: function(response){
    			$tabelaAntiga.append(response);
    			//alert(response);
    		}
    	});

    	$(function(){
    	var $data = $('.periodo');
	    	$.ajax({
	    		type: "GET",
	    		url: "data/"+$anoAtual+"/"+$weekAtual,
	    		dataType:"html",
	    		success: function(response){
	    			$data.append(response);
	    		}
	    	});

   			});
    	});
    });
   
});
