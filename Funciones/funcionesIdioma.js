var dt;

function idioma(){  
    $("#contenido").off("click", "a.editar"); 
    $("#contenido").off("click", "button#btnactualizar");
    $("#contenido").off("click","a.borrar");
    $("#contenido").off("click","button#nuevo");
    $("#contenido").off("click","button#btnnuevo");
    $("#titulo").html("Listado de idiomas");
    dt = $("#tabla").DataTable({
        "ajax": "Controlador/controlador_idioma.php?accion=listar",
        "columns": [
            { "data": "language_id"},
            { "data": "name" },
            { "data": "last_update" },
            // { "data": "estado",
            //     render: function (data){
            //             if (data==1) {
            //                 return "Eliminado"
            //             } else {
            //                 return "Disponible"
            //             }
            //     }
            // },
            { "data": "language_id",
                render: function (data) {
                    return '<a href="#" data-codigo="'+ data + 
                    '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                +   '<a href="#" data-codigo="'+ data + 
                    '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';         
                }
            }
        ]
    })

    $('#modalnuevo').on('hidden.bs.modal', function () {
        $('#nuevoform').validate().resetForm();
        $('.error').removeClass('error');
        $('.form-group').removeClass('has-error');
    });
    $('#modaleditar').on('hidden.bs.modal', function () {
        $('#editarform').validate().resetForm();
        $('.error').removeClass('error');
        $('.form-group').removeClass('has-error');
    });

    $.validator.setDefaults({
        errorClass: 'help-block',
        highlight: function(element) {
        $(element)
            .closest('.form-group')
            .addClass('has-error');
        },
        unhighlight: function(element) {
        $(element)
            .closest('.form-group')
            .removeClass('has-error');
        }
    });

    $("#contenido").on("click","button.btncerrar",function(){
        $("#contenido").html('')
        $("#titulo").removeClass("show");
        $("#titulo").addClass("hide");
        $("#abrir").collapse("hide");
    })

    $("#nuevo").on("click",function(){
        $('.name').val('');
        $("#modalnuevo" ).modal('show'); 
        //console.log("nuevo")
    })

    $("#nuevoform").validate({
        rules:{
            name: {
                required: true
            }
        },
        messages:{
            name: {
                required: 'Este campo es obligatorio'
            }
        },
        submitHandler: function(form) {
            var datos=$(form).serialize();
            $.ajax({
                type:"get",
                url:"./Controlador/controlador_idioma.php",
                data: datos,
                dataType:"json"
            }).done(function( resultado ) {
                //   console.log(datos);
                if(resultado.respuesta){
                    $('#nuevoform')[0].reset();
                    dt.ajax.reload();
                    alertify.success('El registro se grabó correctamente');
                } else {
                    alertify.error("Error al grabar");  
                }
            });
        }
    });

    $("#tabla").on("click","a.editar",function(){
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
       $.ajax({
           type:"get",
           url:"./Controlador/controlador_idioma.php",
           data: {codigo: codigo, accion:'consultar'},
           dataType:"json"
        }).done(function(idioma) {
            // console.log(ciudad);
                if(idioma.respuesta === "no existe"){
                    alertify.error("El país no existe");  
                } else {
                    $(".language_id").val(idioma.codigo);                   
                    $(".name").val(idioma.idioma);   
                }
            });
        $('#modaleditar').modal('show');   
    })

    $("#editarform").validate({
        rules:{
            name: {
                required: true
            }
        },
        messages:{
            name: {
                required: 'Este campo es obligatorio'
            }
        },
        submitHandler: function(form) {
            var datos=$(form).serialize();
            // console.log(datos);
            $.ajax({
                type:"get",
                url:"./Controlador/controlador_idioma.php",
                data: datos,
                dataType:"json"
            }).done(function( resultado ) {
                if(resultado.respuesta){
                alertify.success("El idioma ha sido actualizado!");  
                dt.ajax.reload();
                $("#titulo").html("Listado de idiomas");
                } else {
                alertify.error("Error al actualizar");  
                }
            });
        }
    });

   $("#tabla").on("click","a.borrar",function(){
    //Recupera datos del formulario
    var codigo = $(this).data("codigo");
    alertify.confirm('Eliminar idioma', '¿Seguro que quieres eliminar este idioma?',function(){
                var request = $.ajax({
                method: "get",
                url: "./Controlador/controlador_idioma.php",
                data: {codigo: codigo, accion:'borrar'},
                dataType: "json"
            })
            request.done(function( resultado ) {
                // console.log(resultado);
                if(resultado.respuesta == 'correcto'){
                    alertify.success("Eliminado con exito!");   
                    dt.ajax.reload();                            
                } else {
                    alertify.error("Error al eliminar",console.log(textStatus)); 
                }
            });
            request.fail(function( jqXHR, textStatus ) {
                alertify.error("Error al eliminar",console.log(textStatus));  
            });
        }
        , function(){
    });
});
}
