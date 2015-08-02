$(document).ready(function() {

	var $aula;

    $('#data').datepicker({
	   	format: "dd/mm/yyyy",
	   	language: "pt-BR",
	    forceParse: false,
	    autoclose: true,
	   	todayHighlight: true
	});

    $('.aulas').click(function(){

    	$aula=$(this);

    	$('#dialog').modal({
  			show: true
		})
    });

     $('.editar').click(function(){

    	$aula=$(this);

    	$('#dialog').modal({
  			show: true
		})
    });


    $('#ok').click(function(){

    	var $valor=$('input[name=radios]:checked').val();

    	$aula.replaceWith("<td class='aulas'>"+$valor+"</td>");

    	$('#dialog').modal('hide');
    });

});
