$( document ).ready(function() {
	var idEstadoSel = $('#ParticipanteEstado').val();
	if(idEstadoSel !=undefined && idEstadoSel != ""){
		$('#ParticipanteEstado').val(idEstadoSel);
		ajaxGetCidades('ParticipanteEstado',urlAjaxEstado);
	}
});
$(document).on({
    ajaxStop: function() {
		$body.removeClass("loading"); 
		setCidadeSel();
	}   
});

function buscaajax(url){
	var nomedigitado = $('#ParticipanteNome').val();
	$("div#buscaresultados").load(url+"/"+escape(nomedigitado));
}

function setCidadeSel(){
	var idCidadeSelecionada = $("input#ParticipanteCidadeSel").val();
	if(idCidadeSelecionada!="")
		$('#ParticipanteCidade').val(idCidadeSelecionada);
}

function ajaxGetCidades(selectid,url){
	var selectEstado = $("#"+selectid).val();
	if(selectEstado !=""){
		$("div#listacidades").load(url+"/"+selectEstado);
	}
}
