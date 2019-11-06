var dt;

function cliente(){  
    dt = $("#tabla").DataTable({
        "ajax": "Controlador/controlador_cliente.php?accion=listar",
        "columns": [
            { "data": "customer_id"},
            { "data": "store_id" },
            { "data": "cliente" },
            { "data": "email" },
            { "data": "address" },
            { "data": "create_date" },
            // { "data": "estado",
            //     render: function (data){
            //             if (data==1) {
            //                 return "Eliminado"
            //             } else {
            //                 return "Disponible"
            //             }
            //     }
            // },
            { "data": "customer_id",
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
        },
        errorPlacement: function (error, element) {
            if (element.prop('name') === 'create_date') {
              error.insertAfter(element.parent());
            } else {
              error.insertAfter(element);
            }
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
            url:"./Controlador/controlador_cliente.php",
            data: {accion:'listapais'},
            dataType:"json"
            }).done(function(resultado) { 
                $('.customer_id').val();
                $('#nuevoform')[0].reset();
                $(".country_id option").remove();
                $(".country_ide option").remove();
                $(".city_ide option").remove();
                $(".city_id option").remove();
                $(".address_id option").remove();
                $(".country_id").append("<option value disabled selected=''>Seleccione país</option>")
                $(".city_id").append("<option value disabled selected=''>Seleccione ciudad</option>")
                $(".address_id").append("<option value disabled selected=''>Seleccione dirección</option>")
                //console.log("nuevo")
                $.each(resultado.data, function (index, value) { 
                    //console.log(value.pais_codi);
                $(".country_id").append("<option value='" + value.country_id + "'>" + value.country + "</option>")
            });
        });
        $(".country_id").change(function(){
            var pais= $(".country_id").val();
            $.ajax({
                type:"get",
                url:"./Controlador/controlador_cliente.php",
                data: {codigo: pais,accion:'listaciudad'},
                dataType:"json"
                }).done(function(resultado) { 
                    $(".city_id option").remove();
                    $(".city_id").append("<option value disabled selected=''>Seleccione ciudad</option>")
                    $(".address_id option").remove();
                    $(".address_id").append("<option value disabled selected=''>Seleccione dirección</option>")
                    //console.log("nuevo")
                    $.each(resultado.data, function (index, value) { 
                        //console.log(value.pais_codi);
                    $(".city_id").append("<option value='" + value.city_id + "'>" + value.city + "</option>")
                });
            });
        });

        $(".city_id").change(function(){
            var ciudad= $(".city_id").val();
            $.ajax({
                type:"get",
                url:"./Controlador/controlador_cliente.php",
                data: {codigo: ciudad,accion:'listadireccion'},
                dataType:"json"
                }).done(function(resultado) { 
                    $(".address_id option").remove();
                    $(".address_id").append("<option value disabled selected=''>Seleccione dirección</option>")
                    //console.log("nuevo")
                    $.each(resultado.data, function (index, value) { 
                        //console.log(value.pais_codi);
                    $(".address_id").append("<option value='" + value.address_id + "'>" + value.address + "</option>")
                });
            });
        });
        $.ajax({
            type:"get",
            url:"./Controlador/controlador_cliente.php",
            data: {accion:'listatienda'},
            dataType:"json"
            }).done(function(resultado) { 
                $(".store_id option").remove();
                $(".store_id").append("<option value disabled selected=''>Seleccione tienda</option>")
                //console.log("nuevo")
                $.each(resultado.data, function (index, value) { 
                    //console.log(value.pais_codi);
                $(".store_id").append("<option value='" + value.store_id + "'>" + value.store_id + "</option>")
            });
        });
        $('.datetimepicker-input').val('');
        // $('.f_return_nuevo').datetimepicker('maxDate', null);
        // $('.f_rental_nuevo').datetimepicker('minDate', null);
        $('.f_crea_nuevo').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
        });
        $("#modalnuevo" ).modal('show'); 
    })

    $("#nuevoform").validate({
        rules:{
            store_id: {
                required: true
            },
            first_name:{
                required: true,
                minlength: 3
            },
            last_name: {
                required: true,
                minlength: 2
            },
            email:{
                required: true,
                email: true
            },
            country_id:{
                required: true
            },
            city_id: {
                required: true
            },
            address_id: {
                required: true
            },
            create_date:{
                required: true
            }
        },
        messages:{
            store_id: {
                required: 'Este campo es obligatorio'
            },
            first_name:{
                required: 'Este campo es obligatorio',
                minlength: 'Minimo 5 digitos de largo'
            },
            last_name: {
                required: 'Este campo es obligatorio',
                minlength: 'Minimo 5 digitos de largo'
            },
            email:{
                required: 'Este campo es obligatorio',
                email: 'Correo no valido'
            },
            country_id:{
                required: 'Este campo es obligatorio'
            },
            city_id: {
                required: 'Este campo es obligatorio'
            },
            address_id: {
                required: 'Este campo es obligatorio'
            },
            create_date:{
                required: 'Este campo es obligatorio'
            }
        },
        submitHandler: function(form) {
            var datos=$(form).serialize();
            //console.log(datos);
            $.ajax({
                type:"get",
                url:"./Controlador/controlador_cliente.php",
                data: datos,
                dataType:"json"
            }).done(function( resultado ) {
                //   console.log(datos);
                if(resultado.respuesta){
                    $('#nuevoform')[0].reset();
                    $('.datetimepicker-input').val('');
                    dt.ajax.reload();
                    alertify.success('El cliente se grabó correctamente');
                } else {
                    alertify.error("Error al grabar");  
                }
            });
        }
    });

    $("#tabla").on("click","a.editar",function(){
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
       var tienda; 
       $.ajax({
           type:"get",
           url:"./Controlador/controlador_cliente.php",
           data: {codigo: codigo, accion:'consultar'},
           dataType:"json"
        }).done(function(cliente) {
            // console.log(pago);
                if(cliente.respuesta === "no existe"){
                    alertify.error("El cliente no existe");  
                } else {
                    $(".customer_id").val(cliente.codigo);   
                    $(".first_name").val(cliente.nombre);   
                    $(".last_name").val(cliente.apellido);   
                    $(".email").val(cliente.email);   
                    tienda = cliente.tienda;
                }
        });
        $.ajax({
            type:"get",
            url:"./Controlador/controlador_cliente.php",
            data: {accion:'listapais'},
            dataType:"json"
            }).done(function(resultado) { 
                $(".country_id option").remove();
                $(".country_ide option").remove();
                $(".city_id option").remove();
                $(".city_ide option").remove();
                $(".address_id option").remove();
                $(".country_ide").append("<option value disabled selected=''>Seleccione país</option>")
                $(".city_ide").append("<option value disabled selected=''>Seleccione ciudad</option>")
                $(".address_id").append("<option value disabled selected=''>Seleccione dirección</option>")
                //console.log("nuevo")
                $.each(resultado.data, function (index, value) { 
                    //console.log(value.pais_codi);
                $(".country_ide").append("<option value='" + value.country_id + "'>" + value.country + "</option>")
            });
        });
            $(".country_ide").change(function(){
                var pais= $(".country_ide").val();
                $.ajax({
                    type:"get",
                    url:"./Controlador/controlador_cliente.php",
                    data: {codigo: pais,accion:'listaciudad'},
                    dataType:"json"
                    }).done(function(resultado) { 
                        $(".city_ide option").remove();
                        $(".city_ide").append("<option value disabled selected=''>Seleccione ciudad</option>")
                        $(".address_ide option").remove();
                        $(".address_ide").append("<option value disabled selected=''>Seleccione dirección</option>")
                        //console.log("nuevo")
                        $.each(resultado.data, function (index, value) { 
                            //console.log(value.pais_codi);
                        $(".city_ide").append("<option value='" + value.city_id + "'>" + value.city + "</option>")
                    });
                });
            });
    
            $(".city_ide").change(function(){
                var ciudad= $(".city_ide").val();
                $.ajax({
                    type:"get",
                    url:"./Controlador/controlador_cliente.php",
                    data: {codigo: ciudad,accion:'listadireccion'},
                    dataType:"json"
                    }).done(function(resultado) { 
                        $(".address_id option").remove();
                        $(".address_id").append("<option value disabled selected=''>Seleccione dirección</option>")
                        //console.log("nuevo")
                        $.each(resultado.data, function (index, value) { 
                            //console.log(value.pais_codi);
                        $(".address_id").append("<option value='" + value.address_id + "'>" + value.address + "</option>")
                    });
                });
            });
            $.ajax({
                type:"get",
                url:"./Controlador/controlador_cliente.php",
                data: {accion:'listatienda'},
                dataType:"json"
            }).done(function( resultado ) {    
            // console.log(resultado.data);       
                $(".store_id option").remove();
                $.each(resultado.data, function (index, value) { 
                if(tienda === value.store_id){
                    $(".store_id").append("<option selected value='" + value.store_id + "'>" + value.store_id + "</option>")
                }else {
                    $(".store_id").append("<option value='" + value.store_id + "'>" + value.store_id + "</option>")
                }
            });
        }); 
        $('.datetimepicker-input').val('');
        // $('.f_return_editar').datetimepicker('minDate', null);
        // $('.f_rental_editar').datetimepicker('maxDate', null);
        $('.f_crea_editar').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('#modaleditar').modal('show');   
    })

    $("#editarform").validate({
        rules:{
            store_id: {
                required: true
            },
            first_name:{
                required: true,
                minlength: 3
            },
            last_name: {
                required: true,
                minlength: 2
            },
            email:{
                required: true,
                email: true
            },
            country_ide: {
                required: true
            },
            city_ide: {
                required: true
            },
            address_id: {
                required: true
            },
            create_date:{
                required: true
            }
        },
        messages:{
            store_id: {
                required: 'Este campo es obligatorio'
            },
            first_name:{
                required: 'Este campo es obligatorio',
                minlength: 'Minimo 5 digitos de largo'
            },
            last_name: {
                required: 'Este campo es obligatorio',
                minlength: 'Minimo 5 digitos de largo'
            },
            email:{
                required: 'Este campo es obligatorio',
                email: 'Correo no valido'
            },
            country_ide: {
                required: 'Este campo es obligatorio'
            },
            city_ide: {
                required: 'Este campo es obligatorio'
            },
            address_id: {
                required: 'Este campo es obligatorio'
            },
            create_date:{
                required: 'Este campo es obligatorio'
            }
        },
        submitHandler: function(form) {
            var datos=$(form).serialize();
            //console.log(datos);
            $.ajax({
                type:"get",
                url:"./Controlador/controlador_cliente.php",
                data: datos,
                dataType:"json"
            }).done(function( resultado ) {
                    if(resultado.respuesta){
                    alertify.success("El cliente ha sido actualizado!");  
                    dt.ajax.reload();
                    $("#titulo").html("Listado de clientes");
                    } else {
                    alertify.error("Error al actualizar");  
                }
            });
        }
    });

   $("#tabla").on("click","a.borrar",function(){
    //Recupera datos del formulario
    var codigo = $(this).data("codigo");
    alertify.confirm('Eliminar cliente', '¿Seguro que quieres eliminar este cliente?',function(){
                var request = $.ajax({
                method: "get",
                url: "./Controlador/controlador_cliente.php",
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
