function Inicio(){
	$("#opciones a").click(function(e){
		console.log("opciones");
     	e.preventDefault();
        var url = $(this).attr("href");
        $.post( url,function(resultado) {
				if(url!="#")
					$("#abrir").collapse("show");
					$("#contenido").html(resultado);	
        });
	});
}

