function usuario(){    
    $("#login-form").on('submit',function(e){    
        e.preventDefault();
        var datos = $(this).serialize();
        // console.log(datos)
        $.ajax({
            type:"post",
            url:"./Controlador/controladorUsuario.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
            // console.log(resultado);
            if(resultado.respuesta == "existe"){
            // if(resultado.respuesta == "empleado"){
                location.href ="adminper.php";
            }
            // else if (resultado.respuesta == "usuario"){
            //     location.href ="index.php";
            // }
            else{
                swal({
                    position: 'center',
                    type: 'error',
                    title: 'Usuario y/o Password incorrecto',
                    showConfirmButton: false,
                    timer: 1500
                }),
                function() {
                    $("#usuario").focus().select();
                };                
              }
        });
    })  
}
