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

  $("select").change(function(){
    var $classeAntiga = this.className;
    var $classeNova = this.options[this.selectedIndex].className;

      switch ($classeNova){
        case "feriado":
          $(this).css("color","#ac06c1");
          break;
        case "almoco":
          $(this).css("color","#000000");
          break;
        case "semAula":
         $(this).css("color","#807F7E");
          break;
        case "naoDefinido":
          $(this).css("color","#E80909");
          break;
        case "legislacao":
         $(this).css("color","#221CE6");
          break;
        case "direcaoDefensiva":
         $(this).css("color","#d7d828");
          break;
        case "primeirosSocorros":
          $(this).css("color","#E80909");
          break;
        case "meioAmbiente":
          $(this).css("color","#187813");
          break;
        case "mecanica":
          $(this).css("color","#28c2d8");
          break;
      }
   
  });

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

   // $('.padding').css('color','gray');
  //  $('.padding').change(function() {
     //  var current = $('.padding').val();
     //  console.log(current);
     //  if (current != 'null') {
     //      $('.padding').css('color','gray');
     //  } //else {
       //    $('.padding').css('color','red');
      // }


});