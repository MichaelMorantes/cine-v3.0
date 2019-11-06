var dt;

function ciudad(){  
    dt = $("#tabla").DataTable({
        "ajax": "Controlador/controlador_ciudad.php?accion=listar",
        "columns": [
            { "data": "city_id"},
            { "data": "city" },
            { "data": "country" },
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
            { "data": "city_id",
                render: function (data) {
                    return '<a href="#" data-codigo="'+ data + 
                    '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                +   '<a href="#" data-codigo="'+ data + 
                    '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';       
                }
            }
        ]
  });

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
        $.ajax({
            type:"get",
            url:"./Controlador/controlador_ciudad.php",
            data: {accion:'listapais'},
            dataType:"json"
            }).done(function(resultado) { 
                $('.city_id').val();
                $('.city').val('');
                $(".country_id option").remove();
                $(".country_id").append("<option value disabled selected=''>Seleccione un pais</option>")
                //console.log("nuevo")
                $.each(resultado.data, function (index, value) { 
                    //console.log(value.pais_codi);
                $(".country_id").append("<option value='" + value.country_id + "'>" + value.country + "</option>")
                $("#modalnuevo" ).modal('show'); 
            });
        });
    })

    $("#nuevoform").validate({
        rules:{
            city: {
                required: true,
                minlength: 5
            },
            country_id:{
                required: true
            }
        },
        messages:{
            city: {
                required: 'Este campo es obligatorio',
                minlength: 'Minimo 5 digitos de largo'
            },
            country_id:{
                required: 'Este campo es obligatorio'
            }
        },
        submitHandler: function(form) {
            var datos=$(form).serialize();
            // console.log(datos);
            $.ajax({
                type:"get",
                url:"./Controlador/controlador_ciudad.php",
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
       var pais; 
       $.ajax({
           type:"get",
           url:"./Controlador/controlador_ciudad.php",
           data: {codigo: codigo, accion:'consultar'},
           dataType:"json"
        }).done(function(ciudad) {
            // console.log(ciudad);
                if(ciudad.respuesta === "no existe"){
                    alertify.error("La ciudad no existe");  
                } else {
                    $(".city_id").val(ciudad.codigo);                   
                    $(".city").val(ciudad.ciudad);
                    pais = ciudad.pais;   
                }
            });

           $.ajax({
             type:"get",
             url:"./Controlador/controlador_ciudad.php",
             data: {accion:'listapais'},
             dataType:"json"
           }).done(function( resultado ) {    
            // console.log(resultado.data);       
              $(".country_id option").remove();
              $.each(resultado.data, function (index, value) { 
                if(pais === value.country_id){
                  $(".country_id").append("<option selected value='" + value.country_id + "'>" + value.country + "</option>")
                }else {
                  $(".country_id").append("<option value='" + value.country_id + "'>" + value.country + "</option>")
                }
            });
        }); 
        $('#modaleditar').modal('show');   
    })

    $("#editarform").validate({
        rules:{
            city: {
            required: true,
            minlength: 5
            }
        },
        messages:{
            city: {
            required: 'Este campo es obligatorio',
            minlength: 'Minimo 5 digitos de largo'
            }
        },
        submitHandler: function(form) {
            var datos=$(form).serialize();
            // console.log(datos);
            $.ajax({
                type:"get",
                url:"./Controlador/controlador_ciudad.php",
                data: datos,
                dataType:"json"
              }).done(function( resultado ) {
                  if(resultado.respuesta){
                    alertify.success("La ciudad ha sido actualizado!");  
                    dt.ajax.reload();
                    $("#titulo").html("Listado de ciudades");
                 } else {
                    alertify.error("Error al actualizar");  
                }
            });
        }
    });

   $("#tabla").on("click","a.borrar",function(){
    //Recupera datos del formulario
    var codigo = $(this).data("codigo");
    alertify.confirm('Eliminar ciudad', '¿Seguro que quieres eliminar esta ciudad?',function(){
                var request = $.ajax({
                method: "get",
                url: "./Controlador/controlador_ciudad.php",
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