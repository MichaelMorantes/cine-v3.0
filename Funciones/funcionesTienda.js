var dt;

function Tienda(){  
    dt = $("#tabla").DataTable({
        "ajax": "Controlador/controlador_tienda.php?accion=listar",
        "columns": [
            { "data": "store_id" },
            { "data": "city" },
            { "data": "address" },
            { "data": "admin" },
            { "data": "empleados" },
            // { "data": "estado",
            //     render: function (data){
            //             if (data==1) {
            //                 return "Eliminado"
            //             } else {
            //                 return "Disponible"
            //             }
            //     }
            // },
            { "data": "store_id",
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
            url:"./Controlador/controlador_tienda.php",
            data: {accion:'listapais'},
            dataType:"json"
            }).done(function(resultado) { 
                $('.store_id').val();
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
                url:"./Controlador/controlador_tienda.php",
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
                url:"./Controlador/controlador_tienda.php",
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
        $('#modalnuevo').modal('show'); 
    });

    $("#nuevoform").validate({
        rules:{
            country_id: {
                required: true
            },
            city_id: {
                required: true
            },
            address_id:{
                required: true
            }
        },
        messages:{
            country_id: {
                required: 'Este campo es obligatorio'
            },
            city_id: {
                required: 'Este campo es obligatorio'
            },
            address_id:{
                required: 'Este campo es obligatorio'
            }
        },
        submitHandler: function(form) {
            var datos=$(form).serialize();
            //   console.log(datos);
            $.ajax({
                type:"get",
                url:"./Controlador/controlador_tienda.php",
                data: datos,
                dataType:"json"
            }).done(function( resultado ) {
                //   console.log(datos);
                if(resultado.respuesta){
                    $('#nuevoform')[0].reset();
                    dt.ajax.reload();
                    alertify.success('La tienda se grabó correctamente');
                } else {
                    alertify.error("Error al grabar");  
                }
            });
        }
    });

    $("#tabla").on("click","a.editar",function(){
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
       var empleado; 
       var ciudad; 
       $.ajax({
           type:"get",
           url:"./Controlador/controlador_tienda.php",
           data: {codigo: codigo, accion:'consultar'},
           dataType:"json"
        }).done(function(tienda) {
            // console.log(tienda);
            if(tienda.respuesta === "no existe"){
                alertify.error("La tienda no existe");  
            } else {
                $(".store_id").val(tienda.codigo);   
                empleado = tienda.admin;
                ciudad  = tienda.ciudad;
            }
        });

        $.ajax({
            type:"get",
            url:"./Controlador/controlador_tienda.php",
            data: {codigo: codigo,accion:'listaadmin'},
            dataType:"json"
        }).done(function( resultado ) {    
            $(".manager_staff_id option").remove();
            // console.log(Object.keys(resultado.data).length);
            if(Object.keys(resultado.data).length == 0){
                $(".manager_staff_id").append("<option selected value='" + null + "'>Sin asignar</option>")
            } else {
                $.each(resultado.data, function (index, value) { 
                    if(empleado === value.staff_id){
                        $(".manager_staff_id").append("<option selected value='" + value.staff_id + "'>" + value.admin + "</option>")
                        }else {
                        $(".manager_staff_id").append("<option value='" + value.staff_id + "'>" + value.admin + "</option>")
                        }
                });
            }       
        }); 
        $.ajax({
            type:"get",
            url:"./Controlador/controlador_empleado.php",
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
                url:"./Controlador/controlador_empleado.php",
                data: {codigo: pais,accion:'listaciudad'},
                dataType:"json"
                }).done(function(resultado) { 
                    $(".city_ide option").remove();
                    $(".city_ide").append("<option value disabled selected=''>Seleccione ciudad</option>")
                    $(".address_id option").remove();
                    $(".address_id").append("<option value disabled selected=''>Seleccione dirección</option>")
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
                url:"./Controlador/controlador_empleado.php",
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
        $('#modaleditar').modal('show');   
    })

    $("#editarform").validate({
        rules:{
            city_ide: {
            required: true
            },
            address_id: {
            required: true
            }
        },
        messages:{
            city_ide: {
            required: 'Este campo es obligatorio',
            },
            address_id: {
            required: 'Este campo es obligatorio',
            }
        },
        submitHandler: function(form) {
            var datos=$(form).serialize();
            // console.log(datos);
            $.ajax({
               type:"get",
               url:"./Controlador/controlador_tienda.php",
               data: datos,
               dataType:"json"
             }).done(function( resultado ) {
                 if(resultado.respuesta){
                   alertify.success("La tienda ha sido actualizado!");  
                   dt.ajax.reload();
                   $("#titulo").html("Listado de tiendas");
                } else {
                   alertify.error("Error al actualizar");  
               }
           });
        }
    });

   $("#tabla").on("click","a.borrar",function(){
    //Recupera datos del formulario
    var codigo = $(this).data("codigo");
    alertify.confirm('Eliminar tienda', '¿Seguro que quieres eliminar este tienda?',function(){
                var request = $.ajax({
                method: "get",
                url: "./Controlador/controlador_tienda.php",
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